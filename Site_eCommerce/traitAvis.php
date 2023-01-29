<?php 
    require_once("connect.inc.php");
    

    if ( isset ( $_POST['Valider']) && isset($_POST['etoile']) && isset($_POST['textavis'])){

        $requete = "SELECT TO_CHAR(CURRENT_DATE, 'yyyy-MM-dd') AS current_date FROM dual";

        $reqClient = oci_parse($connect, $requete);

        $result = oci_execute($reqClient);

        while (($fetch = oci_fetch_assoc($reqClient)) != false ) {
                $pDateAvis = $fetch['CURRENT_DATE']; 
        }

        oci_free_statement($reqClient);

        $req = "INSERT INTO COMMENTER VALUES (".'"'."SEQ_Avis".'"'.".NEXTVAL,:pTexte,:pNote,TO_DATE(:pDateAvis, 'YYYY-MM-DD'),:pIdClient, :pRefProduit)";

        $reqPrepare = oci_parse($connect,$req);

        // il faut passer par une variable pour contenir la valeur
        $pTexte = htmlentities($_POST['textavis']); 
        // on lie la valeur au paramètre de la requête
        oci_bind_by_name($reqPrepare, ":pTexte", $pTexte);

        $pEtoile = htmlentities($_POST['etoile']);
        oci_bind_by_name($reqPrepare, ":pNote", $pEtoile);
        
        oci_bind_by_name($reqPrepare, ":pDateAvis", $pDateAvis);

        $pIdC = htmlentities($_COOKIE['idC']);
        oci_bind_by_name($reqPrepare, ":pIdClient", $pIdC);

        $pRefProduit = htmlentities($_COOKIE['refproduit']);
        oci_bind_by_name($reqPrepare, ":pRefProduit", $pRefProduit);

        $result = oci_execute($reqPrepare);
                
        if (!$result) {
            $e = oci_error($reqPrepare);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
        }
        
        oci_commit($connect);

        header('location:produits.php');
        exit();	
    }


?>