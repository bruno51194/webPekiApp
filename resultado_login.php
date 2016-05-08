<?php
include '_functions/functions.php';
ini_set('display_errors',"1");

if (isset($_POST['email_login'])){
$email = $_POST['email_login'];
}else{
	$email = "";
}
if (isset($_POST['contrasenya_login'])){
	$pass = $_POST['contrasenya_login'];
}else{
	$pass = "";
}

if(validar_email ($email)){
	if(email_existeix($email) && contrasenya_correcta($pass)){
		
		echo "1";
	}else{
		echo "2";
	}
}else{
	echo "3";
}
?>