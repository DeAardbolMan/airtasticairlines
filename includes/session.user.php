<?php 
if(isset($_SESSION["user"])) {
	$query = $db->prepare("SELECT * FROM `users` WHERE email = :email");
	$query->bindValue(':email', $_SESSION["user"]);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as &$data) {
			if($data["admin"] == "1") {
				$UserIsAdmin = true;
				} else {
				$UserIsAdmin = false;
				}
			
	}
	function userData($x) {
		global $db;
		$query = $db->prepare("SELECT * FROM `users` WHERE email = :email");
		$query->bindValue(':email', $_SESSION["user"]);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			if($x == "id" || $x == "email" || $x == "voornaam" || $x == "achternaam" || $x == "adres" || $x == "woonplaats" || $x == "telefoon" || $x == "postcode") {
				return $data["$x"];
				
			} else {
				return "Error";
			}
		}
	}

}
?>