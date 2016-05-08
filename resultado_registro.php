<?php
include '_functions/functions.php';

if(isset($_POST['nom'])){
	$nom  = $_POST['nom'];
}else{
	$nom = "";
}
if(isset($_POST['cognom'])){
	$cognom = $_POST['cognom'];
}else{
	$cognom = "";
}
if(isset($_POST['email'])){
	$email = $_POST['email'];
}else{
	$email = "";
}
if(isset($_POST['contrasenya'])){
	$pass = $_POST['contrasenya'];
}else{
	$pass = "";
}
if(isset($_POST['telefon'])){
	$telf = $_POST['telefon'];
}else{
	$telf = "";
}
if(isset($_POST['cp'])){
	$CP = $_POST['cp'];
}else{
	$CP = "";
}
if(isset($_POST['direccio'])){
	$direccio = $_POST['direccio'];
}else{
	$direccio = "";
}
if(isset($_POST['poblacio'])){
	$poblacio = $_POST['poblacio'];
}else{
	$poblacio = "";
}
$ip = get_ip_real();

if(validar_email($email)){
	if(email_existeix($email)){
		echo "2";
	}else{
		if($nom!="" && $cognom!="" && $email!="" && $pass!="" && $telf!="" && $CP!="" && $direccio!="" && $poblacio!=""){
			insertar_nou_usuari($nom, $cognom, $email, $pass, $telf, $CP, $direccio, $poblacio, $ip);
			echo "1";
		}else{
			echo "4";
		}
	}
}else{
	echo "3";
}

?>