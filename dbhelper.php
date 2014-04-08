<?php

    $con = mysql_connect('localhost', 'rts', 'mypass');
    if (!$con) 
    {
        die('Could not connect: ' . mysql_error());
    }   
    else
        echo "Connection Established";


    $email = $_GET['email'];


    $sw_lat = $_GET['sw_lat'];
    $sw_lng = $_GET['sw_lng'];
    $ne_lat = $_GET['ne_lat'];
    $ne_lng = $_GET['ne_lng'];

    
    // make foo the current db
    $db_selected = mysql_select_db('rtsdb', $con);
    if (!$db_selected) 
    {
        #die ('Can\'t use foo : ' . mysql_error());
          $sql = 'CREATE DATABASE rtsdb';

           if (mysql_query($sql, $con)) 
            {
                echo "Database rtsdb created successfully\n";

                mysql_select_db('rtsdb', $con);
                $createTable = 'CREATE TABLE users (email VARCHAR(45), swlat FLOAT, swlng FLOAT,nelat FLOAT, nelng FLOAT)';
                if(mysql_query($createTable,$con))
                    echo "Table created\n";
                else
                     echo 'Error creating table: ' . mysql_error() . "\n";       

            } 
            else 
            {
                echo 'Error creating database: ' . mysql_error() . "\n";
            }
    }


    $sql="INSERT INTO users (email, swlat,swlng,nelat,nelng)
        VALUES
        ('$email','$sw_lat','$sw_lng','$ne_lat','$ne_lng')";

    if (!mysql_query($sql,$con))
    {
        die('Error: ' . mysql_error($con));
    }
    else
    echo "1 record added";

    mysql_close($con);

?>