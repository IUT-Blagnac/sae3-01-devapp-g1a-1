<?php 
	session_start();
    if($_SESSION['ident']!='OK'){
        header("location:index.php");
		exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href ="styleCompteCli.css">
    <title>Magic Alfombra</title>
</head>

<body>

<header class="main-head">

    <nav>
        <a href="index.php"><img src="./images/LogoOffMA.png" alt = "Logo entreprise"></a>

        <div class="search-box">

            <input type="search" placeholder="Ici votre tapis..">

        </div>

        <ol>
            <li><a href = "deconnexion.php"> Deconnexion</a></li>
            <li><a href = "#"> Panier</a></li>
            <li><a href = "compteClient.php"> Compte</a></li>
        </ol>
    </nav>
    
</header>


<div class="contenu">
    <div class="row">
    <div class="content">
        <h2>Compte client </h2>
        <br>
        <?php
            require_once("connect.inc.php");
            error_reporting(0);

            $req = "SELECT * FROM CLIENTS";

            $reqClient = oci_parse($connect, $req);

            $result = oci_execute($reqClient);

            $idC = $_COOKIE['idC']; 

            while (($fetch = oci_fetch_assoc($reqClient)) != false ) {
                if($fetch['IDCLIENT'] == $idC){
                    $pNom = $fetch['NOM'];
                    $pPrenom = $fetch['PRENOM'];
                    $pTelephone = $fetch['TELEPHONE'];
                    $pMail = $fetch['MAIL'];
                    $pNumRue = $fetch['NUMRUE'];
                    $pNomRue = $fetch['NOMRUE'];
                    $pCdPost = $fetch['CDPOST'];
                    $pVille = $fetch['VILLE'];
                    $pUsername = $fetch['USERNAME'];
                    $pPassword = $fetch['PASSWORD'];
                }
            }

            oci_free_statement($reqClient);
            
            echo '<form method="post" enctype="multipart/form-data" action="traitModif.php">';
                echo "Nom : <input type='text' value='".$pNom."' name='Nom'/><br><br>";
                echo "Prenom : <input type='text'  value='".$pPrenom."' name='Prenom'/><br><br>";
                echo "Telephone : <input type='text' value='".$pTelephone."' name='Telephone' /> <br><br>";
                echo "Mail : <input type='email'  value='".$pMail."' name='Mail'/><br><br>";
                echo "Numero de rue : <input type='text'  value='".$pNumRue."' name='NumRue'/><br><br>";
                echo "Nom de la rue : <input type='text'  value='".$pNomRue."' name='NomRue'/><br><br>";
                echo "Code postal : <input type='text'  value='".$pCdPost."' name='Cdpost'/><br><br>";
                echo "Ville : <input type='text'  value='".$pVille."' name='Ville'/><br><br>";
                echo "Username : <input type='text'  value='".$pUsername."' name='Username'/><br><br>";
                echo "Mot de passe : <input type='password' name='Password'/><br><br>";

                echo '<input type="submit" name="Valider" value="Modifier">';
            echo '</form>';

        ?>
        </div>
    </div>
</div>

<footer>

    <div class="contenu-footer">
        
        <div class="bloc footer-contact">
            <h2> Nos contacts </h2>
            <p> 06-XX-XX-XX-XX </p>
            <p> magicalfombra@tapis.com </p>

        </div>


        <div class="bloc footer-horaires">
            <h2> Nos horaires </h2>
            
            <ul class="liste-horaires">
                <li> Lundi ?h-?h</li>
                <li> Mardi ?h-?h</li>
                <li> Mercredi ?h-?h</li>
                <li> Jeudi ?h-?h</li>
                <li> Vendredi ?h-?h</li>
                <li> Samedi ?h-?h</li>
                <li> Dimanche ?h-?h</li>

        </div>

        <div class="bloc footer-services">
            <h2> Nos réseaux </h2>
            
            <ul class="liste-media">
                <li> <a href="#"><img src="./images/google.png" alt="icones res sociaux">Google </a></li>
                <li> <a href="#"><img src="./images/facebook.png" alt="icones res sociaux">Facebook </a></li>
                <li> <a href="#"><img src="./images/twitter.png" alt="icones res sociaux">Twitter </a></li>
                

        </div>

    </div>

</footer>
    

</body>
</html>