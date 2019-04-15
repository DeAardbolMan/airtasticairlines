<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Airtastic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <link rel="stylesheet" href="style/default/style.css">
    <script src="style/js/scroll.js"></script>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
               
                <li><a href="index.php#topbestemmingen"><i class="fas fa-plane-arrival"></i> Topbestemmingen</a></li>
				 
            </ul>
            <a href="#topheader">
                <div class="menu-logo" id="logoMenu"></div>
            </a>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION["user"])) { ?>
  
    
					<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-users"></i> Welkom, <b><?php echo userData("voornaam"); ?></b>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
						<li><a href="instellingen.php"><i class="fas fa-cog"></i> Instellingen</a></li>
						<li><a href="mijnboekingen.php"><i class="fas fa-cog"></i> Mijn boeking</a></li>
						<?php if($UserIsAdmin == true) { ?>
						<li><a href="admin/index.php"><i class="fas fa-tools"></i> Administratie</a></li>
						<?php } ?>
		                <li><a href="loguit.php"><i class="fas fa-sign-out-alt"></i> Uitloggen</a></li>
			
        </ul>
      </li>
                <?php } else { ?>
                    <li><a data-toggle="modal" data-target="#registreren"><i class="fas fa-user-plus"></i>
                            Registreren</a></li>
                    <li><a data-toggle="modal" data-target="#inloggen"><i class="fas fa-sign-in-alt"></i> Inloggen</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>