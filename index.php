<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="icone.png" />
	<title>Connexion</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
	<center><br>
    <header>
        <img class="logo" src="logo.png"/>
    </header><br><br>
       			<table >
       				<thead>
       	    		<tr>
      						<th><center>Connectez Vous</center></th>
                  </tr>
              </thead>
<tbody>
  <tr>
    <th>
					<form method="POST" action="verifierpass.php">
            <input type="text" name="mat" placeholder="Matricule"> <br><br>
            <input type="password"  name="pass" placeholder="Mot De Passe"><br><br>
              <?php
                session_start();
                if(isset($_GET['incorrect'])){
                  if ($_GET['incorrect']==1) { echo' role="alert">informations incorrectes';
                }
                  }
              ?>
                	<label>
                    <input type="checkbox" name="remember" checked> Connexion automatique
                	</label>
		 					  <button type="submit">Se connecter</button>
		 			</form>
   	</th>
	 </tr>
	</tbody>
            </table>
	</center>
</body>
</html>
