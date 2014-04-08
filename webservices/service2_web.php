<?php

		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


		//$data = json_decode(file_get_contents(" https://grait-dm.gatech.edu/feeds/feed_lnd_hazards_r.php"),
	     //           TRUE);

		curl_setopt($ch, CURLOPT_URL, "https://grait-dm.gatech.edu/feeds/feed_lnd_hazards_r.php");
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

		$data = curl_exec($ch);
					
		curl_close($ch);
		echo $data;
		return $data;
?>