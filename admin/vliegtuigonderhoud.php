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
		Hier zie je een overzicht van het onderhoud per vliegtuig
		</div>
    </div>

    <div class="col-sm-8">
		<h2>Onderhoud per vliegtuig</h2>
		<hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Laatste onderhoud</th>
			<th>Type</th>
			<th>Staartnummer</th>
			<th>Volgend onderhoud</th>
			<th>Opmerkingen</th>

		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT * FROM `planes` LEFT JOIN maintenance ON planes.id = maintenance.planeid ORDER BY nextdate ASC");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			echo "
				<tr>
					<td>" . $data["lastdate"] . "</td>
					<td>" . $data["type"] . "</td>
					<td>" . $data["tailnumber"] . "</td>
					<td>" . $data["nextdate"] . "</td>
					<td>" . $data["changes"] . "</td>

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


