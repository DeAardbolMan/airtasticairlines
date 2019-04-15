<?php
session_start();

unset($_SESSION["user"]);



session_destroy();
if (!isset($_SESSION["user"])) {
	header("location: index.php");

}
?>