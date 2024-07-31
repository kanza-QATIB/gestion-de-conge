<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="icone.png" />
	 <title>Modifier</title>
	 <meta charset="UTF-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

    <h5><img src="logo.png" hight="40" width="40"></h5>
      <a href="Profil.php">Profil</a>
      <a href="demander.php">Demander</a>
      <a href="mesdemandes.php">Mes demandes</a>
  
      <a  href="Deconnexion.php">déconnexion</a>
  

  <center>

    <?php
      session_start();
      if (isset($_GET['IDC'])) {
        $_SESSION['idcng']=$_GET['IDC'];
        $id=$_SESSION['idcng'];
      }else{ $id= $_GET['D'];
      }

      $serveur="localhost";
      $login="root";
      $pass="";

      try{
        $connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
        $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete1=$connexion->prepare("
          SELECT date_debut,date_fin,type,solde FROM conge  where id=$id");
        $requete1->execute();
        $requete1=$requete1->fetchall();
        }
        catch(PDOEXEPTION $e){
          echo'echec:'.$e->get_message();
        }
    ?>
  <form method="POST" action="Modifieragent2.php">
   
    <h5>Modification</h5><
        
    
        <label for="Type"><h6>Nombre des jours actuels</h6></label>
     
        <input type="text" readonly  id="Type" value=<?php echo $requete1[0][3]?> >
      <label for="Type" ><h6>Date de début</h6></label>
      <div class="col-sm-10">
        <input type="text" readonly  id="Type" value=<?php echo $requete1[0][0]?> >
      </div>
      <label for="inputdatedeb"><h6>Nouvelle date de début</h6></label>
        <input type="Date"  id="inputdatedeb" name="ndd">
      <label for="Type" ><h6>Date de fin</h6></label>
        <input type="text" readonly  id="Type" value=<?php echo $requete1[0][1]?> >

      <label for="inputdatefin"><h6>Nouvelle date de fin</h6></label>
    
        <input type="Date"  id="inputdatefin" name="ndf">
   
      <label for="Type"><h6>Type de congé</h6></label>
        <input type="text" readonly  id="Type" value=<?php echo $requete1[0][2]?> >
    
      <label for="inputdatefin" ><h6>Nouveau Type de congé</h6></label>
    
     
                <select id="inputType" name="typeC">
                  <option selected>Choisir....</option>
                  <option value="Congé annuel">Congé annuel</option>
                  <option value="Congé de permanence">Congé de permanence</option>
                  <option value="Congé familial">Congé familial</option>
                
                </select>
     
    <?php
                if(isset($_GET['Z'])){
                  if ($_GET['Z']==0) 
                    { echo'<br>
                      Impossible, le solde de jours est terminé';
                    }elseif ($_GET['Z']==1) 
                      { echo'<br>
                        Impossible de dépasser 30 jours';
                    }elseif($_GET['Z']==2)
                    {echo'<br>
                      Impossible, dates incorrectes';
                    }else
                      { echo'<br>
                        Impossible, il reste '.$_GET['Z'].' jours';}

                }
    ?>
  <button type="submit" >Valider</button>
    
  </form>
</center>
</body>
</htm>
