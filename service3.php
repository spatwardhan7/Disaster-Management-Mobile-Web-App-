<?php

                $start_date = $_GET['start'];
                $end_date = $_GET['end'];

                $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                if(isset($_GET['sw_lat']))
                {
                        $sw_lat = $_GET['sw_lat'];
                        $sw_lng = $_GET['sw_lng'];
                        $ne_lat = $_GET['ne_lat'];
                        $ne_lng = $_GET['ne_lng'];
                        
                        curl_setopt($ch, CURLOPT_URL, "http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_trmm_72h.php?start=$start_date&end=$end_date&sw_lat=$sw_lat&sw_lng=$sw_lng&ne_lat=$ne_lat&ne_lng=$ne_lng");
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
    
                    $data = curl_exec($ch);                
                }
                else
                {
                        curl_setopt($ch, CURLOPT_URL,"http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_trmm_72h.php?start=$start_date&end=$end_date");
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

                    $data = curl_exec($ch);                        
                }                        
                
                curl_close($ch);

                echo $data;
                return $data;
?>