<?php
error_reporting(E_ALL);

session_start();

try {
	$db = new PDO("mysql:host=localhost;dbname=airtastic","root",""); 
} catch(PDOException $e) {
	die("Error: " .  $e->getMessage());
}

include 'session.user.php';
?>
