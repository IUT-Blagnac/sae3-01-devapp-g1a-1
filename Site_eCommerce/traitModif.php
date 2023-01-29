<?php
    session_start();
    if($_SESSION['ident']!='OK'){
        header("location:index.php");
		exit();
    }

    require_once("connect.inc.php");
    error_reporting(0);

    $requete = "UPDATE CLIENTS SET idclient = :pIdClient, nom = :pNom, prenom = :pPrenom, telephone = :pTelephone, mail = :pMail, numrue = :pNumRue, nomrue = :pNomRue, cdpost = :pCdPost, ville = :pVille, username = :pUsername, isadmin = 'N' WHERE IDCLIENT = :pIdClient";

    $reqPrepare = oci_parse($connect,$requete);

    $idC = $_COOKIE['idC'];

    oci_bind_by_name($reqPrepare,":pIdClient",$idC);

    $Nom = htmlentities($_POST['Nom']);
    oci_bind_by_name($reqPrepare, ":pNom", $Nom);

    $Prenom = htmlentities($_POST['Prenom']);
    oci_bind_by_name($reqPrepare, ":pPrenom", $Prenom);
    
    $Telephone = htmlentities($_POST['Telephone']);
    oci_bind_by_name($reqPrepare, ":pTelephone", $Telephone);

    $Mail = htmlentities($_POST['Mail']);
    oci_bind_by_name($reqPrepare, ":pMail", $Mail);

    $NumRue = htmlentities($_POST['NumRue']);
    oci_bind_by_name($reqPrepare, ":pNumRue", $NumRue);

    $NomRue = htmlentities($_POST['NomRue']);
    oci_bind_by_name($reqPrepare, ":pNomRue", $NomRue);

    $CdPost = htmlentities($_POST['Cdpost']);
    oci_bind_by_name($reqPrepare, ":pCdPost", $CdPost);

    $Ville = htmlentities($_POST['Ville']);
    oci_bind_by_name($reqPrepare, ":pVille", $Ville);

    $Username = htmlentities($_POST['Username']);
    oci_bind_by_name($reqPrepare, ":pUsername", $Username);

    $result = oci_execute($reqPrepare);

    if (!$result) {
        $e = oci_error($reqPrepare);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
        print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
    }
    
    oci_commit($connect);

    oci_free_statement($reqPrepare);

    if(isset($_POST['Password'])){
        $req = "UPDATE CLIENTS SET password = :pPassword WHERE IDCLIENT = :pIdClient";

        $reqClient = oci_parse($connect,$req);

        $pMdp = htmlentities($_POST['Password']);

        $hashMDP = password_hash($pMdp,PASSWORD_DEFAULT);

        oci_bind_by_name($reqClient, ":pPassword", $hashMDP);

        $idC = $_COOKIE['idC'];

        oci_bind_by_name($reqClient,":pIdClient",$idC);

        $result = oci_execute($reqClient);

        if (!$result) {
            $e = oci_error($reqClient);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
            print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
        }

        oci_commit($connect);

        oci_free_statement($reqClient);
    }

    header("location:compteClient.php")
?>