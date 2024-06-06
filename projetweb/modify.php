<?php
    session_start();
    $_SESSION['x']= (int) $_GET['x'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification des table&tentes</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="gereradmin.css">
</head>
<body>
    <div class="interne">
        <a href="tabtente.php" style="font-size: 30px; color: green;">Abandonner</a>
    </div>
    <div>
        <form action="" method="post">
            <legend>Ajouter un table&tente</legend>

            <p class="ligne">Choix table&tente </p>
            <select name="ville" class="colonne">
                <option>Ceremonie de mariage</option>
                <option selected>Ceremonie de consert</option>
               

            </select> 

            <p class="ligne">CLASSE DE RESERVATION </p>
            <select name="destination" class="colonne">
            
                <option>Commerciale</option>
                <option selected>VIP</option>
                
            </select>
                    
            <p class="ligne">Horaire </p>
            <input type="datetime-local" name="horaire" required />

            <p class="ligne">Prix </p>
            <input type="number" name="prix" placeholder="entrer le prix" required />

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
            //modification dans la table tabtente
            $mod = $BD->prepare('UPDATE tabtente SET horaire = ?, prix = ?, ville_demande = ?, destination = ? WhERE id_tabtente = ? ');
            $mod->execute(array($_POST['horaire'], $_POST['prix'], $_POST['ville'], $_POST['destination'], $_SESSION['x']));
            $mod->closeCursor();
            header('Location:tabtente.php');        
        }
    ?>
</body>
</html>