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
		Hier zie je een overzicht van alle vliegtuigen
		</div>
    </div>

    <div class="col-sm-8">
		<h2>Overzicht van alle vliegtuigen</h2>
		<hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Staartnummer</th>
			<th>Type</th>
			
			<th>Capaciteit</th>
			<th>Status</th>
			
		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT * FROM `planes` ORDER BY used desc");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
			if ($data["used"] == 1) {
			echo "
			
				<tr>
					<td><b>" . $data["tailnumber"] . "</b></td>
					<td>" . $data["type"] . "</td>
					
					<td>". $data["capacity"] . "</td>
					<td>In gebruik</td>
					
				</tr>
			";
			} else {
				echo "
			
				<tr bgcolor='#D00000' style='color: #fff;'>
					<td><b>" . $data["tailnumber"] . "</b></td>
					<td>" . $data["type"] . "</td>
				
					<td>". $data["capacity"] . "</td>
					<td>Buiten gebruik</td>
					
				</tr>
			";
			}
		}
		?>
		</table>
    </div>
  </div>
</div>
<?php include '../includes/content/adminfooter.php';
?>


