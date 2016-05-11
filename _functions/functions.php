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
		$regex = "^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$^";
		if (preg_match($regex, $email)){ 
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
			$permitidos = array("image/jpg", "image/jpeg", "image/png");
			$limite_kb = 6291456;

			if (in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024){
				//esta es la ruta donde copiaremos la imagen
				//recuerden que deben crear un directorio con este mismo nombre
				//en el mismo lugar donde se encuentra el archivo subir.php
				$file = $_FILES['foto'];
				$carpeta = "images/";
				$rutes = array("../images/uploads/" . $file['name'], "../images/uploads/grande_" . $file['name']);

				$img = new abeautifulsite\SimpleImage($file['tmp_name']); 
				$resultado = array();
				if (!file_exists($rutes[0])){

					$img->thumbnail(200, 200, 'center')->save($rutes[1], 100);
					$img->thumbnail(64, 64, 'center')->save($rutes[0], 100);
					$rutes[0] = substr($rutes[0], 3);
					$rutes[1] = substr($rutes[1], 3);
					return $rutes;
				} else {
					//L'arxiu ja existeix a la carpeta
					$i = 0;
					while (file_exists($rutes[0])){
						$rutes[0] = "../images/uploads/" . $i . $file['name'];
						$rutes[1] = "../images/uploads/grande_" . $i . $file['name'];
						$i++;
					}

					$img->thumbnail(200, 200, 'center')->save($rutes[1], 100);
					$img->thumbnail(64, 64, 'center')->save($rutes[0], 100);
					

					$rutes[0] = substr($rutes[0], 3);
					$rutes[1] = substr($rutes[1], 3);
					return $rutes;

				}
			} else {
				return array("images/nofoto.png","images/nofoto_grande.png");
			}
		}
	}	

?>