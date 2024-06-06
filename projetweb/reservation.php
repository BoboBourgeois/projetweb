<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rosto de Ndéré</title>
	<link rel="icon" href="images/logo.jpg">
	<link rel="stylesheet" type="text/css" href="reservation2.css">
</head>
<body>
	<div>
	<form method="post" action="cible.php">
		<legend>Formulaire de réservation </legend>

		<h2>Vos coordonnées</h2>
		<p class="ligne">Nom </p>
		<input type="text" name="nom" placeholder="name" autofocus required /> 

		<p class="ligne">Prénom </p>
		<input type="text" name="prenom" placeholder="first name" required /> 

		<p class="ligne">Age </p>
		<input type="number" name="age" min="15" max="150" placeholder="your age" required /> 

		<p class="ligne">Genre </p>
		<select class="colonne" name="genre">
            <option value="Autre" selected>Autre</option>
			<option value="Masculin">Masculin</option>
			<option value="Feminin">Feminin</option>
		</select>

		<p class="ligne">Email </p>
		<input type="email" name="email" placeholder="Ex: nom@gmail.com"/> 

		<p class="ligne"> Nationalité </p>
		<select name="pays" class="colonne">
			<option value="Cote d'ivoire">Cote d'ivoire</option>
				<option value="Cameroon" selected>Cameroon</option>
				<option value="Tchad">Tchad</option>
				<option value="France">France</option>
				<option value="Autre">Autre</option>
				<option value="RCA">RCA</option>
				<option value="Congo">Congo</option>
		</select>
		
		<p class="ligne">Numéro de télephone </p>
		<input type="tel" name="tel" placeholder="Ex: 237 000000000" required />

		<h2>Votre choix </h2>
		<p class="ligne">table&tente </p>
		<select name="ville" class="colonne">
			
			<option selected>Reservation pro</option>
			<option>Reservation simple</option>
			
		</select>

        <p class="ligne">Nombre de reservation </p>
		<input type="number" name="nombre" min="1" max="3" placeholder="number of reservation" required /> 

        <p class="ligne">Destination </p>
		<select name="ville_des" class="colonne">
			
			<option>Ville Ndéré</option>
	
		</select>
	
        <p class="ligne"> CLASSE DE RESEVATION </p>
		<select name="classe" class="colonne">
			<option selected>Commerciale</option>
			<option>VIP</option>
		</select>

        <p class="ligne">Date demande </p>
		<input type="datetime-local" name="date_demande" required />

        <p class="ligne">Style de Reservation </p>
		<select name="style" class="colonne">
			<option selected>ceremonie de mariage</option>
			<option>ceremonie de consert</option>
		</select>

        <h2>Paiement</h2>
        <p class="ligne">Mode de paiement </p>
		<select name="mode_paie" class="colonne">
			<option selected>Orange Money</option>
			<option>Mtn MoMo</option>
		</select>

        <p class="ligne">Numéro de paiement </p>
        <input type="tel" name="tel_paie" placeholder="Ex: 237 000000000" required /> 
		
		<br> <br>

		<input type="submit" value="Valider" name="Envoyer" id="envoi" />
		
	</form>
	<?php
		if (isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['pays']) && isset($_POST['genre']) && isset($_POST['ville']) && isset($_POST['tel']) && isset($_POST['classe'])
        && isset($_POST['nombre']) && isset($_POST['style']) && isset($_POST['mode_paie']) && isset($_POST['date_demande']) && isset($_POST['tel_paie'])  && isset($_POST['ville_des']))
		{
			try
			{
				$BD = new PDO('mysql:host=localhost;dbname=univ_ndere', 'root', '');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			
			
		
				//On ajoute une entrée dans la table client
				$req = $BD->prepare('INSERT INTO client(id_resto, nom, prenom, nationalite, age, genre, email, telephone) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
				$req->execute(array($val['id_resto'], $_POST['nom'], $_POST['prenom'], $_POST['pays'], $_POST['age'], $_POST['genre'], $_POST['email'], $_POST['tel']));
				$req->closeCursor();
				
			
				// inserer les infos  du paiement
				$requet = $BD->prepare('INSERT INTO paiement(mode_paie, tel_paie, prix_paie) VALUES(?, ?, ?)');
				$requet->execute(array($_POST['mode_paie'], $_POST['tel_paie'], $y['prix']*$_POST['nombre']));
				$requet->closeCursor();

							
				// inserer les infos  de la reservation
				$voir = $BD->prepare('INSERT INTO reservation(id_admin, id_paie, id_tabtente, nb_reservation, style, date_demande, valide) VALUES(?, ?, ?, ?, ?, ?, ?)');
				$voir->execute(array(1 , $b['id_paie'], $p['id_tabtente'], $_POST['nombre'], $_POST['style'], $_POST['date_demande'], false));
				$voir->closeCursor();

				
				//insertion dans la table faire
				$une = $BD->prepare('INSERT INTO faire(id_client, id_reser) VALUES(?, ?)');
				$une->execute(array($donnees['id_client'], $c['id_reser']));
				$une->closeCursor();

			
				
				
		} 		
		
			
		
	?>
	</div>
	
</body>
</html>