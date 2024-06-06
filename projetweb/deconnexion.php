<?php
	session_start();
	if ($_SESSION['Connexion']==true) {
		# code...
		session_destroy();
		header('Location:index.php');
	} else {
        header('Location:connexion.php');
    }
?>