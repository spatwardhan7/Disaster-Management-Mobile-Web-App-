dbhelper.php : Stores user email and coordinates in localdatabase
	       Please create user with username and password mentioned in dbhelper

sendemail.py : Python script which queries user database to get email address and coordinates.
	       Further, this script makes a call to the Multi source analysis database and sends an email to users with their updates


Running this app:
To run on local host:
1) Download and install Xampp
2) Copy folder to Xampp/htdocs/
3) Start Xampp Apache server
4) Start Xampp MySql server
5) Create mysql user and grant all privileges. User name and pwd for user mentioned in dbhelper.php
6) Open localhost/DM_Home.html
7) Execute sendemail.py

