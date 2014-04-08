<?php

		$start_date = $_GET['start'];
		$end_date = $_GET['end'];
		if(isset($_GET['sw_lat']))
		{
			$sw_lat = $_GET['sw_lat'];
			$sw_lng = $_GET['sw_lng'];
			$ne_lat = $_GET['ne_lat'];
			$ne_lng = $_GET['ne_lng'];
			
			$data = json_decode(file_get_contents("http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_usgs_m25_week.php?start=$start_date&end=$end_date&sw_lat=$sw_lat&sw_lng=$sw_lng&ne_lat=$ne_lat&ne_lng=$ne_lng"),
	                TRUE);
		}
		else
		{
		$data = json_decode(file_get_contents("http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_usgs_m25_week.php?start=$start_date&end=$end_date"),
	                TRUE);
		}			
		echo json_encode($data);
		return $data;

?>