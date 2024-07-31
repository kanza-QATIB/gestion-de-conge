<?php
session_start();
			$serveur="localhost";
			$login="root";
			$pass="";
			$id=$_SESSION['idcng'];
			$mat=$_SESSION['mat'];

			$N_DATE_D=strtotime($_POST["ndd"]);
			$N_DATE_F=strtotime($_POST["ndf"]);
			$N_TYPE=$_POST['typeC'];
			$N_SOLDE=(($N_DATE_F - $N_DATE_D)/86400);/*le diviser la durée par 86400 pour avoir le nombre de jours, parce que le résultat est en seconde! (60*60*24)*/
			$N_DATE_D = date('Y-m-d H:i:s', $N_DATE_D);
			$N_DATE_F = date('Y-m-d H:i:s', $N_DATE_F);
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$requete0=$connexion->prepare("SELECT nbr_jrs , poste from agent where matricule=$mat");
				$requete0->execute();
				$requete0=$requete0->fetchall();
				$NBJ=$requete0[0][0];

				$requete1=$connexion->prepare("SELECT solde from conge where id=$id");
				$requete1->execute();
				$requete1=$requete1->fetchall();
				$SOLDE=$requete1[0][0];
				if ($N_SOLDE<=0){
						if ($requete[0][1]!==Chef) {
							header("location:Modifieragent.php?Z=2 & D=$id");
						}
				}elseif ($N_SOLDE>$SOLDE) {
					if ($NBJ==0) {
						if ($requete0[0][1]!==Chef) {
						header("location:Modifieragent.php?Z=0 & D=$id");
						}
					}elseif ($N_SOLDE>30) {
						if ($requete0[0][1]!==Chef) {
							header("location:Modifieragent.php?Z=1 & D=$id");
						}
					}else{
						$NN_SOLDE=$NBJ-$N_SOLDE;
						if ($NN_SOLDE <0) {
							if ($requete0[0][1]!==Chef) {
								header("location:Modifieragent.php?Z=$NBJ & D=$id");
							}
						}else{
							$requete=$connexion->prepare("UPDATE conge SET date_debut=\"$N_DATE_D\" ,date_fin=\"$N_DATE_F\" ,type=\"$N_TYPE\" ,solde=$N_SOLDE  where id=$id");
							$requete->execute();
							$requete2=$connexion->prepare("UPDATE agent SET nbr_jrs=$NN_SOLDE where matricule=$mat");
							$requete2->execute();
							if ($requete0[0][1]!==Chef) {
								header("location:mesdemandes.php");
							}
						}
					}
				}else{
					$requete=$connexion->prepare("UPDATE conge SET date_debut=\"$N_DATE_D\" ,date_fin=\"$N_DATE_F\" , type=\"$N_TYPE\" , solde=$N_SOLDE  where id=$id");
					$requete->execute();
					$NV_NBJ=$SOLDE-$N_SOLDE;
					$requete2=$connexion->prepare("UPDATE agent SET nbr_jrs=$NV_NBJ where matricule=$mat");
					$requete2->execute();
					if ($requete0[0][1]!==Chef) {
						header("location:mesdemandes.php");
					}
				}
			}
			catch(PDOEXEPTION $e){
				echo'echec:'.$e->get_message();
			}
?>
