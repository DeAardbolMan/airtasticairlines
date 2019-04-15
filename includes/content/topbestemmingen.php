<table class="table table-hover">


    <thead class="thead-dark">
	<th></th>
    <th><i class="fas fa-plane-arrival"></i> Bestemming</th>
    <th><i class="fas fa-plane-departure"></i> Vertrek</th>
    
    </thead>
    <tbody>
	<?php $query = $db->prepare("SELECT COUNT(*) as total,destination, airports.naam as vertrek FROM `flights` INNER JOIN booking ON booking.flightid = flights.id INNER JOIN planes ON planes.id = flights.planeid 
	INNER JOIN destinations ON flights.to = destinations.abbr
	INNER JOIN airports ON flights.from = airports.abbr
	INNER JOIN pilots ON pilots.id = flights.pilotid 
	GROUP BY destination ORDER BY total DESC");
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$x = 1;
		foreach($result as &$data) {
			echo "
				<tr>
					<td>"  . $x  . ".</td>
					<td><b>" . $data["destination"] . "</b></td>
					<td>" . $data["vertrek"] . "</td>

				</tr>
				
				
			";
			$x++;
		}
		?>
   
  
    </tbody>
</table>