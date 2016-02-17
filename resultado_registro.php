<?php
include '_functions/functions.php';

$nom  = $_POST['nom'];
$cognom = $_POST['cognom'];
$email = $_POST['email'];
$pass = $_POST['contrasenya'];
$telf = $_POST['telefon'];
$CP = $_POST['cp'];
$direccio = $_POST['direccio'];
$poblacio = $_POST['poblacio'];
$ip = get_ip_real();

if(validar_email ($email)){
	if(email_existeix($email)){
		echo "2";
	}else{
		echo "1";
	}
}else{
	echo "3";
}

?>