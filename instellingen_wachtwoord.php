<?php
require_once 'includes/site.config.php';
require_once 'includes/logincheck.php';

include 'includes/content/menu.php';

if(isset($_POST["submit"])) {
	$email = $_SESSION["user"];
	$ww1 = $_POST["ww1"];
	$ww2 = $_POST["ww2"];
	$ww3 = $_POST["ww3"];
	
	$sql = "SELECT password, id FROM users WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindValue(':email', $email);
	
	$query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);


	 $userid = $data['id'];
        if (password_verify($ww1, $data['password'])) {
			
			if($ww2 == $ww3) {

           $pass = password_hash($ww2, PASSWORD_BCRYPT);
			$sql = "UPDATE users SET password = :password WHERE id = :id";
				$stmt = $db->prepare($sql);

				$stmt->bindValue(':password', $pass);
				$stmt->bindValue(':id', $userid);

				$result = $stmt->execute();
   
    if($result){
		header("location: succes.php?logout=true");
    } 

			} else {
				$error = "Wachtwoorden zijn niet hetzelfde";
			}
        } else {
            $error = "Onjuist wachtwoord";

        }
    
	
}
?>

    <div class="spacer"></div>
    <main>
        <div class="container">
           <div class="row">
		   <div class="col-sm-8">
		   <h2><i class="fas fa-sliders-h"></i> Instellingen</h2>
			<?php
                if (isset($error)) {
                    echo "<div class='alert alert-warning'><p><b>$error</b></p></div>";

                }
                ?>
		   <form method="post">
		   <div class="form-group">
			
				<label for="ww1">Wachtwoord wijzigen</label>
				<input type="password" name="ww1" placeholder="Oud wachtwoord" class="form-control formm" required>
				<input type="password" name="ww2" placeholder="Nieuw wachtwoord" class="form-control formm" required>
				<input type="password" name="ww3" placeholder="Nieuw wachtwoord herhalen" class="form-control formm" required>

                        <button type="submit" class="btn btn-default" name="submit" ><i class="far fa-save"></i> Opslaan</button>

			


		   </form>
	
		   </div>
		   </div>
		   <div class="col-sm-4 text-left" >
		   <h2 class="text-left">Overige instellingen</h2>
		 <ul>
		   <li><a href="instellingen.php">Algemene instellingen</a></li></ul>
		   </div>
        </div>
       

    </main>
<?php include 'includes/content/footer.php';