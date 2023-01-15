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
    <link rel="stylesheet" href ="stylePanier.css">
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
            <li><a href = "#"> Panier</a></li>
            <li><a href = "#"> Compte</a></li>
        </ol>
    </nav>
    
</header>

<?php

require_once("connect.inc.php");
error_reporting(0);

//On recupere l'id du client grâce au cookie lors de la connexion

$idC = $_COOKIE['idC']; 

$requete = "SELECT * FROM CONTENIR WHERE idclient = :pIdClient";

$requeteClient = oci_parse($connect, $requete);

oci_bind_by_name($requeteClient, ":pIdClient", $idC);

$resultat = oci_execute($requeteClient);

if (!$resultat) {
  $e = oci_error($requeteClient);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
  print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
}


while (($fetch = oci_fetch_assoc($requeteClient)) != false ) {
    //Si le produit est dans le panier
    if($fetch['IDCLIENT'] == $idC){
        echo "ARTICLE PRESENT";
        echo "<br>";
    }else{ //Sinon
      echo "AUCUN ARTICLE DANS LE PANIER";
      echo "<br>";
    }
}

oci_free_statement($requeteClient);

?>

<div class="contenu">
  <div class="cart-page">
      <h1>Panier</h1>
      <table>
        <tr>
          <th>Produit</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>Total</th>
          <th></th>
        </tr>
        <tr>
          <td>Article 1</td>
          <td>10$</td>
          <td>
            <input type="number" value="1">
            <input class="valid-button" type="submit" name="Valider" value="Valider">
          </td>
          <td>10$</td>
          <td>
            <button class="remove-button">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Article 2 TEST</td>
          <td>20$</td>
          <td>
            <input type="number" value="1">
            <input class="valid-button" type="submit" name="Valider" value="Valider">
          </td>
          <td>20$</td>
          <td>
            <button class="remove-button">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Article 3</td>
          <td>15$</td>
          <td>
            <input type="number" value="1">
            <input class="valid-button" type="submit" name="Valider" value="Valider">
          </td>
          <td>15$</td>
          <td>
            <button class="remove-button">Supprimer</button>
          </td>
        </tr>
      </table>
      <div class="total">
        Total : <span>45$</span>
      </div>
      <button class="checkout-button">Passer au paiement</button>
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