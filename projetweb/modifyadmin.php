<?php
    session_start();
    $_SESSION['val']= (int) $_GET['val'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un admin</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="gereradmin.css">
</head>
<body>
    <div class="interne">
        <a href="gereradmin.php" style="font-size: 30px; color: green;">Abandonner</a>
    </div>
    <div>
        <form action="" method="post">
            <legend>Modifier un administrateur</legend>

            <p class="ligne">Mot de passe </p>
            <input type="password" name="mot" placeholder="password" required>

            <p class="ligne">Email </p>
            <input type="email" name="email" placeholder="Ex: nom@gmail.com"/>
            
            <p class="ligne">Numéro de télephone </p>
            <input type="tel" name="tel" placeholder="Ex: 237 000000000" required />

            <input type="submit" value="Modifier" name="modifier" class="envoi"/>
        </form>
    </div>
    <?php
        if(isset($_POST['modifier'])){
            try
            {
                $BD = new PDO('mysql:host=localhost;dbname=univ_ndere','root','');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getmessage());
            }
            //modification dans la table administrateur
            $mod = $BD->prepare('UPDATE administrateur SET email = ?, tel = ?, motdepasse = ? WhERE id = ? ');
            $mod->execute(array($_POST['email'], $_POST['tel'], $_POST['mot'], $_SESSION['val']));
            $mod->closeCursor();
            header('Location:gereradmin.php');        
        }
    ?>
</body>
</html>