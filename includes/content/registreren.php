<?php 
	if(isset($_POST["submit1"])) { ?>
			<script type="text/javascript">
    $(window).on('load',function(){
        $('#registreren').modal('show');
    });
</script>
	<?php 
			$voornaam = $_POST["voornaam"];
			$email = $_POST["email"];
			$pass1 = $_POST["pass1"];
			$pass2 = $_POST["pass2"];
			$query = $db->prepare("SELECT count(email) as num FROM `users` WHERE email = :email");
			$query->bindValue(':email', $email);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if($row['num'] > 0){
				$error = "Dit emailadres is al in gebruik";
			}
			if ($pass1 != $pass2) {
				$error = "Wachtwoorden zijn niet hetzelfde.";
			}
			if(!isset($error)) {
				$pass = password_hash($pass1, PASSWORD_BCRYPT);
				$sql = "INSERT INTO users (voornaam, password, email) VALUES (:voornaam, :password, :email)";
				$stmt = $db->prepare($sql);

				$stmt->bindValue(':voornaam', $voornaam);
				$stmt->bindValue(':password', $pass);
				$stmt->bindValue(':email', $email);
				
				$result = $stmt->execute();
			
   
    if($result){
        $_SESSION["user"] = $email;
	
		
		header("location: instellingen.php");
    }
			}
			
	
	}
?>
<div class="modal fade" id="registreren" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Airtastic</h4>
        </div>
        <div class="modal-body">
		<?php
		 if(isset($error)) {
				echo "<div class='alert alert-warning'><p><b>$error</b></p></div>";
				
			}
		?>
          <p>Met een account op Airtastic kan je jouw boeking beheren of bijvoorbeeld snel en eenvoudig een vlucht boeken</p>
		    <form method="post">
			 <div class="form-group">
						<label for="voornaam">Vul hier je voornaam in</label>
                        <input type="text" class="form-control formm" placeholder="Voornaam" name="voornaam" required><br>
						<label for="email">Vul hier je emailadres in</label>
						<input type="email" class="form-control formm" placeholder="Emailadres" name="email" required><br>
						<label for="pass1">Kies een wachtwoord</label>
                        <input type="password" class="form-control formm" placeholder="Wachtwoord" name="pass1" required>
						<input type="password" class="form-control formm" placeholder="Wachtwoord herhalen" name="pass2" required>

                </div>
			
        </div>
        <div class="modal-footer">
                             <button type="submit" class="btn btn-default" name="submit1"><i class="fas fa-user"></i> Registreer een account</button>
</form>
        </div>
      </div>
      
    </div>
	</div>
