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
            //modification de la validation dans la table reservation
            $mod = $BD->prepare('UPDATE reservation SET valide = ? WhERE id_reser = ? ');
            $mod->execute(array(true, $_SESSION['id']));
            $mod->closeCursor();
            
            echo 'Réservation validée';
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
    <form action="validation.php" method="post">
        <p>Voulez-vous vraiment confimer cette réservation?</p>
        <input type="submit" value="Oui" name="oui">
        <input type="submit" value="Non" name="non">
    </form>
</body>
</html>
<?php
}
?>