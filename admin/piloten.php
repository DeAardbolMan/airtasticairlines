<?php 
require_once '../includes/site.config.php';
$date = date("Y-m-d");
include '../includes/admincheck.php';
include '../includes/content/adminmenu.php';
 ?>

<div class="container woohoo">    
  <div class="row">
    <div class="col-sm-4 ">
		<h1>Airtastic Admin</h1>
		<hr>
		<div class="alert alert-info">
		Hier zie je een overzicht van alle piloten van Airtastic
		</div>
    </div>

    <div class="col-sm-8">
	<h2>Overzicht van alle piloten</h2>
	<hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Naam</th>
			<th>Telefoonnummer</th>
			<th>Email<th>
		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT * FROM `pilots`");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			echo "
				<tr>
					<td>" . $data["naam"] . "</td>

					<td>+31" . $data["telefoon"] . "</td>
					<td>" . $data["mail"] . "</td>
				</tr>
			";
		}
		?>
		</table>
    </div>
  </div>
</div>

<?php include '../includes/content/adminfooter.php';
?>


