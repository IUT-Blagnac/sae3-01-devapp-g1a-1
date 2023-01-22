<?php 
	session_start();
    if($_SESSION['ident']!='OK'){
        header("location:index.php");
		exit();
    }

    require_once("connect.inc.php");
    error_reporting(0);

    $requete = "SELECT * FROM CONTENIR";

    $requeteClient = oci_parse($connect, $requete);

    $resultat = oci_execute($requeteClient);

    //On recupere l'id du client grâce au cookie lors de la connexion
    $pTap = $_GET['pTapis'];

    $idC = $_COOKIE['idC'];

    

    while (($fetch = oci_fetch_assoc($requeteClient)) != false ) {
        //Si le produit est dans le panier
        if($fetch['REFPRODUIT'] == $pTap && $fetch['IDCLIENT'] == $idC){
            $pQtt = $fetch['QUANTITE'];
        }
    }

    oci_free_statement($requeteClient);


    $req = "INSERT INTO CONTENIR VALUES (:pIdClient, :pRefProduit, :pQuantite)";

    $reqPrepare = oci_parse($connect,$req);

    $pIdClient = htmlentities($idC);
    oci_bind_by_name($reqPrepare, ":pIdClient", $pIdClient);

    $pRefProduit = htmlentities($pTap);
    oci_bind_by_name($reqPrepare, ":pRefProduit", $pRefProduit);

    $pQtt = 1;
    oci_bind_by_name($reqPrepare, ":pQuantite", $pQtt);

    $result = oci_execute($reqPrepare);

    if (!$result) {
        $e = oci_error($reqPrepare);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
    }
    
    oci_commit($connect);

    header("location:detailProduit.php?pTapis=$pTap&command=true");

?>