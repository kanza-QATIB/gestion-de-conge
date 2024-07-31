<?php session_start();
  $id=$_SESSION['mat'];
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="icone.png" />
	 <title>Mes demandes</title>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
</head>
<body>
    
    <h5 ><img src="logo.php" hight="40" width="40"</h5>
     
        <a  href="Profil.php">Profil</a>
        <a href="demander.php">Demander</a>
        <a  href="mesdemandes.php">Mes demandes</a>
    
      <a href="Deconnexion.php">déconnexion</a>
    

	<center>
    <?php
      $serveur="localhost";
			$login="root";
			$pass="";
		  $id=$_SESSION['mat'];

			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$requete1=$connexion->prepare("
					SELECT date_debut,date_fin,type,solde,id FROM colnge where matricule=$id ORDER BY id DESC");
				$requete1->execute();
				$requete1=$requete1->fetchall();

        echo '<table>
        <thead>
        <tr>
          <th>Date de début</th>
          <th>Date de fin</th>
          <th>Type de congé</th>
          <th>Solde</th>
          <th>..modifier..</th>
        </tr>
        </thead>
        <tbody>';
        for ($i=0; $i <count($requete1) ; $i++) { 
          if ($requete1[$i][5]== 1) {
            echo'<tr class="table-success">';
            }elseif ($requete1[$i][5]== -1) {
              echo'<tr >';
            }else{
              echo '<tr>';}
          for ($j=0; $j <4 ; $j++) {
            $rr=$requete1[$i][$j]; 
            echo "<td> $rr </td>";
          }
          $array[$i]=$requete1[$i][4];
          if ($requete1[$i][5]== 1 || $requete1[$i][5]== -1) {
            echo"<td></td>";
          }else{
            echo'<form method="POST" action="Modifieragent.php?IDC='.$array[$i].'">
            <td> <button type="submit" class="btn btn-outline-secondary">Modifier</button> </td>
            </form>';
          }
        }
          echo "</tr>";
        }
        catch(PDOEXEPTION $e){
          echo'echec:'.$e->get_message();
         }
    ?>
    </tbody>
    </table>
  </center>
</body>
</html>
