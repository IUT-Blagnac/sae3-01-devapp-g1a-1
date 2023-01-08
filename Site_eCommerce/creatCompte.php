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

	<br><br>

	<div class="box">
		
    <form method="POST" action="traitCreation.php">
		
		<legend><h2>Créer votre compte</h2></legend>
		
		<br>

		Nom : <input type='text' name='nom'>

		<br> <br>

        Prenom : <input type='text' name='prenom'>

		<br> <br>

        Telephone : <input type='text' name='telephone'>

		<br> <br>

        E-mail : <input type='email' name='email'>

		<br> <br>

        Num. rue : <input type='text' name='numrue'>

        <br> <br>

        Nom rue : <input type='text' name='nomrue'>

        <br> <br>

        Code postal : <input type='text' name='cdpost'>

        <br> <br>

        Ville : <input type='text' name='ville'>

        <br> <br>

        Nom d'utilisateur : <input type='text' name='username'>

        <br> <br>

		Mot de passe : <input type="password" name="motPasse">
        
        <br><br>

        <input type="submit" name="Valider" value="Valider">
		</p>
		
    </form>

	</div>
  </body>
</html>