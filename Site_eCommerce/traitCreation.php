<?php
            require_once("connect.inc.php");
            error_reporting(0);

			if ( isset ( $_POST['Valider']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['email'])
			&& isset($_POST['numrue']) && isset($_POST['nomrue']) && isset($_POST['cdpost']) && isset($_POST['ville']) && isset($_POST['username']) 
            && isset($_POST['motPasse'])){

                $req2 = "SELECT COUNT(*) as max_id FROM Clients";

                $reqPrepare2 = oci_parse($connect, $req2);

                $result2 = oci_execute($reqPrepare2);

                $id = $result2 + 1;
                
                // si erreur de requete alors affichage...
                if (!$result) {
                    $e = oci_error($reqPrepare2);  // on récupère l'exception liée au pb d'execution de la requete
                    print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
                }

                // Libère toutes les ressources réservées par un résultat Oracle
                oci_free_statement($reqPrepare2);

				$req = "INSERT INTO Clients VALUES (".'"'."SEQ_Clients".'"'.".NEXTVAL,:pNom, :pPrenom, :pTelephone, :pEmail, :pNumrue, :pNomrue, :pCdpost, :pVille, :pUsername, :pMdp,'N')";

                $reqPrepare = oci_parse($connect,$req);

                oci_bind_by_name($reqPrepare, ":pId", $id);

                // il faut passer par une variable pour contenir la valeur
                $pNom = htmlentities($_POST['nom']); 
                // on lie la valeur au paramètre de la requête
                oci_bind_by_name($reqPrepare, ":pNom", $pNom);

                $pPrenom = htmlentities($_POST['prenom']);
                oci_bind_by_name($reqPrepare, ":pPrenom", $pNom);

                $pTelephone = htmlentities($_POST['telephone']);
                oci_bind_by_name($reqPrepare, ":pTelephone", $pTelephone);

                $pEmail = htmlentities($_POST['email']);
                oci_bind_by_name($reqPrepare, ":pEmail", $pEmail);

                $pNumrue = htmlentities($_POST['numrue']);
                oci_bind_by_name($reqPrepare, ":pNumrue", $pNumrue);

                $pNomrue = htmlentities($_POST['nomrue']);
                oci_bind_by_name($reqPrepare, ":pNomrue", $pNomrue);

                $pCdpost = htmlentities($_POST['cdpost']);
                oci_bind_by_name($reqPrepare, ":pCdpost", $pCdpost);

                $pVille = htmlentities($_POST['ville']);
                oci_bind_by_name($reqPrepare, ":pVille", $pVille);

                $pUsername = htmlentities($_POST['username']);
                oci_bind_by_name($reqPrepare, ":pUsername", $pUsername);

                $pMdp = htmlentities($_POST['motPasse']);

                $hashMDP = password_hash($motPasse,PASSWORD_DEFAULT);

                oci_bind_by_name($reqPrepare, ":pMdp", $hashMDP);
                        
                $result = oci_execute($reqPrepare);
                
                if (!$result) {
                    $e = oci_error($reqPrepare);  // on récupère l'exception liée au pb d'execution de la requete (violation PK par exemple)
                    print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']);		
                }
                
                oci_commit($connect);
                
                setcookie('nomLogin',$_POST['username'],time()+60);
				header('location: formConnexion.php');
                exit();		 
		    }else {
                header('location: formConnexion.php?msgErreur= Veuillez saisir tout les champs');
                exit();
            }