<?php
if (isset($_POST["submit2"])) { ?>
    <script type="text/javascript">
        $(window).on('load', function () {
            $('#inloggen').modal('show');
        });
    </script>
    <?php
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $query = $db->prepare("SELECT count(email) as num FROM `users` WHERE email = :email");
    $query->bindValue(':email', $email);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row['num'] != 1) {
        $error = "Dit emailadres bestaat niet.";
    }


    $sql = "SELECT email, password, id FROM users WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindValue(':email', $email);


    $query->execute();

    $data = $query->fetch(PDO::FETCH_ASSOC);


    if ($data === false) {

        $error = "Emailadres niet gevonden";
    } else {


        if (password_verify($pass, $data['password'])) {

            $_SESSION['user'] = $data['email'];
		

            header('Location: index.php');


        } else {
            $error = "Onjuist wachtwoord";

        }
    }


}
?>
<div class="modal fade" id="inloggen" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Airtastic</h4>
            </div>
            <div class="modal-body">
                <?php
                if (isset($error)) {
                    echo "<div class='alert alert-warning'><p><b>$error</b></p></div>";

                }
                ?>
                <p>Met een account op Airtastic kan je jouw boeking beheren of bijvoorbeeld snel en eenvoudig een vlucht
                    boeken</p>
                <form method="post">
                    <div class="form-group">

                        <label for="email">Vul hier je emailadres in</label>
                        <input type="email" class="form-control formm" placeholder="Emailadres" name="email"
                               required><br>
                        <label for="pass1">Vul hier je wachtwoord in</label>
                        <input type="password" class="form-control formm" placeholder="Wachtwoord" name="pass" required>


                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" name="submit2"><i class="fas fa-user"></i> Inloggen
                </button>
                </form>
            </div>
        </div>

    </div>
</div>
