<?php
if (isset($_POST['email'])) 
{
	# code...
	try
	{
		$BD=new PDO('mysql:host=localhost;dbname=univ_ndere','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exeption $e)
	{
		die('Erreur :'.$e->getmessage());
	}
	$reponse=$BD->query('SELECT email, motdepasse FROM administrateur');
	$verif = true;
	while ($data=$reponse->fetch()) {
		if (htmlspecialchars($data['email']) == htmlspecialchars($_POST['email'])) {
			$to = htmlspecialchars($_POST['email']);
			$sujet = 'Ne pas répondre';
			$message = 'Votre mot de passe est :  ' . htmlspecialchars($data['motdepasse']);
			$entete = 'From: burrowskms@gmail.com';
			mail($to, $sujet, $message, $entete);
			$verif = false;
			?>
			<!DOCTYPE html>
			<html>
			<head>
                <meta charset="utf-8">
				<title>mot de passe</title>
                <link rel="stylesheet" type="text/css" href="motdepasse1.css">
			</head>
			<body>
				<form>
					<div class="logo"> <img src="images/logo.jpg"></div>
					<h1>Vérifier votre boite email</h1>
					<div> <a href="connexion.php">retour à la page de connexion</a> </div>
				</form>
			</body>
			</html>
			<?php
		}
	}
	if($verif) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>motdepasseoublier</title>
			<link rel="stylesheet" type="text/css" href="motdepasse1.css">
		</head>
		<body>
			<form method="post" action="motdepasse.php">
				<div class="logo"> <img src="images/logo.jpg"></div>
				<h1>Adresse ne correspond à aucun compte administrateur</h1>
				<input type="email" name="email" placeholder="Adresse e-mail" required>
				<input type="submit" name="submit" value="Envoyer">
			</form>
		</body>
		</html>
		<?php
	}
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>motdepasseoublier</title>
	<link rel="stylesheet" type="text/css" href="motdepasse1.css">
</head>
<body>
	<form method="post" action="motdepasse.php">
		<div class="logo"> <img src="images/logo.jpg"></div>
		<h1>Entrer votre email pour recupérer votre mot de passe</h1>
		<input type="email" name="email" placeholder="Adresse e-mail" required>
		<input type="submit" name="submit" value="Envoyer">
	</form>
</body>
</html>
<?php
}
?>