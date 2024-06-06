<?php
session_start();
if (isset($_SESSION['Connexion'])) 
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
		<h1>Reservation des table&tentes <br> 
			<img src="images/logo.jpg" alt="">Ville de Ndéré
		</h1>
		<div>
			<p>
				<span> <?php echo $_SESSION['nom'] .' '; ?> </span>
				<span> <?php echo $_SESSION['prenom']; ?></span>
			</p>
			<button> <a href="deconnexion.php" title="cliquez ici">Déconnexion</a> </button>
		</div>
	</header>
	<?php
		if($_SESSION['email']=='burrowskms@gmail.com'){
	?>
			<nav>
				<a href="admin.php">Accueil</a>
				<a href="gereradmin.php">Gestion des administrateurs</a>
				<a href="tabtente.php">Gestion des table&tentes</a>
				<a href="historique.php">Historique</a>
			</nav>
	<?php
		} else {
	?>
			<nav>
				<a href="admin.php">Accueil</a>
				<a href="tabtente.php">Gestion des table&tentes</a>
				<a href="historique.php">Historique</a>
			</nav>
	<?php
		}
	?>

	<div class="bloc">
		<?php
			try
			{
				$BD = new PDO('mysql:host=localhost;dbname=univ_ndere','root','');
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getmessage());
			}
		?>

		<h2> Les réservations à valider ou à rejeter </h2>
			
		<?php
			$reponse=$BD->query('SELECT * FROM reservation WHERE valide = "0"');
			while ($data=$reponse->fetch())
			{
		?>
		<div class="interne">
		<?php
			//
			$rest = $BD->prepare('SELECT tel_paie FROM paiement WHERE id_paie= ?');
			$rest->execute(array($data['id_paie']));
			$n = $rest->fetch();
			$rest->closeCursor();
			//
			$req = $BD->prepare('SELECT * FROM tabtente WHERE id_tabtente= ?');
			$req->execute(array($data['id_tabtente']));
			$x = $req->fetch();
			$req->closeCursor();
			echo 'Le numéro de paiement est: ' .$n['tel_paie'] .' pour un ' .$data['style'] .' de ' .$x['ville_demande'] .' à ' 
			.$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservatuon'] .'<br>';
			?>
			<button><a href="validation.php?id=<?php echo $data['id_reser']; ?>">valider</a></button>
			<button><a href="validation2.php?id=<?php echo $data['id_reser']; ?>">supprimer</a></button>
		</div>
		<?php
		}
		?>
	</div>

    <footer>
		<p>Copyright Avril 2024 <br> Groupe 3 projet 11 | tous droits reservés!</p>
	</footer>
</body>
</html>
<?php
}
else
{
	header('Location:connexion.php');
}
?>