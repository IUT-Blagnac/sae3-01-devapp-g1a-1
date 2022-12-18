<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href ="styleLogin.css">
    <title>Magic Alfombra</title>
  </head>
  <body>

  <header class="main-head">

    <nav>
        <a href="index.php"><img src="./images/LogoOffMA.png" alt = "Logo entreprise"></a>
    </nav>
    
	</header>
	
	<form method="POST" action="traitConnexion.php">

	<br><br>
	<br><br>

	<div class="box">
		
		<legend>Identification</legend>
		
		<br>

		<p>Login : 
		
		<?php
			if (!empty($_COOKIE['nomLogin'])) {
				$nL=$_COOKIE['nomLogin'];
				echo "<input type='text' name='login' value='$nL'><br>";
			} else {
				echo "<input type='text' name='login'><br>";
			}
			?>
			
		<br> <br>
		Mot de passe : <input type="password" name="motPasse"><br><br>
		Se souvenir de moi : <input type="checkbox" name="cb_souvenirMoi"><br><br>
		<input type="submit" name="Valider" value="Valider">
		</p>
		<br>
		Pas encore de compte ? <a href = "creatCompte.php"> Cliquez ici</a>
		
	</div>

	</form>

  </body>
</html>