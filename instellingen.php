<?php
require_once 'includes/site.config.php';
require_once 'includes/logincheck.php';
include 'includes/content/menu.php';

if(isset($_POST["submit"])) {
	$voornaam = htmlspecialchars($_POST["voornaam"]);
	$achternaam = htmlspecialchars($_POST["achternaam"]);
	$telefoon = htmlspecialchars($_POST["telefoon"]);
	$adres = htmlspecialchars($_POST["adres"]);
	$postcode = htmlspecialchars($_POST["postcode"]);
	$woonplaats = htmlspecialchars($_POST["woonplaats"]);
	$sql = "UPDATE users SET voornaam = :voornaam, achternaam = :achternaam, telefoon = :telefoon, adres = :adres, postcode = :postcode, woonplaats = :woonplaats WHERE email = :email";
				$stmt = $db->prepare($sql);

				$stmt->bindValue(':voornaam', $voornaam);
				$stmt->bindValue(':achternaam', $achternaam);
				$stmt->bindValue(':telefoon', $telefoon);
				$stmt->bindValue(':adres', $adres);
				$stmt->bindValue(':postcode', $postcode);
				$stmt->bindValue(':woonplaats', $woonplaats);
				$stmt->bindValue(':email', $_SESSION["user"]);

				$result = $stmt->execute();
   
    if($result){
		header("location: succes.php");
    } 
}
?>

    <div class="spacer"></div>
    <main>
        <div class="container">
           <div class="row">
		   <div class="col-sm-8">
		   
		   <h2><i class="fas fa-sliders-h"></i> Instellingen</h2>
		   <?php if(isset($_GET["error"])) { ?>
		   <div class="alert alert-danger">
		   Vul eerst alle gegevens in
		   </div>
		   <?php } ?>
	<?php	   $query = $db->prepare("SELECT * FROM `users` WHERE email = :email");
		$query->bindValue(':email', $_SESSION["user"]);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) { ?>
		   <form method="post" action="instellingen.php">
		   <div class="form-group">
			
				<label for="voornaam">Persoonlijke gegevens</label>
				<input type="text" name="voornaam" placeholder="Voornaam" value="<?php echo $data["voornaam"]; ?>" class="form-control formm" required>
				<input type="text" name="achternaam" placeholder="Achternaam" value="<?php echo $data["achternaam"]; ?>" class="form-control formm" required>
				<input type="text" name="telefoon" placeholder="Telefoonnummer" value="<?php echo $data["telefoon"]; ?>" class="form-control formm" pattern="[0-9]{10}" title="Een telefoonnummer uit 10 cijfers, beginnend met 06" required>

				<br>
				<label for="adres">Adres gegevens</label>
				<input type="text" name="adres" placeholder="Adres" value="<?php echo $data["adres"]; ?>" class="form-control formm" required>
				<input type="text" name="postcode" placeholder="Postcode" value="<?php echo $data["postcode"]; ?>" class="form-control formm" pattern="[0-9]{4}[A-Z]{2}" title="Een postcode bestaat uit 4 cijfers en 2 hoofdletters." required>
				<input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php echo $data["woonplaats"]; ?>" class="form-control formm" required>
				<br>
                        <button type="submit" class="btn btn-default" name="submit" ><i class="far fa-save"></i> Opslaan</button>

			


		   </form>
		<?php } ?>
		   </div>
		   </div>
		   <div class="col-sm-4 text-left" >
		   <h2 class="text-left">Overige instellingen</h2>
		 <ul>
		   <li><a href="instellingen_wachtwoord.php">Wachtwoord wijzigen</a></li></ul>
		   </div>
        </div>
       

    </main>
<?php include 'includes/content/footer.php';