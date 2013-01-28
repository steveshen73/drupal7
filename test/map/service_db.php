<?php

if($_POST){
	if ($_POST['action'] == 'addSighting') {
	
		
		$city = htmlspecialchars($_POST['city']);
		$state = htmlspecialchars($_POST['state']);
		$name = htmlspecialchars($_POST['name']);
		$mktExtId = htmlspecialchars($_POST['mktExtId']);
		
		
		$query = "INSERT INTO sightings (city, state, name, mktExtid) ";
		$query .= "VALUES ('$city', '$state', '$name', '$mktExtId') ";

		$result = db_connection($query);
		
		if ($result) {
			$msg = "Creature added successfully";
			success($msg);
		} else {
			fail('Insert failed.');
		}
		exit;
	}
}

if($_GET){
	if($_GET['action'] == 'getAllSightings'){
		$query = "SELECT id, city, state, name, mktExtId FROM sightings order by id ASC ";
		$result = db_connection($query);
		
		$sightings = array();

		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($sightings, array('id' => $row['id'], 'city' => $row['city'], 'state' => $row['state'], 'name' => $row['name'], 'mktExtId' => $row['mktExtId'] ));
		}
		echo json_encode(array("sightings" => $sightings));
		exit;	
	}elseif($_GET['action'] == 'getSingleSighting'){
		$id = htmlspecialchars($_GET['id']);
		$query = "SELECT id, city, state, name, mktExtId FROM sightings sighting_id = '$id' ";
		$result = db_connection($query);
		
		$sightings = array();

		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($sightings, 
                                   array('city' => $row['city'], 'state' => $row['state'], 'name' => $row['name'],
					 'mktExtId' => $row['mktExtId']
				        )
			         );
		}
		echo json_encode(array("sightings" => $sightings));
		exit;	
	}elseif($_GET['action'] == 'getSightingsByName'){
		$name = htmlspecialchars($_GET['name']);
		$query = "SELECT id, city, state, name, mktExtId FROM sightings order by id ASC";
		$result = db_connection($query);
		
		$sightings = array();

		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($sightings, 
                                   array('city' => $row['city'], 'state' => $row['state'], 'name' => $row['name'], mktExtId => $row['mktExtId']
				        )
			          );
		}
		echo json_encode(array("sightings" => $sightings));
		exit;
	}
}	
	function db_connection($query) {
		mysql_connect('127.0.0.1', 'root', 'mysql88')
			OR die(fail('Could not connect to database.'));
		mysql_select_db('map');

		return mysql_query($query);
	}
	
	function fail($message) {
		die(json_encode(array('status' => 'fail', 'message' => $message)));
	}
	function success($message) {
		die(json_encode(array('status' => 'success', 'message' => $message)));
	}
?>
