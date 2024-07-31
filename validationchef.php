<?php 
    session_start();
      $id=$_SESSION['mat'];
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="icone.png" />
	 <title>Validation</title>
	 <meta charset="UTF-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    
  <h5 ><img src="logo.png" hight="40" width="40"></h5>

      <a  href="Profilchef.php">Profil</a>
      <a  href="demanderchef.php">Demander</a>
      <a href="mesdemandeschef.php">Mes demandes</a>
      <a  href="validationchef.php">Validation</a>

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
        $requete1=$connexion->prepare("
          SELECT nom,prenom,date_debut,date_fin,type,solde,id ,matricule FROM conge NATURAL join(agent) where matricule!= $id  ORDER BY id DESC");
        $requete1->execute();
        $requete1=$requete1->fetchall();
          $MAT=$requete1[0][7];
          echo '<table>
          <thead>
            <tr>
              <th >Nom</th>
              <th >Prénom</th>
              <th >Date de début</th>
              <th >Date de fin</th>
              <th>Type de congé</th>
              <th>Solde</th>
              <th>Validation</th>
            </tr>
          </thead>
          <tbody>';

        for ($i=0; $i <count($requete1) ; $i++) {

          if ($requete1[$i][7]== 1) {
              echo'<tr >';
          }elseif ($requete1[$i][7]== -1) {
              echo'<tr>';
          }else{
            echo '<tr>';
          }
          for ($j=0; $j <6 ; $j++) {
            $rr=$requete1[$i][$j];
              echo "<td> $rr </td>";
          }  
            $arraycng[$i]=$requete1[$i][6];
            $arraysolde[$i]=$requete1[$i][5]; 
          if ($requete1[$i][7]== 1 || $requete1[$i][7]== -1) {
            echo"<td></td>";
          }else{  
              echo '<td>
              Action
             
              <a  href="Accepter.php?ID='.$arraycng[$i].' & E=0 ">Accepter</a>
              <a  href="Refuser.php?ID='.$arraycng[$i].' & S='.$arraysolde[$i].' & MAT='.$MAT.' & E=0 ">Refuser</a>
              <a  href="Modifier.php?ID='.$arraycng[$i].' & E=0 ">Modifier</a>
             
              </td>';
          }
            echo "</tr>";
        }
        
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
