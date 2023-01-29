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

    <form method="POST" action="traitMdpOublie.php">

	<br><br>
	<br><br>
<div class="contenu">
	<div class="box">
			
		<legend>Mot de passe oublié</legend>
		
		<br>

		<p>Id client : <br>
		
        <input type='text' name='idC'>

		<br> <br>
        Nom : <br>
		
        <input type='text' name='nom'>

		<br> <br>
        Prenom : <br>
		
        <input type='text' name='prenom'>

		<br> <br>
		Nouveau mot de passe : <br> <input type="password" name="motPasse">

		<br><br>


		<input class="valid-button" type="submit" name="Valider" value="Valider">
		</p>
		
	</div>
	</div>

	</form>

  </body>
</html>