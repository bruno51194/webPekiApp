<?php
	function conexion (){
		$conn = new mysqli('eu-cdbr-azure-north-d.cloudapp.net', 'b509fbe59f7e43', '69edfef4', 'pekiappbbdd');
		mysqli_query ($conn, "SET NAMES 'utf8'");
		if ($conn->connect_errno) {
			echo "Falló la conexión con MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		}else{
			return $conn;
		}	
	}
	function email_existeix($email){
		$conn=conexion();
		$resultado = $conn->query("SELECT email_USUARIOSl FROM usuarios WHERE email_USUARIOSl = '" . $email . "'");
		if ($resultado->fetch_assoc()) {
			return true;
		}else{
			return false;
		}
	}
	function contrasenya_correcta($pass){
		$conn=conexion();
		$resultado = $conn->query("SELECT password_USUARIOS FROM usuarios WHERE password_USUARIOS = '" . $pass . "'");
		if ($resultado->fetch_assoc()) {
			return true;
		}else{
			return false;
		}
	}
	function limpiar_cadena($valor){
		$valor = str_ireplace(" OR ","",$valor);
		$valor = str_ireplace("%","",$valor);
		$valor = str_ireplace("--","",$valor);
		$valor = str_ireplace("^","",$valor);
		$valor = str_ireplace("[","",$valor);
		$valor = str_ireplace("]","",$valor);
		$valor = str_ireplace("\\","",$valor);
		$valor = str_ireplace("/","",$valor);
		$valor = str_ireplace("!","",$valor);
		$valor = str_ireplace("¡","",$valor);
		$valor = str_ireplace("?","",$valor);
		$valor = str_ireplace("=","",$valor);
		$valor = str_ireplace("&","",$valor);
		$valor = str_ireplace("'","",$valor);
		$valor = str_ireplace('"',"",$valor);
		return $valor;
	}
	function validar_email ($email){
		$regex = "^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$";
		if (@eregi($regex, $email)){ 
	        return true; 
	    } 
	    else { 
	        return false; 
	    }    
	}
	function get_ip_real() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	        return $_SERVER['HTTP_CLIENT_IP'];
	 
	    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	        return $_SERVER['HTTP_X_FORWARDED_FOR'];
	 
	    return $_SERVER['REMOTE_ADDR'];
	}	

?>