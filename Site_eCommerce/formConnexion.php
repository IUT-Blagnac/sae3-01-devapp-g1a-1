<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href ="styleLogin.css">
	<link rel="icon" href="./images/LogoOffMA64x64.png">
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
<div class="contenu">
	<div class="box">
			
		<legend>Identification</legend>
		
		<br>

		<p>Login : 

		<br>
		
		<?php
			if (!empty($_COOKIE['nomLogin'])) {
				$nL=$_COOKIE['nomLogin'];
				echo "<input type='text' name='login' value='$nL'><br>";
			} else {
				echo "<input type='text' name='login'><br>";
			}
			if(isset($_GET['pIndex'])){
				if ($_GET['pIndex'] == 'Panier'){
					setcookie('pPanier',$_GET['pIndex'],time()+5);
				}
			}

			if(isset($_GET['pDetail'])){
				if ($_GET['pDetail'] == 'oui'){
					setcookie('cookieDetail',$_GET['pDetail'],time()+3600);
				}
			}

			?>
			
		<br>
		Mot de passe : 
		
		<br>
		
		<input type="password" name="motPasse">

		<br><br>

		<a href = "mdpOublie.php"> Mot de passe oublié ?</a>

		<br><br>

		Se souvenir de moi : <input type="checkbox" name="cb_souvenirMoi">
		
		<br><br>

		<input class="valid-button" type="submit" name="Valider" value="Valider">
		</p>
		<br>
		Pas encore de compte ? <a href = "creatCompte.php"> Cliquez ici</a>
		
	</div>
	</div>

	</form>

  </body>
</html>