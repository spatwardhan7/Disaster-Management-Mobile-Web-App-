<?php

                $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


                //$data = json_decode(file_get_contents("http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_lnd_hazards.php"),
             //           TRUE);

                curl_setopt($ch, CURLOPT_URL, "http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_lnd_hazards.php");
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

                $data = curl_exec($ch);
                                        
                curl_close($ch);
                echo $data;
                return $data;
?>