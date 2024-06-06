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

            //On supprime l'administrateur
            $sup = $BD->prepare('DELETE FROM administrateur WhERE id = ? ');
            $sup->execute(array($_SESSION['val']));
            $sup->closeCursor();

            header('Location:gereradmin.php');
        } else {
            header('Location:gereradmin.php');
        }
    } else {
        $_SESSION['val']= (int) $_GET['val'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>traitement</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <form action="" method="post">
        <p>Voulez-vous vraiment supprimer l'administrateur?</p>
        <input type="submit" value="Oui" name="oui">
        <input type="submit" value="Non" name="non">
    </form>
</body>
</html>
<?php
}
?>