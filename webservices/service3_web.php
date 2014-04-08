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
			
			curl_setopt($ch, CURLOPT_URL, "https://grait-dm.gatech.edu/feeds/feed_trmm_72h_r.php?start=$start_date&end=$end_date&sw_lat=$sw_lat&sw_lng=$sw_lng&ne_lat=$ne_lat&ne_lng=$ne_lng");
    		
    
    		$data = curl_exec($ch);	        
		}
		else
		{
			curl_setopt($ch, CURLOPT_URL,"https://grait-dm.gatech.edu/feeds/feed_trmm_72h_r.php?start=$start_date&end=$end_date");
    		

    		$data = curl_exec($ch);			
		}			
		
		curl_close($ch);

		echo $data;
		return $data;
?>