<?php

	if((userData(achternaam)) == null || (userData(adres)) == null || (userData(woonplaats)) == null) {
		header("location: instellingen.php?error=1");
		die();
	} 
	?>