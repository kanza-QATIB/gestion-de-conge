<?php
session_start();
			$serveur="localhost";
			$login="root";
			$pass="";
			$id=$_SESSION['mat'];

			$DATE_D=$_POST['dd'];
			$DATE_F=$_POST['df'];
			$TYPE=$_POST['type'];
			$SOLDE=((strtotime($DATE_F) - strtotime($DATE_D))/86400);/*le diviser la durée par 86400 pour avoir le nombre de jours, parce que le résultat est en seconde! (60*60*24)*/
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$requete=$connexion->prepare("SELECT nbr_jrs , poste from agent where matricule=$id");
				$requete->execute();
				$requete=$requete->fetchall();
				$NBJ=$requete[0][0];
				if ($NBJ==0) {
						if ($requete[0][1]!==Chef) {
              header("location:demander.php?D=0");
						}
					
				}elseif ($SOLDE<=0){
						if ($requete[0][1]!==Chef) {
							header("location:demander.php?D=3");
						}
				}elseif($SOLDE>30) {
						if ($requete[0][1]!==Chef) {
							header("location:demander.php?D=1");
						}
				}else{
					$N_SOLDE=$NBJ-$SOLDE;
					if ($N_SOLDE <0) {
						if ($requete[0][1]!==Chef) {
							header("location:demander.php?DD=$NBJ");
						}
					}else{
						$requete1=$connexion->prepare("
						INSERT INTO conge (matricule,date_debut,date_fin,type,solde)
						VALUES ('$id','$DATE_D','$DATE_F','$TYPE','$SOLDE')");
					$requete1->execute();

					$requete2=$connexion->prepare("UPDATE agent
						SET nbr_jrs=$N_SOLDE where solde=$id");
					$requete2->execute();
						if ($requete[0][1]!==Chef) {
							header("location:demander.php?D=2");
						}
						}
					}
				
				}
				catch(PDOEXEPTION $e){
					echo'echec:'.$e->get_message();
				}
?>
