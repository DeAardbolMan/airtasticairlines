<?php
require_once 'includes/site.config.php';
include 'includes/content/menu.php';
include 'includes/content/inloggen.php';
include 'includes/content/registreren.php';
?>

    <div class="jumbotron" id="topheader">
        <div class="header_text">
            <div class="header-logo"></div>
            <div class="logo-spacer"></div>
            <form method="post" action="zoekvlucht.php">
                <div class="container" id="topcontainer">
                    <h2>Plan je avontuur</h2>

                    <div class="form-group">

                        <label for="vertrek"><i class="fas fa-plane-departure"></i> Vanaf</label>
                        <select required name="vertrek">
                           			<?php $query = $db->prepare("SELECT * FROM `airports` WHERE disabled = '0' ORDER by land, naam ASC");
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as &$data) { ?>
						 <option value="<?php echo $data["abbr"]; ?>"><?php echo $data["naam"]; ?>, <?php echo $data["land"]; ?> </option>
						<?php } ?>

                        </select>


                    </div>
                    <div class="form-group">

                        <label for="bestemming"><i class="fas fa-plane-arrival"></i> Naar</label>
                        <select required name="bestemming" onclick="volgendeStap1();">
						<?php $query = $db->prepare("SELECT * FROM `destinations` WHERE disabled = '0' ORDER by land, destination ASC");
						$query->execute();
						$result = $query->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as &$data) { ?>
						 <option value="<?php echo $data["abbr"]; ?>"> <?php echo $data["destination"]; ?>, <?php echo $data["land"]; ?> </option>
						<?php } ?>

                           
                    

                        </select>


                    </div>


                </div>
                <div class="container" id="datum">


                    <div class="form-group">


                        <label for="heen"><i class="far fa-calendar-check"></i> Vertrek</label>
                        <input type="date" class="form-control formm" name="heen" required onclick="volgendeStap2();" value="<?php echo date('Y-m-d'); ?>"  min="<?php echo date('Y-m-d'); ?>">


                    </div>
                   


                </div>
                <div class="container" id="personen">


                    <div class="form-group">

                        <label for="volwassenen"><i class="fas fa-users"></i> Wie gaan er mee?</label>
                        <select required name="volwassenen">
                            <option value="1">1 volwassene</option>
                            <option value="2">2 volwassenen</option>
                            <option value="3">3 volwassenen</option>
                            <option value="4">4 volwassenen</option>
                            <option value="5">5 volwassenen</option>
                            <option value="6">6 volwassenen</option>
                            <option value="7">7 volwassenen</option>
                            <option value="8">8 volwassenen</option>
                        </select>


                        <label for="kinderen">&nbsp;</label>
                        <select required name="kinderen">
                            <option>Geen kinderen</option>
                            <option>1 kind</option>
                            <option>2 kinderen</option>
                            <option>3 kinderen</option>
                            <option>4 kinderen</option>
                            <option>5 kinderen</option>
                            <option>6 kinderen</option>
                            <option>7 kinderen</option>
                            <option>8 kinderen</option>
                        </select>


                    </div>

                </div>
                <div class="container" id="voltooi">


                    <div class="form-group">

                        <button type="submit" name="submit"><i class="fas fa-search-location"></i> Plan mijn avontuur</button>


                    </div>

                </div>

            </form>
        </div>
    </div>
    <main>
        <div class="container">
            <div class="row">

                <div class="col-sm-4">

                    <h3>Boek jou vlucht bij Airtastic</h3>
                    <p>Op zoek naar het beste begin van jouw vakantie? 
					Airtastic helpt jou met het vinden van die ene beste deal. 
					Thuis, op je werk of in de kroeg: boek jouw vakantie overal waar je maar wilt, want onze website is gebruiksvriendelijk 
					op desktop, tablet én mobiel. Om je op weg te helpen met het zoeken van de beste vlucht, beantwoorden we alvast <b>de meest gestelde vragen</b> bij het boeken van een vakantie.</p>

                </div>
                <div class="col-sm-4">
                    <h3> Waarom verschillen prijzen van vliegtickets?</h3>
                    <p>Hoeveel een ticket kost hangt af van heel veel factoren. Ten eerste bepaalt de airline zelf het tarief. Deze prijs verschilt per boekingsklasse. Als het nog lang duurt tot jouw vakantie, liggen de prijzen over het algemeen lager. In de week voor het vliegtuig vertrekt, gaan de prijzen omlaag of juist omhoog, afhankelijk van het doel van de airline (moet de vlucht vol of wordt er ook geld verdiend met een vlucht met lege stoelen?). Ook de vraag van de markt speelt een belangrijke rol. Andere factoren die van invloed zijn op de prijzen zijn veranderingen in brandstofkosten, luchthavenbelasting en onderhoudskosten.</p>
                </div>
                <div class="col-sm-4"> <h3>Comfortabele vluchten</h3>
                    <p>Bij Airtastic kan je gemakkelijk een vlucht boeken. Kies een bestemming en een vertrekplaats, een datum en geniet daarna van een comfortable vlucht naar jouw bestemming.</p>
					<p>Alle vluchten die langer dan anderhalf uur zijn inclusief catering, tenzij anders aangegeven. Het personeel staat de gehele vlucht voor je klaar. Op aankomst van je bestemming is er de mogelijkheid om een auto te huren of een taxi te nemen.</p>
                </div>
            </div>
        </div>
        <div class="container" id="topbestemmingen">
            <div class="row">
                <h2><i class="fas fa-plane-arrival"></i> Onze topbestemmingen</h2>
                <div class="col-sm-12">
                    <?php include 'includes/content/topbestemmingen.php'; ?>
                </div>
               

            
            </div>
        </div>

    </main>
<?php include 'includes/content/footer.php';