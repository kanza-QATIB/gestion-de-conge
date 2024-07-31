<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="icone.png" />
	 <title>Profil</title>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    
    <h5 ><img src="logo.php" hight="40" width="40"></h5>
        <a  href="Profil.php">Profil</a>
        <a href="demander.php">Demander</a>
        <a href="mesdemandes.php">Mes demandes</a>
        <a  href="Deconnexion.php">déconnexion</a>
	<center>

			<?php
			$serveur="localhost";
			$login="root";
			$pass="";
		  $id=$_SESSION['mat'];
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->query('SET NAMES utf8');
				$requete1=$connexion->prepare("
					SELECT matricule,nom,prenom,poste FROM agent  where matricule=$id");
				$requete1->execute();
				$requete1=$requete1->fetchall();
				
				$MAT=$requete1[0][0];
				$NOM=$requete1[0][1];
				$PRENOM=$requete1[0][2];
				$POST=$requete1[0][3];
			}
			catch(PDOEXEPTION $e){
				echo'echec:'.$e->get_message();
			}
			?>
          <table>
            <thead>
              <tr>
                <th><center>Informations personnel</center></th>
      
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Matricule</td>
                <td><?php echo $MAT ?></td>
              </tr>
              <tr>
                <td>nom</td>
                <td><?php echo $NOM ?></td>
              </tr>
              <tr>
                <td>Prénom</td>
                <td><?php echo $PRENOM ?></td>
              </tr>
              <tr>
                <td>Poste</td>
                <td><?php echo $POST ?></td>
              </tr>
            </tbody>
          </table>
  </center>
</body>
</html>
