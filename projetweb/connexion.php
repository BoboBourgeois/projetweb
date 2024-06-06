<?php
session_start();
if(isset($_POST['email']) AND isset($_POST['password']))
{
	try
	{
		$BD = new PDO('mysql:host=localhost;dbname=univ_ndere','root','');
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getmessage());
	}
	$reponse=$BD->query('SELECT * FROM administrateur');
	while ($data=$reponse->fetch())
	{
		# code...
		if (htmlspecialchars($data['motdepasse'])==htmlspecialchars($_POST['password']) AND htmlspecialchars($data['email'])==htmlspecialchars($_POST['email']))
	    {
			# code...
			$_SESSION['Connexion']=true;
			$_SESSION['identifiant']=htmlspecialchars($data['id']);
			$_SESSION['nom']=htmlspecialchars($data['nom']);
			$_SESSION['prenom']=htmlspecialchars($data['prenom']);
			$_SESSION['email']=htmlspecialchars($data['email']);
			$reponse->closecursor();
			header('Location:admin.php');
		}
	}
	$reponse->closecursor();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>connexion</title>
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>
		<form method="post" action="connexion.php">
			<div id="logo"> <img src="images/logo.jpg" alt="logo resto"> </div>
			<label>email</label>
			<input type="email" name="email" placeholder="Adresse e-mail" class="erreur" required>
			<label>password</label>
			<input type="password" name="password" placeholder="Mot de passe" class="erreur" required>
			<h1>compte introuvable ou mot de passe incorrect</h1>
			<label> <a href="motdepasse.php">Mot de passe oublié?</a> </label>
			<div id="bouton"><input type="submit" name="connexion" value="Se connecter" ></div>
		</form>
</body>
</html>
	<?php
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>connexion</title>
	<link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>
		<form method="post" action="connexion.php">
			<div id="logo"> <img src="images/logo.jpg" alt="logo resto"> </div>
			<label>email</label>
			<input type="email" name="email" placeholder="Adresse e-mail" required>
			<label>password</label> 
			<input type="password" name="password" placeholder="Mot de passe" required>
			<label> <a href="motdepasse.php">Mot de passe oublié?</a> </label>
			<div id="bouton" ><input type="submit" name="Connexion" value="Se connecter" ></div>
      </form>
</body>
</html>
<?php
}
?>