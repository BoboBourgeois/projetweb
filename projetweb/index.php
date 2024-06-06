<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville de Ndéré </title>
	<link rel="icon" href="images/logo.jpg">
	<link rel="stylesheet" href="style1.css">
</head>
<body>
    <!-- code pour charger un menu -->
	<header>
		<nav>
			<a href="index.php">Accueil</a> 
			<a href="reservation.php">Réservation</a>
			<a href="tarif.php">Tarif des table&tentes</a>
		</nav>
		<button type="button" aria-label="toggle curtain navigation" class="nav_toggle">
			<span class="line l1"></span>
			<span class="line l2"></span>
			<span class="line l3"></span>
		</button>
	</header>

	<section class="home">
		<h1>Reservation des table&tentes <br> 
			<a href="connexion.php"><img src="images/logo.jpg" alt=""></a>Ville de Ndéré
		</h1>
	</section>

	<!-- code pour charger un slider -->
	<div class="slogan">
		<h1>Reservation en toute securité!</h1>
	</div>
	
	<div class="container">
		<img id="img" src="images/grille1.jpg" >
		
		<a class="prev" onclick="plusslides(-1)">&#10094</a>
		<a class="next" onclick="plusslides(1)">&#10095</a>	
	</div>
	<!-- code pour le corps de la page -->

	<aside class="comment">
		<h1>BIENVENU(E) Dans <em>la ville de Ndéré</em></h1>
		<p>
			Nous vous remercions d'avoir choisi notre resto <br>
			Pourquoi cette page? <br>
			Dans le but de faciliter la réservation des table&tentes, Resto Ndéré met cette page en ligne pour que chaque reservateur
			puisse faire une réservation sans attendre en étant dans n'importe quel endroit. <br>
			Cher Client merci de bien vouloir cliquer sur le menu en haut de la page afin de réserver ou de consulter nos tarifs de table&tente.
		</p> <br>
		<h1>Nos Contacts</em></h1>
		<p>Cameroun-Ngaoudéré</p>
		<p>+237 6556689640 | +237 65000000</p>
		<p>Contacter nous par mail : <a href="mailto:burrowskms@gmail.com">burrowskms@gmail.com</a></p>
		<p>Liens : </p>
	</aside>
	
	<form action="" method="post">
		<h2>Vous pouvez laisser un commentaire ou une suggestion !</h2><br>
		<p>Titre <br>
			<input type="text" name="titre" required/> 
		</p>
		<p>
			<label for="commentaire">Commentaire</label> <br/>
			<textarea name="commentaire" id="commentaire" required></textarea> 
		</p>
		<input type="submit" value="Soumettre" name="Suggerer" id="Suggerer" />
	</form>
	<?php
		if (isset($_POST['titre']) AND isset($_POST['commentaire']))
		{
			try
			{
				$BD = new PDO('mysql:host=localhost;dbname=univ_ndere','root','');
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getmessage());
			}

			//On ajoute une entrée dans la table commentaires
			$req = $BD->prepare('INSERT INTO commentaires(titre, contenu) VALUES(?, ?)');
			$req->execute(array($_POST['titre'], $_POST['commentaire']));
			$req->closeCursor();
			header('Location: index.php');
		}
	?>

	<footer>
		<p>Copyright Avril 2024 <br> Groupe 3 projet 11 | tous droits reservés!</p>
	</footer>
	<script src="code.js"></script>
</body>
</html>