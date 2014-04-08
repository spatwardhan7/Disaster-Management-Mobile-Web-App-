<?php

		$data = json_decode(file_get_contents("http://bruiser3.cc.gatech.edu:8080/grait-dm/feed_lnd_hazards.php"),
	                TRUE);
					
		echo json_encode($data);
		return $data;

?>