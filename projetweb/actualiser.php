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
            //on recupere la classe de la tabtente
            $tout = $BD->prepare('SELECT classe FROM tabtente WHERE id_tabtente = ?');
            $tout->execute(array($_SESSION['x']));
            $b = $tout->fetch();
            $tout->closeCursor();

            if($b['classe']=='VIP'){
                //modification du nombre de place dans la table tabtente
                $mod = $BD->prepare('UPDATE tabtente SET nb_reservation = ? WhERE id_tabtente = ? ');
                $mod->execute(array(10, $_SESSION['x']));
                $mod->closeCursor();
            } else {
                //modification du nombre de place dans la table tabtente
                $mod = $BD->prepare('UPDATE tabtente SET nb_reservation = ? WhERE id_tabtente = ? ');
                $mod->execute(array(30, $_SESSION['x']));
                $mod->closeCursor();
            }

            header('Location:tabtente.php');
        } else {
            header('Location:tabtente.php');
        }
    } else {
        $_SESSION['x']= (int) $_GET['x'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation des table&tentes</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <form action="" method="post">
        <p>Voulez-vous vraiment acutualiser le nombre de Reservation?</p>
        <input type="submit" value="Oui" name="oui">
        <input type="submit" value="Non" name="non">
    </form>
</body>
</html>
<?php
}
?>