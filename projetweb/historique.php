<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>historique</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
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
            <h2 style="color: blue"> Historique des résevations validées </h2>
            
            <span style="color: teal"><?php echo 'Réservation Commerciale' .'<br>' .'<br>'; ?></span>
            <?php
            $reponse=$BD->query('SELECT * FROM reservation WHERE valide = "1"');
            while ($data=$reponse->fetch())
            {
                //on recupere l'attribut id_faire dans la table faire
                $test = $BD->prepare('SELECT id_client FROM faire WHERE id_reser= ?');
                $test->execute(array($data['id_reser']));
                $p = $test->fetch();
                $test->closeCursor();
                //on recupere tous les attributs dans la table client
                $requete = $BD->prepare('SELECT * FROM client WHERE id_client= ?');
                $requete->execute(array($p['id_client']));
                $v = $requete->fetch();
                $requete->closeCursor();
                
                //on recupere tous les attributs dans la table tabtente
                $req = $BD->prepare('SELECT * FROM tabtente WHERE id_tabtente= ?');
                $req->execute(array($data['id_tabtente']));
                $x = $req->fetch();
                $req->closeCursor();
                
                if($x['classe']=='Commerciale'){
                    if($v['genre']=='Masculin') {
                        echo 'Mr ' .$v['nom'] .' ' .$v['prenom'] .' ' .$v['telephone'] .' pour un ' .$data['style'] .' en ' .$x['classe'] .' de ' .$x['ville_demande'] 
                        .' à ' .$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservation'] .' demande: ' .$data['date_demande'] .'<br>' .'<br>';
                    } else if($v['genre']=='Feminin') {
                        echo 'Mme ' .$v['nom'] .' ' .$v['prenom'] .' ' .$v['telephone'] .' pour un ' .$data['style'] .' en ' .$x['classe'] .' de ' .$x['ville_demande'] 
                        .' à ' .$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservation'] .' demande: ' .$data['date_demande'] .'<br>' .'<br>';
                    } else {
                        echo 'Mr/Mme ' .$v['nom'] .' ' .$v['prenom'] .' ' .$v['telephone'] .' pour un ' .$data['style'] .' en ' .$x['classe'] .' de ' .$x['ville_demandr'] 
                        .' à ' .$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservation'] .' demande: ' .$data['date_demande'] .'<br>' .'<br>';
                    }
                }
            }
            ?>
            <span style="color: teal"><?php echo 'Réservation VIP' .'<br>' .'<br>'; ?></span>
            <?php
            $reponse=$BD->query('SELECT * FROM reservation WHERE valide = "1"');
            while ($data=$reponse->fetch())
            {
                //on recupere l'attribut id_faire dans la table faire
                $test = $BD->prepare('SELECT id_client FROM faire WHERE id_reser= ?');
                $test->execute(array($data['id_reser']));
                $p = $test->fetch();
                $test->closeCursor();
                //on recupere tous les attributs dans la table client
                $requete = $BD->prepare('SELECT * FROM client WHERE id_client= ?');
                $requete->execute(array($p['id_client']));
                $v = $requete->fetch();
                $requete->closeCursor();
                
                //on recupere tous les attributs dans la table tabtente
                $req = $BD->prepare('SELECT * FROM tabtente WHERE id_tabtente= ?');
                $req->execute(array($data['id_tabtente']));
                $x = $req->fetch();
                $req->closeCursor();
                
                if($x['classe']=='VIP'){
                    if($v['genre']=='Masculin') {
                        echo 'Mr ' .$v['nom'] .' ' .$v['prenom'] .' ' .$v['telephone'] .' pour un ' .$data['style'] .' en ' .$x['classe'] .' de ' .$x['ville_demande'] 
                        .' à ' .$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservation'] .' demande: ' .$data['date_demande'] .'<br>' .'<br>';
                    } else if($v['genre']=='Feminin') {
                        echo 'Mme ' .$v['nom'] .' ' .$v['prenom'] .' ' .$v['telephone'] .' pour un ' .$data['style'] .' en ' .$x['classe'] .' de ' .$x['ville_demande'] 
                        .' à ' .$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservation'] .' demande: ' .$data['date_demande'] .'<br>' .'<br>';
                    } else {
                        echo 'Mr/Mme ' .$v['nom'] .' ' .$v['prenom'] .' ' .$v['telephone'] .' pour un ' .$data['style'] .' en ' .$x['classe'] .' de ' .$x['ville_demande'] 
                        .' à ' .$x['destination'] .' le nombre de reservation est: ' .$data['nb_reservation'] .' demande: ' .$data['date_demande'] .'<br>' .'<br>';
                    }
                }
            }
        ?>
    </div>
</body>
</html>