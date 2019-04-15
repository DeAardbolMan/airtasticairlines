<?php
require_once '../includes/site.config.php';

include '../includes/admincheck.php';
include '../includes/content/adminmenu.php';

if(isset($_POST["submit"])) {
	$voornaam = htmlspecialchars($_POST["voornaam"]);
	$achternaam = htmlspecialchars($_POST["achternaam"]);
	$telefoon = htmlspecialchars($_POST["telefoon"]);
	$adres = htmlspecialchars($_POST["adres"]);
	$postcode = htmlspecialchars($_POST["postcode"]);
	$woonplaats = htmlspecialchars($_POST["woonplaats"]);
	$email = htmlspecialchars($_POST["email"]);
	if ($_POST['adminrechten'] == '1') {

	$admin = "1";
	} else {
	$admin = "0";
	}
	$sql = "UPDATE users SET voornaam = :voornaam, achternaam = :achternaam, telefoon = :telefoon, adres = :adres, postcode = :postcode, woonplaats = :woonplaats, admin = :admin WHERE email = :email";
				$stmt = $db->prepare($sql);

				$stmt->bindValue(':voornaam', $voornaam);
				$stmt->bindValue(':achternaam', $achternaam);
				$stmt->bindValue(':telefoon', $telefoon);
				$stmt->bindValue(':adres', $adres);
				$stmt->bindValue(':postcode', $postcode);
				$stmt->bindValue(':woonplaats', $woonplaats);
				$stmt->bindValue(':email', $email);
				$stmt->bindValue(':admin', $admin);

				$result = $stmt->execute();
   
    if($result){
		header("location: klanten.php");
    } 
}
?>

    <div class="container woohoo">    
  <div class="row">
         
		   <div class="col-sm-12">
		   <h2><i class="fas fa-sliders-h"></i> Instellingen</h2>
	<?php	   $query = $db->prepare("SELECT * FROM `users` WHERE id = :id");
		$query->bindValue(':id', $_GET["user"]);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) { ?>
		   <form method="post">
		   <div class="form-group">
			
				<label for="voornaam"><b>Persoonlijke gegevens</b></label>
				<input type="text" name="voornaam" placeholder="Voornaam" value="<?php echo $data["voornaam"]; ?>" class="form-control formm" >
				<input type="text" name="achternaam" placeholder="Achternaam" value="<?php echo $data["achternaam"]; ?>" class="form-control formm" >
				<input type="text" name="telefoon" placeholder="Telefoonnummer" value="<?php echo $data["telefoon"]; ?>" class="form-control formm" pattern="[0-9]{10}" title="Een telefoonnummer uit 10 cijfers, beginnend met 06">
				<input type="text" name="email" placeholder="Email" value="<?php echo $data["email"]; ?>" class="form-control formm" >

				<br>
				<label for="adres"><b>Adres gegevens<b></label>
				<input type="text" name="adres" placeholder="Adres" value="<?php echo $data["adres"]; ?>" class="form-control formm" >
				<input type="text" name="postcode" placeholder="Postcode" value="<?php echo $data["postcode"]; ?>" class="form-control formm" pattern="[0-9]{4}[A-Z]{2}" title="Een postcode bestaat uit 4 cijfers en 2 hoofdletters.">
				<input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php echo $data["woonplaats"]; ?>" class="form-control formm">
				<br>
				 <input type="checkbox" id="adminrechten" name="adminrechten" value="1" 
				<?php if($data["admin"] == 1) { echo "checked"; }?>>
					<label for="adminrechten"><b>Adminrechten toekennen</b></label>
					<br>
                        <button type="submit" class="btn btn-outline-dark" name="submit" ><i class="far fa-save"></i> Opslaan</button>

			

  </div>
		   </form>
		<?php } ?>
		 
		   </div>
        </div>
		</div>
       


<?php include '../includes/content/adminfooter.php';