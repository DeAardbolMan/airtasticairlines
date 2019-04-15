<style>
html {
    height: 100%;
}

body{
    font-family: 'Lato', sans-serif;
    color: #888;
    margin: 0;
}

main{
    display: table;
    width: 100%;
	margin-top: 30vh;
    height: 50vh;
    text-align: center;
	
}

main h1 {
	  font-size: 60px;
	  color: #888;
}
.a {
	text-decoration: none;
	color: #888;
}
a:after, a:hover, a:visited, a:active {
	text-decoration: none;
	color: #888;
}
i { 
font-size: 80px;

}
</style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

<main>
<i class="far fa-check-circle"></i>     
   		<h1>De instellingen zijn opgeslagen</h1>
				<?php if((isset($_GET["logout"])) AND ($_GET["logout"] == "true")) { ?>
				<p>Je wordt nu automatisch uitgelogd.</p>
				<?php
				session_start();
				unset($_SESSION["user"]);
				session_destroy();
				if (!isset($_SESSION["user"])) {
				
				echo "<meta http-equiv='refresh' content='3;url=index.php' />";
	
				}
				?>
				<?php } else { ?>
				<p> <a href="index" class="a">Vlieg terug naar de homepagina.</a></p>
				<?php } ?>
</main>