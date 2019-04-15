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
		Hier zie je een overzicht van de meest geboekte vluchten
		</div>
    </div>

    <div class="col-sm-8">
		 <h2>Meest geboekte vluchten</h2>
		 <hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Aantal boekingen</th>
			<th>Bestemming</th>

		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT COUNT(*) as total,destination FROM `flights` INNER JOIN booking ON booking.flightid = flights.id INNER JOIN planes ON planes.id = flights.planeid INNER JOIN destinations ON flights.to = destinations.abbr INNER JOIN pilots ON pilots.id = flights.pilotid GROUP BY destination ORDER BY total DESC");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			echo "
				<tr>
					<td>" . $data["total"] . "</td>
					<td>" . $data["destination"] . "</td>

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


