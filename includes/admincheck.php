<?php

	if(!isset($_SESSION["user"])) {
		echo "Je moet ingelogd zijn om deze pagina te bekijken.";
		die();
	} else if($UserIsAdmin == false) {
		echo "Je hebt geen administratie rechten";
		die();
	}
	?>