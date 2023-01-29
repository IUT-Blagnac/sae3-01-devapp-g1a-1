<?php
            require_once("connect.inc.php");
            error_reporting(0);

			if ( isset ( $_POST['Valider']) && isset($_POST['nom']) && isset($_POST['prenom']) &&isset($_POST['idC']) && isset($_POST['motPasse'])){

				$req = "UPDATE CLIENTS SET password = :pPassword WHERE IDCLIENT = :pIdClient AND NOM = :pNom AND PRENOM = :pPrenom";

                $reqClient = oci_parse($connect,$req);

                $pMdp = htmlentities($_POST['motPasse']);

                $hashMDP = password_hash($pMdp,PASSWORD_DEFAULT);

                oci_bind_by_name($reqClient, ":pPassword", $hashMDP);

                $pIdC = htmlentities($_POST['idC']);

                oci_bind_by_name($reqClient,":pIdClient",$pIdC);

                $pNom = htmlentities($_POST['nom']);

                oci_bind_by_name($reqClient,":pNom",$pNom);

                $pPrenom = htmlentities($_POST['prenom']);

                oci_bind_by_name($reqClient,":pPrenom",$pPrenom);

                $result = oci_execute($reqClient);

                if (!$result) {
                    $e = oci_error($reqClient);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                    print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
                }

                oci_commit($connect);

                oci_free_statement($reqClient);
            }

            header("location:index.php")
?>