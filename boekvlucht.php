<?php
require_once 'includes/site.config.php';
require_once 'includes/logincheck.php';
require_once 'includes/gegevenscheck.php';

if(!isset($_GET["flight"])) {
	header("location: index");
	die();
}
if(!isset($_GET["ap"])) {
	header("location: index");
	die();
}
	$flightid = $_GET["flight"];
	$ap = $_GET["ap"];
	$userid = userData("id");

	try {
				$sql = "INSERT INTO `booking` (`userid`, `flightid`, `aantalpers`) VALUES (:userid, :flightid, :aantalpers);";

				$stmt = $db->prepare($sql);
				$stmt->bindValue(':userid', $userid);
				$stmt->bindValue(':flightid', $flightid);
				$stmt->bindValue(':aantalpers', $ap);
				$result = $stmt->execute();
			
	} catch(PDOException $e) {
        echo "An error occured reading table!"; 
        echo $e->getMessage();                   
    }
    if($result){
		header("location: succes.php");
    }



?>

 