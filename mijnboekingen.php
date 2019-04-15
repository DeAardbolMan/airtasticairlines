<?php
require_once 'includes/site.config.php';
require_once 'includes/logincheck.php';
include 'includes/content/menu.php';

?>

 
    <main style="margin-top: 80px;">
       
        <div class="container" id="topbestemmingen">
            <div class="row">
                <h2><i class="fas fa-plane-arrival"></i>Mijn Boekingen</h2>
               
                <div class="col-sm-12">
                    <table class="table table-hover">


                        <thead>
                        <th><i class="fas fa-plane-arrival"></i></th>
                        <th><i class="fas fa-plane-departure"></i></th>
						<th>Vertrek datum</th>
						<th>Aantal personen</th>
                        
                        </thead>
                        <tbody>
                        <?php $query = $db->prepare("SELECT * , flights.id as flightsid, airports.naam as airport FROM `flights` 
						INNER JOIN planes ON planes.id = flights.planeid INNER JOIN destinations ON flights.to = destinations.abbr 
						INNER JOIN airports ON flights.from = airports.abbr INNER JOIN booking on flights.id = booking.flightid
						WHERE date >= :date AND booking.userid = :userid ORDER BY date LIMIT 5");
					
		$query->bindValue(':date', date('Y-m-d'));
		
		$query->bindValue(':userid', userData('id'));
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as &$data) {
		 ?>
				<tr>
					<td><?php echo $data["airport"]; ?></td>
					<td><?php echo $data["destination"]; ?></td>
					<td><?php echo $data["date"]; ?></td>
					<td><?php echo $data["aantalpers"]; ?></td>
				
				</tr>

		 <?php } ?>
                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>

    </main>
<?php include 'includes/content/footer.php';