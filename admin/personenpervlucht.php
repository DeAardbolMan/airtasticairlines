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
		Hier zie je een overzicht van alle vluchten van vandaag.
		</div>
    </div>

    <div class="col-sm-8">
		<h2>Personen per vlucht</h2>
		<hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>	
			<th>Vluchtnummer</th>
			<th>Aantal personen</th>
			<th>Staartnummer</th>
			<th>Bestemming</th>

		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT sum(booking.aantalpers) as total, destination,tailnumber, flightid FROM `booking` INNER JOIN users ON booking.userid = users.id INNER JOIN flights ON flights.id = booking.flightid INNER JOIN destinations ON flights.to = destinations.abbr INNER JOIN planes ON planes.id = flights.planeid GROUP BY booking.flightid ORDER BY total DESC");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			echo "
				<tr>
					<td>" . $data["flightid"] . "</td>
					<td>" . $data["total"] . "</td>
					<td>" . $data["tailnumber"] . "</td>
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


