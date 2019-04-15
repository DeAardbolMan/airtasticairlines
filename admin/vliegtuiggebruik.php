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
		Hier zie je een overzicht van het gebruik per vliegtuig
		</div>
    </div>

    <div class="col-sm-8">
		<h2>Gebruik per vliegtuig</h2>
		<hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Aantal keer gebruikt</th>
			<th>Type</th>
			<th>Staartnummer</th>

		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT COUNT(tailnumber) as total,tailnumber,type FROM `planes` INNER JOIN flights ON flights.planeid = planes.id GROUP BY tailnumber ORDER BY total DESC");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			echo "
				<tr>
					<td>" . $data["total"] . "</td>
					<td>" . $data["type"] . "</td>
					<td>" . $data["tailnumber"] . "</td>

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


