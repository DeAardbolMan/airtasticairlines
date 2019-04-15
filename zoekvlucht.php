<?php
require_once 'includes/site.config.php';
if(!isset($_POST["submit"])) {
	header("location: index");
	die();
} else {
	$destination = $_POST["bestemming"];
	$airport = $_POST["vertrek"];
	$date = $_POST["heen"];
}
include 'includes/content/menu.php';
include 'includes/content/inloggen.php';
include 'includes/content/registreren.php';
?>

 
    <main style="margin-top: 80px;">
       
        <div class="container" id="topbestemmingen">
            <div class="row">
                <h2><i class="fas fa-plane-arrival"></i> Vluchten</h2>
               
                <div class="col-sm-12">
                    <table class="table table-hover">


                        <thead>
                        <th><i class="fas fa-plane-arrival"></i></th>
                        <th><i class="fas fa-plane-departure"></i></th>
						<th>Vertrek datum</th>
                        <th></th>
                        </thead>
                        <tbody>
                        <?php $query = $db->prepare("SELECT * , flights.id as flightsid, airports.naam as airport FROM `flights` 
						INNER JOIN planes ON planes.id = flights.planeid INNER JOIN destinations ON flights.to = destinations.abbr 
						INNER JOIN airports ON flights.from = airports.abbr INNER JOIN pilots ON pilots.id = flights.pilotid
						WHERE date = :date AND airports.abbr = :airport AND destinations.abbr = :destination ORDER BY date");
						$query->bindValue(':destination', $destination);
		$query->bindValue(':date', $date);
		
		$query->bindValue(':airport', $airport);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($result)) {
		foreach($result as &$data) {
		 ?>
				<tr>
					<td><?php echo $data["airport"]; ?></td>
					<td><?php echo $data["destination"]; ?></td>
					<td><?php echo $data["date"]; ?></td>
					<?php if (isset($_SESSION["user"])) { ?>
					<td><a href="boekvlucht.php?flight=<?php echo $data["flightsid"];?>&ap=<?php echo $_POST["volwassenen"]; ?>"><i class="fas fa-angle-double-right"></i> Boek deze vlucht</a></td>
					 <?php } else { ?>
                   <td> <a data-toggle="modal" data-target="#registreren">
                            Registreren</a> of <a data-toggle="modal" data-target="#inloggen"> Inloggen</a></td>
                <?php } ?>
				</tr>

		 <?php }
		} else { ?>
			<tr>
			<td><b>Er zijn geen vluchten gevonden die aan je zoekcriteria voldoen</b></td>
			</tr>
			 <?php $query = $db->prepare("SELECT * , flights.id as flightsid, airports.naam as airport FROM `flights` 
						INNER JOIN planes ON planes.id = flights.planeid INNER JOIN destinations ON flights.to = destinations.abbr 
						INNER JOIN airports ON flights.from = airports.abbr INNER JOIN pilots ON pilots.id = flights.pilotid
						WHERE destinations.abbr = :destination AND date >= :date ORDER BY date");
		$query->bindValue(':destination', $destination);
		$query->bindValue(':date', $date);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as &$data) {
		 ?>
				<tr>
					<td ><?php echo $data["airport"]; ?></td>
					<td><?php echo $data["destination"]; ?></td>
					<td><?php echo $data["date"]; ?></td>
					<?php if (isset($_SESSION["user"])) { ?>
					<td><a href="boekvlucht.php?flight=<?php echo $data["flightsid"];?>&ap=<?php echo $_POST["volwassenen"]; ?>"><i class="fas fa-angle-double-right"></i> Boek deze vlucht</a></td>
					 <?php } else { ?>
                    <td><a data-toggle="modal" data-target="#registreren">
                            Registreren</a> of <a data-toggle="modal" data-target="#inloggen"> Inloggen</a></td>
                <?php } ?>
	
				</tr>

		 <?php } ?>
			</tr>
		<?php }?>
                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>

    </main>
<?php include 'includes/content/footer.php';