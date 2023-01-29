<!DOCTYPE html >
<html>
<head>
<title>Magic Alfombra</title>
</head>
<body>
	<?php
	session_start();
	require_once("connect.inc.php");
	error_reporting(0);


	if (isset($_POST['Valider']) && isset($_POST['login']) && isset($_POST['motPasse'])) {
		$req = "SELECT PASSWORD FROM CLIENTS WHERE username = :pUsername";

		$reqClient = oci_parse($connect, $req);

		$login = $_POST['login']; 

		oci_bind_by_name($reqClient, ":pUsername", $login);

		$result = oci_execute($reqClient);
	
		$cpt = 0;

		while (($clientpassword = oci_fetch_assoc($reqClient)) != false) {
			$password = $clientpassword['PASSWORD'];
		}

		echo $_POST['motPasse'];
		echo "<br>";
		$hash = password_hash($_POST['motPasse'], PASSWORD_DEFAULT);
		echo $hash;
		echo "<br>";
		echo $password;

		if (password_verify($_POST['motPasse'], $password)) {
			$cpt = $cpt + 1;
			echo $_POST['motPasse'];
			echo $password;		
		}

		oci_free_statement($reqClient);

		if ($cpt == 1){
			$_SESSION['ident'] = 'OK';
			$_SESSION['login'] = htmlentities($_POST['login']);
			if(isset($_POST['cb_souvenirMoi'])){
				setcookie('nomLogin',$_POST['login'],time()+60);
			}
			echo $cpt;
		} else {
			echo $cpt;
		}
	}
	?>
<body>
</html>