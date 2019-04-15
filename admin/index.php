<?php 
require_once '../includes/site.config.php';
$date = date("Y-m-d");
include '../includes/admincheck.php';
include '../includes/content/adminmenu.php';

if(isset($_POST["submit"])) {
	
			$planeid = $_POST["planeid"];
			$to = $_POST["to"];
			$from = $_POST["from"];
			$date1 = $_POST["date"];
			$pilotid = $_POST["pilotid"];
			$catering = $_POST["catering"];

			try {
				$sql = "INSERT INTO `flights` (`planeid`, `to`, `from`, `date`, `pilotid`, `catering`) VALUES (:planeid, :to, :from, :date1, :pilotid, :catering);";

				$stmt = $db->prepare($sql);
				$stmt->bindValue(':planeid', $planeid);
				$stmt->bindValue(':to', $to);
				$stmt->bindValue(':from', $from);
				$stmt->bindValue(':date1', $date1);
				$stmt->bindValue(':pilotid', $pilotid);
				$stmt->bindValue(':catering', $catering);
				

				$result = $stmt->execute();
			
	} catch(PDOException $e) {
        echo "An error occured reading table!"; 
        echo $e->getMessage();                   
    }
    if($result){
      
	
		
		header("location: index.php?succes=ja");
    }
}

 ?>

<div class="container woohoo">    
  <div class="row">
    <div class="col-sm-4 ">
		<h1>Airtastic Admin</h1>
		<hr>
		<div class="alert alert-info">
		Hier zie je een overzicht van alle vluchten van vandaag.
		</div>
	
		<h2>Vlucht aanmaken</h2>
		<hr>
		<form class="form-group" method="post">
		<label for="vertrek"><i class="fas fa-plane-departure"></i> Vanaf</label>
                        <select required name="from" class="form-control">
                           			<?php $query = $db->prepare("SELECT * FROM `airports` WHERE disabled = '0' ORDER by land, naam ASC");
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as &$data) { ?>
						 <option value="<?php echo $data["abbr"]; ?>"><?php echo $data["naam"]; ?>, <?php echo $data["land"]; ?> </option>
						<?php } ?>

                        </select>
						<br>
						 <div class="form-group">

                        <label for="bestemming"><i class="fas fa-plane-arrival"></i> Naar</label>
                        <select required name="to" class="form-control">
						<?php $query = $db->prepare("SELECT * FROM `destinations` WHERE disabled = '0' ORDER by land, destination ASC");
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as &$data) { ?>
						 <option value="<?php echo $data["abbr"]; ?>"> <?php echo $data["destination"]; ?>, <?php echo $data["land"]; ?> </option>
						<?php } ?>

                           
                    

                        </select>


                    </div>
					 <div class="form-group">

                        <label for="piloot"><i class="fas fa-user-tie"></i> Piloot</label>
                        <select required name="pilotid" class="form-control">
						<?php $query = $db->prepare("SELECT * FROM `pilots` ORDER by naam ASC");
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as &$data) { ?>
						 <option value="<?php echo $data["id"]; ?>"> <?php echo $data["naam"]; ?></option>
						<?php } ?>

                           
                    

                        </select>


                    </div>
					 <div class="form-group">

                        <label for="vliegtuig"><i class="fas fa-plane"></i> Vliegtuig</label>
                        <select required name="planeid" class="form-control">
						<?php $query = $db->prepare("SELECT * FROM `planes` WHERE used = 1 ORDER by type, tailnumber ASC");
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as &$data) { ?>
						 <option value="<?php echo $data["id"]; ?>"> <?php echo $data["tailnumber"]; ?>, <?php echo $data["type"]; ?></option>
						<?php } ?>

                           
                    

                        </select>


                    </div>
					 <div class="form-group">

                        <label for="catering"><i class="fas fa-utensils"></i> Catering</label>
                        <select required name="catering" class="form-control">
					
						 <option value="1">Ja</option>
						 <option value="0">Nee</option>
						

                           
                    

                        </select>


                    </div>
		<div class="form-group">


                        <label for="heen"><i class="far fa-calendar-check"></i> Vertrek</label>
                        <input type="date" class="form-control" name="date" required value="<?php echo date('Y-m-d'); ?>"  min="<?php echo date('Y-m-d'); ?>">


                    </div>
					<button type="submit" class="btn btn-info" name="submit">Vlucht aanmaken</button>

		</form>
    </div>

    <div class="col-sm-8">
		<h2>Alle vluchten van vandaag</h2>
		
		<hr>
      <table class="table">
	  <thead class="thead-dark">
		<tr>
			<th>Vluchtnummer</th>
			<th>Bestemming</th>
			<th>Piloot</th>
			<th>Type vliegtuig</th>
			<th>Catering<th>
		</tr>
		</thead>
		<?php $query = $db->prepare("SELECT * , flights.id as flightsid FROM `flights` INNER JOIN planes ON planes.id = flights.planeid INNER JOIN destinations ON flights.to = destinations.abbr INNER JOIN pilots ON pilots.id = flights.pilotid WHERE flights.date = '$date' ORDER BY flightsid");
		
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
		 ?>
				<tr>
					<td><?php echo $data["from"] . "-" . $data["to"] . "-" . $data["flightsid"]; ?></td>
					<td><?php echo $data["destination"]; ?></td>
					<td><?php echo $data["naam"]; ?></td>
					<td><?php echo $data["type"]; ?></td>
					<td><?php  if($data["catering"] == 1) { echo "Ja"; } else { echo "Nee"; } ?></td>
				</tr>

		 <?php }
		?>
		</table>
		
    </div>
  </div>
</div>
<?php include '../includes/content/adminfooter.php';
?>


