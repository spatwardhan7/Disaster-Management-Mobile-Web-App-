#import _mysql
import MySQLdb as mdb
import sys
import urllib
import json
from StringIO import StringIO
import ast
import smtplib
import time
import datetime

def send_email(sendTo,infourl):
    gmail_user = "disasternotification.gatech@gmail.com"
    gmail_pwd = "rts12345"
    FROM = 'disasternotification.gatech@gmail.com'
    TO = sendTo #must be a list
    SUBJECT = "Latest Disaster Notifications"
    TEXT = "This is an email sent by the Disaster Notification System at Georgia Tech \n\n"

    wordupdate = "update"
    if(len(infourl)>1):
        wordupdate = "updates"
            
    
    TEXT += "You have "+str(len(infourl))+" new "+wordupdate
    TEXT += "\n\nHere are some useful links\n"

    for i in range(len(infourl)):
        TEXT += infourl[i]+"\n\n"

    TEXT += "\n\n"
    TEXT += "-DM Mobile Web App"
        

    # Prepare actual message
    message = """\From: %s\nTo: %s\nSubject: %s\n\n%s
    """ % (FROM, ", ".join(TO), SUBJECT, TEXT)
    try:
        #server = smtplib.SMTP(SERVER) 
        server = smtplib.SMTP("smtp.gmail.com", 587) #or port 465 doesn't seem to work!
        server.ehlo()
        server.starttls()
        server.login(gmail_user, gmail_pwd)
        server.sendmail(FROM, TO, message)
        #server.quit()
        server.close()
        print 'successfully sent the mail'
    except:
        print "failed to send mail"

def queryandsend():
    try:
        con = mdb.connect('localhost', 'rts', 'mypass', 'rtsdb');

        cur = con.cursor()
        cur.execute("SELECT * from users")

        #print datetime.datetime.now().date()
        #print datetime.date.fromordinal(datetime.date.today().toordinal()-1)

        enddate = str(datetime.datetime.now().date())
        startdate = str(datetime.date.fromordinal(datetime.date.today().toordinal()-1))

        for i in range(cur.rowcount):     
            #print "Value of i: " +str(i)
            row = cur.fetchone()
            email = row[0]
            swlat = row[1]
            swlng = row[2]
            nelat = row[3]
            nelng = row[4]
            print email,swlat,swlng,nelat,nelng
    
            #url = "https://grait-dm.gatech.edu/feeds/feed_multi-stream_analysis_r.php?start=2013-12-8"+"&end=2013-12-9"+"&sw_lat="+str(swlat)+"&sw_lng="+str(swlng)+"&ne_lat="+str(nelat)+"&ne_lng="+str(nelng)+"&coef=0.041667"
            url = "https://grait-dm.gatech.edu/feeds/feed_multi-stream_analysis_r.php?start="+startdate+"&end="+enddate+"&sw_lat="+str(swlat)+"&sw_lng="+str(swlng)+"&ne_lat="+str(nelat)+"&ne_lng="+str(nelng)+"&coef=0.041667"
            response = urllib.urlopen(url);
            data = json.load(response)

            infourl = list()
            for ind in range(len(data['features'])):
                infourl.append(data['features'][ind]['url'])

            sendTo = list()
            sendTo.append(email)
            
            print "Calling send email"
            send_email(sendTo,infourl)
        
    except mdb.Error, e:
        print "Error %d: %s" % (e.args[0],e.args[1])
        sys.exit(1)
    finally:    
        if con:    
            con.close()
def main():

        # FOR DEMO PURPOSE ONLY
        # PLEASE UNCOMMENT TO SEND ONLY 5 EMAILS
        # ONE PER 30 SECONDS
        count = 0
        while(count !=5):
            queryandsend()
            time.sleep(30)
            count += 1

        # TO RUN CONTINOUSLY AND SEND EMAILS
        # EVERY HOUR
        # while(1):
        #    queryandsend()
        #    time.sleep(3600)
            
if __name__ == "__main__": main()    
