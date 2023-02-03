<?php 
	try {
		global $db_conn;
		$db_conn= new PDO('mysql:host=localhost;dbname=rs-legacy-1', 'remotestaff', 'ZY2XkM950RieSfvHm8Vjd');
		$db_conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	}
	catch(PDOException $e){
		echo "Connection Failed to DCRM: ".$e->getMessage();
		die();
	}
?>