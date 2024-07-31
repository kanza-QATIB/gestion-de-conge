<!DOCTYPE html>
<head>
   <link rel="icon" type="image/png" href="icone.png" />
	 <title>Demander</title>
	 <meta charset="UTF-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
      <h5><img src="logo.radees.PNG" hight="40" width="40"></h5>
        <a  href="Profil.php">Profil</a>
        <a  href="demander.php">demander</a>
        <a  href="mesdemandes.php">Mes demandes</a>
        <a  href="Deconnexion.php">déconnexion</a>

  <center>

      <h3>Demande de congé</h3>
        <form method="POST" action="ajouter-demande.php">
              <label for="inputdatedeb4"><h6>Date de début</h6></label>
              <input type="date" id="inputdatedeb4" name="dd" placeholder="Date de debut"></div>
              <label for="inputdatefin4"><h6>Date de fin</h6></label>
              <input type="date" id="inputdatefin4" name="df" placeholder="Date de fin">
            <label for="inputState"><h6>Type de congé</h6></label>
              <select id="inputType" name="type" class="form-control">
                <option selected>Choisir....</option>
                <option value="Congé annuel">Congé annuel</option>
                <option value="Congé de permanence">Congé de permanence</option>
                <option value="Congé familial">Congé familial</option> 
              </select>
          <br>
          
            <button type="submit">Envoyer</button>
          
                <?php
                if(isset($_GET['D']))
                {
                  if ($_GET['D']==0) 
                    { echo'<br>
                      Impossible, vous avez terminé votre solde de jours';
                    }elseif ($_GET['D']==1) 
                    { echo'<br>
                      Impossible, vous avez dépassé 30 jours';
                    }elseif ($_GET['D']==2) 
                    { echo'<br>
                      Demande envoyée';
                    }elseif($_GET['D']==3)
                    {echo'<br>
                      Impossible, dates incorrectes';}
                }
                if(isset($_GET['DD']))
                  { echo'<br>
                    Impossible, il reste '.$_GET['DD'].' jours';
                  }

                ?>
          </form>
  </center>
</body>
</html>
