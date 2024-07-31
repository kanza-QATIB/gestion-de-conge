<?php
	session_start();
	$id=$_GET['ID'];
	$E=$_GET['E'];
	$MAT=$_GET['MAT'];
	$SOLDE=$_GET['S'];
	try{
		$serveur="localhost";
		$login="root";
		$pass="";
			$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
			$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$requete0=$connexion->prepare("SELECT nbr_jrs FROM agent where matricule=$MAT");
			$requete0->execute();
			$requete0=$requete0->fetchall();
			$NB_J=$requete0[0][0];

			$requet1=$connexion->prepare("UPDATE conge SET ETAT = -1 where id =$id");
			$requet1->execute();
				$NNB_J=$NB_J+$SOLDE;
				$requete2=$connexion->prepare("UPDATE AGENT SET nbr_jrs=$NNB_J where matricule =$MAT");
				$requete2->execute();
			if ($E!==1) {
				header("location:validationchef.php");
			}
	}
	catch(PDOEXEPTION $e){
		echo'echec:'.$e->get_message();
	}
?>
