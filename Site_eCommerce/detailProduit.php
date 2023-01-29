<?php 
	session_start();
    if($_SESSION['ident']!='OK'){
        header("location:formConnexion.php?pDetail=oui");
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
    <link rel="icon" href="./images/LogoOffMA64x64.png">
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
            <li><a href = "panier.php"> Panier</a></li>
            <li><a href = "compteClient.php"> Compte</a></li>
        </ol>
    </nav>
    
</header>

<div class="contenu">

    <section class="articles">

        <div class="container">
            <div class="row">    
            
                <div class="image">
                    <?php
                        $image = htmlentities($_GET['pTapis']).".jpg";
                        echo "<img src='./images/".$image."' alt='Image'>";
                    ?>
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
                        echo '<p>Ajouté au panier !</p>'; 
                    }
                    else{
                        echo '<a href="traitPanier.php?pTapis='."$a".'">Ajouter au panier</a>';
                    }
                          
               ?>

               </div>
            </div>   

            </br>
            </br>

            <div class="row"> 
               <div class="list-avis">             
                    <h1> Ajouter un avis </h1>
                    <br>
                    <?php 
                    setcookie('refproduit',$_GET['pTapis'],time()+3600);
                    ?>
                <form method="POST" action="traitAvis.php">
                    <label class="rating-label">
                    <input
                        class="rating rating--nojs"
                        max="5"
                        step="1"
                        type="range"
                        value="3"
                        name="etoile">
                    </label>
                    <textarea class="text-avis" placeholder="Donnez nous votre avis.." name="textavis"></textarea>
                    
                <input class="input-avis" type="submit" name="Valider" value="Envoyer l'avis">
                
                </form> 

                </div>
            </div>
            <div class="row"> 
               <div class="list-avis">
                    <h1> Avis des clients </h1>
                    <br>
                    <div class="box-avis">
                    <?php         

                    require_once("connect.inc.php");

                    $req = "SELECT C1.PRENOM, C.TEXTE, C.DTE, C.NOTE FROM COMMENTER C, CLIENTS C1 WHERE C.IDCLIENT = C1.IDCLIENT AND C.REFPRODUIT = :pTapis";

                    $reqClient = oci_parse($connect, $req);

                    $pTapis = htmlentities($_GET['pTapis']);
                    oci_bind_by_name($reqClient, ":pTapis", $pTapis);
                    
                    $result = oci_execute($reqClient);

                    while (($fetch = oci_fetch_assoc($reqClient)) != false ) {
                        echo "<h3>";
                        echo "Le : ";
                        echo " ";
                        echo $fetch['DTE'];
                        echo "</br>";
                        
                        echo "Par : ";
                        echo " ";
                        echo $fetch['PRENOM'];
                        echo " ";
                        echo "avec une note de "; 
                        echo $fetch['NOTE'];
                        echo "/5";
                        echo "</h3>";

                        echo "<p>";
                        echo "Avis du client : ";
                        echo " ";
                        echo $fetch['TEXTE'];
                        echo "</p>";

                        echo "<br>";
                    }

                    oci_free_statement($reqClient); 
                    ?>
                    
                    </div>


                    <?php
                        require_once("connect.inc.php");
                        error_reporting(0);
                        
                        //On recupere l'id du client grâce au cookie lors de la connexion
                        
                        $pRef = $_GET['pTapis']; 
                        
                        $requete = "SELECT * FROM COMMENTER WHERE REFPRODUIT = :pRefProduit";
                        
                        $requeteClient = oci_parse($connect, $requete);
                        
                        oci_bind_by_name($requeteClient, ":pRefProduit", $pRef);
                        
                        $resultat = oci_execute($requeteClient);
                        
                        if (!$resultat) {
                        $e = oci_error($requeteClient);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                        print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
                        }

                        while (($fetch = oci_fetch_assoc($requeteClient)) != false ) {
                            //echo $fetch['TEXTE'];
                        }
                        
                        oci_free_statement($requeteClient);

                    ?>
                </div>   
            </div>
            
        </div>

    </section>
    
        


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