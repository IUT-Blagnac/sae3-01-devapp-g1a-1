<?php 
	session_start();
    if(isset($_SESSION['ident'])){
        if($_SESSION['ident']=='OK'){
            header("location:monCompte.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href ="style.css">
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
            <li><a href = "#"> Panier</a></li>
            <li><a href = "formConnexion.php"> Login</a></li>
        </ol>
    </nav>
    
</header>

<div class="contenu">
                                
     <img class="img-souk" src="https://thumbs.dreamstime.com/b/vieux-magasin-de-tapis-dans-cappadocia-goreme-turquie-octobre-152115852.jpg" alt="Image de fond">

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