<?php
    session_start();
    if(isset($_POST['oui']) || isset($_POST['non'])){
        try
        {
            $BD = new PDO('mysql:host=localhost;dbname=univ_ndere','root','');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getmessage());
        }
        if(isset($_POST['oui'])){
            //on recupere l'id du client
            $tout = $BD->prepare('SELECT id_client FROM faire WHERE id_reser = ?');
            $tout->execute(array($_SESSION['id']));
            $b = $tout->fetch();
            $tout->closeCursor();

            //On supprime la réservation dans la table faire
            $sup = $BD->prepare('DELETE FROM faire WhERE id_reser = ? ');
            $sup->execute(array($_SESSION['id']));
            $sup->closeCursor();

            //on recupere l'id du paiement
            $req = $BD->prepare('SELECT id_paie FROM reservation WHERE id_reser = ?');
            $req->execute(array($_SESSION['id']));
            $x = $req->fetch();
            $req->closeCursor();

            //On supprime la réservation dans la table reservation
            $mod = $BD->prepare('DELETE FROM reservation WhERE id_reser = ? ');
            $mod->execute(array($_SESSION['id']));
            $mod->closeCursor();

            //On supprime dans la table client
            $mod = $BD->prepare('DELETE FROM client WhERE id_client = ? ');
            $mod->execute(array($b['id_client']));
            $mod->closeCursor();

            //On supprime dans la table paiement
            $mod = $BD->prepare('DELETE FROM paiement WhERE id_paie = ? ');
            $mod->execute(array($x['id_paie']));
            $mod->closeCursor();
            
            echo 'Réservation supprimée';
            header('Location:admin.php');
        } else {
            header('Location:admin.php');
        }
    } else {
        $_SESSION['id']= (int) $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validation</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <form action="" method="post">
        <p>Voulez-vous vraiment supprimer cette réservation?</p>
        <input type="submit" value="Oui" name="oui">
        <input type="submit" value="Non" name="non">
    </form>
</body>
</html>
<?php
}
?>