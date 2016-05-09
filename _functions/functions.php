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
	function penjarFoto(){
		include 'SimpleImage.php';
		//conexion a la base de datos
		$conn = conexion();
		
   		
   		//var_dump($_FILES);
		//comprobamos si ha ocurrido un error.
		if(isset($_FILES['foto']))
		if ($_FILES['foto']['error'] > 0){
			echo "ha ocurrido un error";
		} else {

			//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
			//y que el tamano del archivo no exceda los 100kb
			$permitidos = array("../image/jpg", "../image/jpeg", "image/png");
			$limite_kb = 6291456;

			if (in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024){
				//esta es la ruta donde copiaremos la imagen
				//recuerden que deben crear un directorio con este mismo nombre
				//en el mismo lugar donde se encuentra el archivo subir.php
				$file = $_FILES['foto'];
				$carpeta = "images/";
				$rutes = array("images/" . $file['name'], "images/grande_" . $file['name']);

				$img = new abeautifulsite\SimpleImage($file['tmp_name']); 
				$img->thumbnail(64, 64, 'center')->save($file['name']);
				//comprobamos si este archivo existe para no volverlo a copiar.
				//pero si quieren pueden obviar esto si no es necesario.
				//o pueden darle otro nombre para que no sobreescriba el actual.
				$resultado = array();
				if (!is_writable($carpeta)) {

				        echo '<div>Debug: is not writable', "<div />\n";

				}
				if (!file_exists($rutes[0])){
					//aqui movemos el archivo desde la ruta temporal a nuestra ruta
					//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
					//almacenara true o false
					
					$resultado[0] = @move_uploaded_file($file['tmp_name'], $rutes[0]);
					$resultado[1] = @move_uploaded_file($file['tmp_name'], $rutes[1]);

					var_dump($resultado);
					if ($resultado[0] && $resultado[1]){
						return $rutes;
						
					} else {
						//No s'ha penjat
						return array(0,0);
					}
				} else {
					//L'arxiu ja existeix a la carpeta
					$i = 2;
					while (file_exists($rutes[0])){
						$rutes[0] = "images/" . $i . $file['name'];
						$rutes[1] = "images/grande_" . $i . $file['name'];
						$i++;
					}
					$resultado[0] = @move_uploaded_file($file["tmp_name"], $rutes[0]);
					$resultado[1] = @move_uploaded_file($file["tmp_name"], $rutes[1]);
					if ($resultado){
						return $ruta;
					} else {
						//No s'ha penjat
						return array(0,0);
					}
				}
			} else {
				//Arxiu no permès
				return array(2,2);
			}
		}
	}	

?>