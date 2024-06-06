<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des table&tentes</title>
    <link rel="icon" href="images/logo.jpg">
    <link rel="stylesheet" href="gereradmin.css">
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

    <nav>
		<a href="admin.php">Retour en arrière</a>
	</nav>
	<div>
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
		<p class="trouve">Prenez un raccourci pour
			<a href="#ancre" class="lien" title="Cliquez ici">ajouter un administrateur !</a>
		</p>
		<h2> Liste des administrateurs </h2>
		<?php
			$reponse=$BD->query('SELECT * FROM administrateur');
			while ($donnees=$reponse->fetch())
			{
		?>
			<div class="interne">
            <?php
				echo 'Nom et prénom: ' .$donnees['nom'] .' ' .$donnees['prenom'] .' email: ' .$donnees['email'] .' numéro: ' .$donnees['tel'] .'<br>';
			?>
				<button><a href="modifyadmin.php?val=<?php echo $donnees['id']; ?>">modifier</a></button>
				<button><a href="traitetement.php?val=<?php echo $donnees['id']; ?>">supprimer</a></button>
			</div>
		<?php
			}
		?>

        <form action="" method="post" id="ancre">
            <legend>Ajouter un administrateur</legend>

            <p class="ligne">Nom </p>
            <input type="text" name="nom" placeholder="nom" required/> 
            
            <p class="ligne">Prénom </p>
            <input type="text" name="prenom" placeholder="prenom" required/>

            <p class="ligne">Mot de passe </p>
            <input type="password" name="mot" placeholder="password" required>

            <p class="ligne">Email </p>
            <input type="email" name="email" placeholder="Ex: nom@gmail.com"/>
            
            <p class="ligne">Numéro de télephone </p>
            <input type="tel" name="tel" placeholder="Ex: 237 000000000" required />

            <p class="ligne">Genre </p>
            <select class="colonne" name="genre">
                <option value="Autre" selected>Autre</option>
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
            </select>

            <input type="submit" value="Ajouter" name="ajouter" class="envoi"/>
        </form>
		<?php
			if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['genre']) AND isset($_POST['email']) AND isset($_POST['mot']) AND isset($_POST['tel']))
			{
				//On ajoute une entrée dans la table administrateur
				$req = $BD->prepare('INSERT INTO administrateur(id_resto, nom, prenom, motdepasse, tel, genre, email) VALUES(?, ?, ?, ?, ?, ?, ?)');
				$req->execute(array(1, $_POST['nom'], $_POST['prenom'], $_POST['mot'], $_POST['tel'], $_POST['genre'], $_POST['email']));
				$req->closeCursor();
				header('Location: gereradmin.php');
			}
		?>
    </div>

    <footer>
		<p>Copyright Avril 2024 <br> Groupe 3 projet 11 | tous droits reservés!</p>
	</footer>
</body>
</html>