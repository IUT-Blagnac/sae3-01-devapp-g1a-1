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
    <link rel="stylesheet" href ="styleProduit.css">
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
            <li><a href = "#"> Compte</a></li>
        </ol>
    </nav>
    
</header>

<div class="contenu">

    <section class="articles">

        <div class="container">
            <div class="row">    
            
                <div class="image">
                    <img src="tapis1site.png" alt="tapis">     
                </div>

               <div class="description">

                <?php 
                    require_once("connect.inc.php");
                    error_reporting(0);

                    $req = "SELECT * FROM PRODUITS";

                    $reqClient = oci_parse($connect, $req);

                    $result = oci_execute($reqClient);

                    $choixEffectue = $_GET['pTapis'];

                    while (($fetch = oci_fetch_assoc($reqClient)) != false ) {
                        if($fetch['REFPRODUIT'] == $choixEffectue){
                            echo "<h4> Description :</h4>";
                            echo $fetch['DESCRIPTION']; 
                            echo "<br>";
                            
                            echo "<br>";
                            echo "<h4> Dimension :</h4>";
                            echo $fetch['DIMENSION'];
                            echo "<br>";

                            echo "<br>";
                            echo "<h4> Poids :</h4>";
                            echo $fetch['POIDS'];
                            echo "<br>";

                            echo "<br>";
                            echo "<h4> Vitesse :</h4>";
                            echo $fetch['VITESSE'];
                            echo "<br>";

                            echo "<br>";
                            echo "<h4> Couleur :</h4>";
                            echo $fetch['COLORIS'];
                            echo "<br>";

                            echo "<br>";
                            echo "<br>";

                            echo "<h3> Prix :</h3>";
                            echo $fetch['PRIX']."€";
                            echo "<br>";
                        }
                    }

                    oci_free_statement($reqClient);
                    ?> 

                

               </div> 


               <div class="panier">

               <?php
                    $a = $_GET['pTapis'];
                    if(isset($_GET['command'])){
                        echo '<a href="traitPanier.php?pTapis='."$a".'">Ajouté au panier !</a>'; 
                    }
                    else{
                        echo '<a href="traitPanier.php?pTapis='."$a".'">Ajouter au panier</a>';
                    }
                          
               ?>

               </div>   
                
            </div>
        </div>

    </section>


</div>

<footer>

    <div class="contenu-footer">
        
        <div class="bloc footer-contact">
            <h2> Nos contact </h2>
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