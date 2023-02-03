<?php 
	try {
		global $db_conn;
		$db_conn= new PDO('mysql:host=localhost;dbname=rs', 'root', '');
		$db_conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
		$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Connection Failed to DCRM: ".$e->getMessage();
		die();
	}
?>