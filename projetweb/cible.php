<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>reponse fiche reservation</title>
	<link rel="stylesheet" type="text/css" href="cible.css">
</head>
<body>
	<div class="bloc">
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

			//on recupere le nombre de place de la tabtente
			$rest = $BD->prepare('SELECT nb_reservation FROM tabtente WHERE ville_demande = ? AND destination = ? AND classe = ?');
			$rest->execute(array($_POST['ville'], $_POST['ville_des'], $_POST['classe']));
			$n = $rest->fetch();
			$rest->closeCursor();
			
			if ($n['nb_reservation']>=$_POST['nombre'])
			{
				echo 'Cher(e) ' .$_POST['nom'] .' ' .$_POST['prenom'] .' vote réservation est acceptede  ' .$_POST['classe'] .' pour un ' 
            	.$_POST['style'] .' le ' .$_POST['date_demande'] .' depuis  ' .$_POST['ville'] .' pour ' .$_POST['ville_des'] 
            	.' merci de payer la réservation sur ce numéro OM: 656689640 ou MTN: 653003355 afin qu\'elle soit enregistrée';
			
				
				//on recupere l'id de restaurant ndere
				$pro = $BD->prepare('SELECT id_resto FROM resto_ndere WHERE localite = ?');
				$pro->execute(array($_POST['ville']));
				$val = $pro->fetch();
				$pro->closeCursor();

				//On ajoute une entrée dans la table client
				$req = $BD->prepare('INSERT INTO client(id_resto, nom, prenom, nationalite, age, genre, email, telephone) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
				$req->execute(array($val['id_resto'], $_POST['nom'], $_POST['prenom'], $_POST['pays'], $_POST['age'], $_POST['genre'], $_POST['email'], $_POST['tel']));
				$req->closeCursor();
				
				//on recupere l'id du client
				$reponse = $BD->prepare('SELECT id_client FROM client WHERE telephone = ? AND nom = ? AND prenom = ?');
				$reponse->execute(array($_POST['tel'], $_POST['nom'], $_POST['prenom']));
				$donnees = $reponse->fetch();
				$reponse->closeCursor();

				//on recupere l'id de la tabtente
				$test = $BD->prepare('SELECT id_tabtente FROM tabtente WHERE ville_demande = ? AND destination = ? AND classe = ?');
				$test->execute(array($_POST['ville'], $_POST['ville_des'], $_POST['classe']));
				$p = $test->fetch();
				$test->closeCursor();

				//on recupere le prix du tabtente
				$allons = $BD->prepare('SELECT prix FROM tabtente WHERE id_tabtente = ? ');
				$allons->execute(array($p['id_tabtente']));
				$y = $allons->fetch();
				$allons->closeCursor();
									
				//modification du nombre de resevation dans la table tabtente
				$mod = $BD->prepare('UPDATE tabtente SET nb_reservation = ? WhERE id_tabtente = ? ');
				$mod->execute(array($n['nb_reservation']-$_POST['nombre'], $p['id_tabtente']));
				$mod->closeCursor();

				// inserer les infos  du paiement
				$requet = $BD->prepare('INSERT INTO paiement(mode_paie, tel_paie, prix_paie) VALUES(?, ?, ?)');
				$requet->execute(array($_POST['mode_paie'], $_POST['tel_paie'], $y['prix']*$_POST['nombre']));
				$requet->closeCursor();

				//on recupere l'id du paiement
				$tout = $BD->prepare('SELECT id_paie FROM paiement WHERE tel_paie = ?');
				$tout->execute(array($_POST['tel_paie']));
				$b = $tout->fetch();
				$tout->closeCursor();
				
				// inserer les infos  de la reservation
				$voir = $BD->prepare('INSERT INTO reservation(id_admin, id_paie, id_tabtente, nb_reservation, style, date_demande, valide) VALUES(?, ?, ?, ?, ?, ?, ?)');
				$voir->execute(array(1 , $b['id_paie'], $p['id_tabtente'], $_POST['nombre'], $_POST['style'], $_POST['date_demande'], false));
				$voir->closeCursor();

				//on recupere l'id de la reservation
				$ok = $BD->prepare('SELECT id_reser FROM reservation WHERE id_paie = ?');
				$ok->execute(array($b['id_paie']));
				$c = $ok->fetch();
				$ok->closeCursor();
				
				//insertion dans la table faire
				$une = $BD->prepare('INSERT INTO faire(id_client, id_reser) VALUES(?, ?)');
				$une->execute(array($donnees['id_client'], $c['id_reser']));
				$une->closeCursor();

			} else if($n['nb_reservation'] != 0){
				echo 'Le nombre de reservation est insuffisant, il reste: ' .$n['nb_reservation'] 
				.' place(s). Veuillez faire une nouvelle réservation à une date/heure ultérieure ou dimunuer le nombre de reservation.';
				
			} else {
				//redirection vers la page reservation
				header('Location: reservation.php');
			}
	
		} else {
			//redirection vers la page reservation
			header('Location: reservation.php');
		}
	?>
	<nav>
		<ul>
			<a href="index.php">Accueil</a>
			<a href="reservation.php">reservation</a>
		</ul>
	</nav>
	</div>
</body>
</html>