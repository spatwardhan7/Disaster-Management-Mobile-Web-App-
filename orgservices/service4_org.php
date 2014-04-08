<?php

		$start_date = $_GET['start'];
		$end_date = $_GET['end'];


		if(isset($_GET['sw_lat']))
		{
			$sw_lat = $_GET['sw_lat'];
			$sw_lng = $_GET['sw_lng'];
			$ne_lat = $_GET['ne_lat'];
			$ne_lng = $_GET['ne_lng'];
			
			/*
			echo ("received call to query multifeed with lat lang");
			echo($sw_lat);
			echo($sw_lng);
			echo($ne_lat);
			echo($ne_lng);
			*/
			$data = json_decode(file_get_contents("http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_multi-stream_analysis.php?start=$start_date&end=$end_date&sw_lat=$sw_lat&sw_lng=$sw_lng&ne_lat=$ne_lat&ne_lng=$ne_lng&coef=0.041667"),TRUE);
		}
		else
		{
			$data = json_decode(file_get_contents("http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_multi-stream_analysis.php?start=$start_date&end=$end_date&sw_lat=-90.0&sw_lng=-180.0&ne_lat=90.0&ne_lng=180.0&coef=0.041667"),TRUE);
		}			
		echo json_encode($data);
		return $data;

?>