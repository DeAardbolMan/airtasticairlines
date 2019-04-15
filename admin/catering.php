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
		Hier zie je een overzicht van alle komende vluchten met catering.
		</div>
    </div>

    <div class="col-sm-8">
		<h2>Vluchten met catering</h2>
		<hr>

      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Vluchtnummer</th>
			<th>Bestemming</th>
			<th>Piloot</th>
			<th>Type vliegtuig</th>
			<th>Datum<th>
		</tr>
		</thead>
		
		<?php $query = $db->prepare("SELECT *, flights.id as flightsid FROM `flights` LEFT JOIN booking ON booking.flightid = flights.id INNER JOIN planes ON planes.id = flights.planeid INNER JOIN destinations ON flights.to = destinations.abbr LEFT JOIN pilots ON pilots.id = flights.pilotid WHERE catering = '1' AND date >= '$date'");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			echo "
				<tr>
					<td>" . $data["from"] . "-" . $data["to"] . "-" . $data["flightsid"] . "</td>
					<td>" . $data["destination"] . "</td>
					<td>" . $data["naam"] . "</td>
					<td>" . $data["type"] . "</td>
					<td>" . $data["date"] . "</td>
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


