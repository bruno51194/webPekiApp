<?php

// Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
// Activamos las sesiones para el funcionamiento de flash['']
@session_start();
 
require 'Slim/Slim.php';
require '../_functions/functions.php';


\Slim\Slim::registerAutoloader();
 
// Creamos la aplicación.
$app = new \Slim\Slim();
 
$app->config(array(
    'templates.path' => 'vistas',
));
 
$app->contentType('text/html; charset=utf-8');
 
define('BD_SERVIDOR', 'eu-cdbr-azure-north-d.cloudapp.net');
define('BD_NOMBRE', 'pekiappbbdd');
define('BD_USUARIO', 'b509fbe59f7e43');
define('BD_PASSWORD', '69edfef4'); 
 
$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
 
////////////////////////////////////////////
//////////////// USUARIOS //////////////////
////////////////////////////////////////////


//obtenim tots els usuaris
$app->get('/usuarios', function() use($db) {

            $consulta = $db->prepare("select * from usuarios");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
});

//obtenim un susuario en concret
$app->get('/usuarios/:idusuario', function($usuarioID) use($db) {
            $consulta = $db->prepare("SELECT * from usuarios where id_USUARIOS=:param1");
            $consulta->execute(array(':param1' => $usuarioID));
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            echo json_encode($resultados);
            return $resultados;
});

$app->get('/usuariosToken/:tokenusuario', function($usuarioToken) use($db) {
            $consulta = $db->prepare("SELECT * from usuarios where token_USUARIOS=:param1");
            $consulta->bindParam("param1", $usuarioToken);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);


            echo json_encode($resultados);
            return $resultados;
});

//comprobem si existeix un correu
$app->post('/usuarios/existe', function() use($db, $app) {
            $app->request();
            $datosform=$app->request();
            $email= $datosform->post('lg_username');
            $pass= $datosform->post('lg_password');
            $consulta = $db->prepare("SELECT id_USUARIOS from usuarios where email_USUARIOSl=:param1 AND password_USUARIOS=:param2");
            $consulta->bindParam("param1", $email);
            $consulta->bindParam("param2", $pass);
            $consulta->execute();
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            if (json_encode($resultados) != "[]"){
                $hash_id = hash('sha256', $resultados[0]['id_USUARIOS']);
                $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);
                $sql = "UPDATE usuarios SET token_USUARIOS='" . $hash_id . "' WHERE id_USUARIOS=" . $resultados[0]['id_USUARIOS'];
                if ($conn->query($sql) === FALSE) {
                    echo "Error updating record: " . $conn->error;
                }else{
                    $sql3 = "SELECT tipo_USUARIOS FROM usuarios WHERE token_USUARIOS = '$hash_id'";
                    $result = $conn->query($sql3);
                    $tipo = $result->fetch_assoc();
                    echo "1 " . $hash_id . " " . $email . " " . $tipo['tipo_USUARIOS'];
                }
            }else{
                echo 0;
            }
        });

        //obtenim una contrasenya per correu
$app->get('/usuarios/password/:correu', function($email) use($db) {

            $consulta = $db->prepare("SELECT password_USUARIOS from usuarios where email_USUARIOSl=:param1");

            $consulta->execute(array(':param1' => $email));
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            echo json_encode($resultados);

        });



//obtenim l'EMAIL del USUARI que ha perdut un ANIMAL i enviem email
$app->get('/animales/animalesPerdidos/email/:idanimal', function($animalID) use($db) {

    require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

    $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);   
            $sql = "SELECT email_USUARIOSl, nombre_USUARIOS FROM usuarios WHERE id_USUARIOS = (SELECT USUARIOS_id_USUARIOS FROM pierde WHERE ANIMALES_id_ANIMALES = '$animalID')";
            $result = $conn->query($sql);
            $email = $result->fetch_assoc();

            $mail = new PHPMailer;
            $mail­->IsSMTP();
            //permite modo debug para ver mensajes de las cosas que van ocurriendo
            $mail­->SMTPDebug = 2;
            //Debo de hacer autenticación SMTP
            $mail­->SMTPAuth = true;
            $mail­->SMTPSecure = "ssl";
            //indico el servidor de Gmail para SMTP
            $mail­->Host = "smtp.gmail.com";
            //indico el puerto que usa Gmail
            $mail­->Port = 465;
            //indico un usuario / clave de un usuario de gmail
            $mail­->Username = "infopekiapp@gmail.com";
            $mail­->Password = "123123pekiapp";
            $mail­->SetFrom('infopekiapp@gmail.com', 'Pekiapp Informa');
            $mail­->AddReplyTo('infopekiapp@gmail.com', 'Pekiapp Informa');
            $mail­->Subject = "Pekiapp: S'ha trobat el teu animal!";
            $mail­->MsgHTML("El dia 1010012 a les 10:20:20 al carrer: pepito, 33");
            //indico destinatario
            $address = $email['email_USUARIOSl'];
            $mail­->AddAddress($address, $email['nombre_USUARIOS']);
            if(!$mail­->Send()) {
            echo "0 " . $mail­->ErrorInfo;
            } else {
            echo "1";
            }  
/*            
            if(mail($email['email_USUARIOSl'], "Pekiapp: S'ha trobat el teu animal!", "El dia 1010012 a les 10:20:20 al carrer: pepito, 33", 'From: xavier.ortega@mataro.epiaedu.cat')){
                echo 1;
            }else{
                echo 0;
            }*/
        });


// Insertar usuari
$app->post('/insertarUsuarios',function() use($db,$app) {

    $app->request();
    $datosform=$app->request();
    $nom= $datosform->post('reg_name');
    $cognom= $datosform->post('reg_surname');
    $pass= $datosform->post('reg_password');
    $email = $datosform->post('reg_email');
    $poblacio = $datosform->post('reg_pob');
    $CP = $datosform->post('reg_cp');
    $direccio = $datosform->post('reg_addr');
    $telf = $datosform->post('reg_tel');
    $tipo = "normal";
    

    $consulta=$db->prepare("INSERT INTO usuarios(password_USUARIOS,email_USUARIOSl,direccion_USUARIOS,poblacion_USUARIOS,CP_USUARIOS,telefono_USUARIOS,tipo_USUARIOS, nombre_USUARIOS,apellido_USUARIOS) 
                    VALUES(:password,:correu,:direccio,:poblacio,:codiPostal,:telefon,:tipo,:nom,:cognom)");
    if(validar_email($email)){

            if(email_existeix($email)){
                //EMAIL JA EXISTEIX
                echo "2";
                //echo json_encode('estado'=>2);
            }else{
                if($nom!="" && $cognom!="" && $email!="" && $pass!="" && $telf!="" && $CP!="" && $direccio!="" && $poblacio!=""){
                    $consulta->bindParam("password", $pass);
                    $consulta->bindParam("correu", $email);
                    $consulta->bindParam("direccio", $direccio);
                    $consulta->bindParam("poblacio", $poblacio);
                    $consulta->bindParam("codiPostal", $CP);
                    $consulta->bindParam("telefon", $telf);
                    $consulta->bindParam("tipo", $tipo);
                    $consulta->bindParam("nom", $nom);
                    $consulta->bindParam("cognom", $cognom);

                    $resultado = $consulta->execute();

                    echo $resultado;
                }else{
                    //HI HA CAMPS SENSE COMPLETAR
                    echo "4";
                }
            }
    }else{
        //FORMAT DE EMAIL INVÀLID
        echo "3";
    }
    
});

// Actualización de datos de usuario (PUT)
$app->post('/usuarios/actualizar/:id',function($id) use($db,$app) {
    // Para acceder a los datos recibidos del formulario
    $datosform=$app->request;
 
    // Los datos serán accesibles de esta forma:
    // $datosform->post('apellidos')
     $consulta=$db->prepare("UPDATE usuarios set nombre_USUARIOS=:nombre, apellido_USUARIOS=:apellido, poblacion_USUARIOS=:poblacion, CP_USUARIOS=:cp, telefono_USUARIOS=:telf
                            where token_USUARIOS=:id");
    // Preparamos la consulta de update.
    
                if($datosform->post('nom_nou')!="" && $datosform->post('cognom_nou')!="" && $datosform->post('telefon_nou')!="" && $datosform->post('cp_nou')!="" && $datosform->post('poblacio_nou')!=""){
                    $estado=$consulta->execute(
                        array(
                            ':nombre'=> $datosform->post('nom_nou'),
                            ':apellido'=> $datosform->post('cognom_nou'),
                            ':poblacion'=> $datosform->post('poblacio_nou'),
                            ':cp'=> $datosform->post('cp_nou'),
                            ':telf'=> $datosform->post('telefon_nou'),
                            ':id'=> $id,
                            )
                        );


                    echo $consulta->rowCount();
                }else{
                    //HI HA CAMPS SENSE COMPLETAR
                    echo "2";
                }

});

$app->post('/usuarios/actualizarContrasenya', function() use($app){
    $datosform = $app->request;


});


////////////////////////////////////////////
//////////////// SERVICIOS /////////////////
////////////////////////////////////////////


//obtenim els professionals segons el servei
$app->get('/profesionales/:tipus', function($tipus) use($db) {

            $consulta = $db->prepare("SELECT * FROM servicios WHERE tipus_SERVICIOS=:param1 AND  activo_SERVICIOS = 1");

            $consulta->execute(array(':param1' => $tipus));
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
            echo json_encode($resultados);
            return $resultados;
        });
 
$app->get('/', function() {
            echo "hola api";
        });

//Afegir un servei
$app->post('/afegirServei',function() use($db,$app) {

    $app->request();
    $datosform=$app->request();
    $nom= $datosform->post('nom');
    $ciutat= $datosform->post('ciutat');
    $direccio= $datosform->post('direccio');
    $horari= $datosform->post('horari');
    $descripcio= $datosform->post('descripcio');
    $tipus= $datosform->post('tipus');

    $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);

    $sql = "INSERT INTO servicios(nombre_SERVICIOS,ciudad_SERVICIOS,direccion_SERVICIOS,horario_SERVICIOS,descripcion_SERVICIOS,tipus_SERVICIOS) VALUES ('$nom','$ciutat','$direccio','$horari','$descripcio','$tipus')";

    if ($conn->query($sql) === FALSE) {
        echo "Error insertin' record: " . $conn->error;
    }else{
        echo "1" . " ";
    }
});

//obtenim tots lesCITES d'un USUARI empresa
$app->get('/cites/:tokenusuario', function($tokenusuario) use($db) {
            $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);
            $sql = "SELECT id_USUARIOS FROM usuarios WHERE token_USUARIOS = '" . $tokenusuario . "'";
            $result = $conn->query($sql);

            $idusuario = $result->fetch_assoc();
            
            $consulta = $db->prepare("SELECT * from citas WHERE fk_usuario_CITAS = " . $idusuario['id_USUARIOS']);
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
            return $resultados;
        });



////////////////////////////////////////////
//////////////// ANIMALES //////////////////
////////////////////////////////////////////


//obtenim tots els animals perduts
$app->get('/perdidos', function() use($db) {

            $consulta = $db->prepare("select * from pierde");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
        });

//obtenim tots els animals
$app->get('/animales', function() use($db) {

            $consulta = $db->prepare("select * from animales INNER JOIN perdidos ON id_ANIMALES = ANIMALES_id_ANIMALES INNER JOIN adopta ON id_ANIMALES = ANIMALES_id_ANIMALES");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultados;
        });
//obtenim tots els animals PERDUTS
$app->get('/animalesPerdidos', function() use($db) {

            $consulta = $db->prepare("SELECT * from animales INNER JOIN pierde ON id_ANIMALES = ANIMALES_id_ANIMALES WHERE estado_ANIMALES = 'perdido'");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
            return $resultados;
        });

//obtenim tots els animals PERDUTS d'un USUARI
$app->get('/animalesPerdidos/:tokenusuario', function($tokenusuario) use($db) {
            $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);
            $sql = "SELECT id_USUARIOS FROM usuarios WHERE token_USUARIOS = '" . $tokenusuario . "'";
            $result = $conn->query($sql);

            $idusuario = $result->fetch_assoc();
            
            $consulta = $db->prepare("SELECT * from animales INNER JOIN pierde ON id_ANIMALES = ANIMALES_id_ANIMALES WHERE USUARIOS_id_USUARIOS = " . $idusuario['id_USUARIOS'] . " AND estado_ANIMALES = 'perdido'");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
            return $resultados;
        });
//Obtenim UN animal PERDUT segons ID
$app->get('/animalPerdido/:id', function($idanimal) use($db) {
            
            $consulta = $db->prepare("SELECT * from animales INNER JOIN pierde ON id_ANIMALES = ANIMALES_id_ANIMALES WHERE id_ANIMALES = " . $idanimal);
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
            return $resultados;
        });

//obtenim les direccions dels animals perduts
 $app->get('/direcciones', function() use($db) {
 
             $consulta = $db->prepare("select direccion_PIERDE, ciudad_PIERDE from pierde");
             $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
             echo json_encode($resultados);
             return json_encode($resultados);
 
        });

  //Agafem TOTS els animals en adopcio
 $app->get('/animalesAdopcion', function() use($db) {

            $consulta = $db->prepare("SELECT * from adopta INNER JOIN animales ON id_ANIMALES = ANIMALES_id_ANIMALES where adopcion_ANIMALES='SI'");
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultados);
            return $resultados;
        });
  $app->get('/animalesAdopcion/:id', function($id) use($db) {

            $consulta = $db->prepare("SELECT * from adopta WHERE ANIMALES_id_ANIMALES =" . $id);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultados);
            return $resultados;
        });

//obtenim un animal en concret
$app->get('/animales/:idanimal', function($animalID) use($db) {

            $consulta = $db->prepare("SELECT * from animales WHERE id_ANIMALES=:param1");

            $consulta->execute(array(':param1' => $animalID));
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
            echo json_encode($resultados);
        });







// Insertar animal perdut
$app->post('/insertarAnimalPerdut',function() use($db,$app) {

    $app->request();
    $datosform=$app->request();
    $nom= $datosform->post('nom');
    $chip= $datosform->post('chip');
    $tipus= $datosform->post('tipos');
    $sexe = $datosform->post('sexe');
    $tamany = $datosform->post('tamany');
    $raça = $datosform->post('rasa');
    $edat = $datosform->post('edat');
    $color = $datosform->post('color');
    $vacunes = $datosform->post('vacunes');
    $ciutat = $datosform->post('ciutat');
    $direccio = $datosform->post('direccio');
    $recompensa = $datosform->post('recompensa');
    $descripcio = $datosform->post('descripcio');
    $estat = "perdido";
    $adopcio = "NO";
    $possibleRuta = penjarFoto();

    $url = $possibleRuta[0];
    $urlGran = $possibleRuta[1];
    
    $fecha = time();

    $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);
    $sql = "INSERT INTO animales(nombre_ANIMALES,chip_ANIMALES,tipo_ANIMALES,estado_ANIMALES,adopcion_ANIMALES,sexo_ANIMALES,medida_ANIMALES,raza_ANIMALES,edad_ANIMALES,color_ANIMALES,vacunes_ANIMALES,url_ANIMALES, urlGran_ANIMALES, descripcion_ANIMALES) 
                    VALUES('$nom','$chip','$tipus','$estat','$adopcio','$sexe','$tamany','$raça','$edat','$color','$vacunes', '$url', '$urlGran', '$descripcio')";
    if ($conn->query($sql) === FALSE) {
        echo "Error insertin' record: " . $conn->error;
    }else{
        echo "1" . " ";
        $idanimal = mysqli_insert_id($conn);
    }
    $sql3 = "SELECT id_USUARIOS FROM usuarios WHERE token_USUARIOS = '" . $_COOKIE['id'] . "'";
    $result = $conn->query($sql3);
    $idusuario = $result->fetch_assoc();

    $sql2 = "INSERT INTO pierde(ciudad_PIERDE,direccion_PIERDE,recompensa_PIERDE,USUARIOS_id_USUARIOS,ANIMALES_id_ANIMALES, fecha_PIERDE) 
                    VALUES('$ciutat','$direccio','$recompensa'," . $idusuario['id_USUARIOS'] . "," . $idanimal . ", '$fecha')";
    if ($conn->query($sql2) === FALSE) {
        echo "Error insertin' record: " . $conn->error;
    }else{
        echo "1";
    }

});

// Insertar animal en adopcio
$app->post('/insertarAnimalAdopcio',function() use($db,$app) {

    $app->request();
    $datosform=$app->request();
    $nom= $datosform->post('nom');
    $chip= $datosform->post('chip');
    $tipus= $datosform->post('tipos');
    $sexe = $datosform->post('sexe');
    $tamany = $datosform->post('tamany');
    $raça = $datosform->post('rasa');
    $edat = $datosform->post('edat');
    $color = $datosform->post('color');
    $vacunes = $datosform->post('vacunes');
    $estat = "adopcion";
    $adopcio = "SI";
    $possibleRuta = penjarFoto();

    $url = $possibleRuta[0];
    $urlGran = $possibleRuta[1];
    $fecha = time();

    $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);
    $sql = "INSERT INTO animales(nombre_ANIMALES,chip_ANIMALES,tipo_ANIMALES,estado_ANIMALES,adopcion_ANIMALES,sexo_ANIMALES,medida_ANIMALES,raza_ANIMALES,edad_ANIMALES,color_ANIMALES,vacunes_ANIMALES,url_ANIMALES, urlGran_ANIMALES, descripcion_ANIMALES) 
                    VALUES('$nom','$chip','$tipus','$estat','$adopcio','$sexe','$tamany','$raça','$edat','$color','$vacunes', '$url', '$urlGran', '$descripcio')";
    if ($conn->query($sql) === FALSE) {
        die("Error insertin' record: " . $conn->error);
    }else{
        echo "1" . " ";
        $idanimal = mysqli_insert_id($conn);
    }
    $sql3 = "SELECT id_USUARIOS FROM usuarios WHERE token_USUARIOS = '" . $_COOKIE['id'] . "'";
    $result = $conn->query($sql3);
    $idusuario = $result->fetch_assoc();

    $sql2 = "INSERT INTO adopta(USUARIOS_id_USUARIOS,ANIMALES_id_ANIMALES, fechaInicio_ADOPTA) 
                    VALUES('". $idusuario['id_USUARIOS'] . "', '$idanimal', '$fecha')";
    if ($conn->query($sql2) === FALSE) {
        echo "Error insertin' record: " . $conn->error;
    }else{
        echo "1";
    }

});
// DELETE un usuari per el seu id
$app->delete('/usuarios/:id',function($id) use($db)
{
   $consulta=$db->prepare(" DELETE FROM usuarios WHERE id_USUARIOS=:id");
 
   $consulta->execute(array(':id'=>$id));
 
if ($consulta->rowCount() == 1)
   echo "1";
 else
   echo "0";
 
});
 
 

//posar un animal en TROBAT
$app->post('/animales/eliminar', function() use($app, $db){
    $datosform=$app->request;
    $id = $datosform->post('id_animal');

    $consulta = $db->prepare("UPDATE animales SET estado_ANIMALES = 'encontrado' WHERE id_ANIMALES = :param1");
    $consulta->bindParam("param1", $id);
    $consulta->execute();
    

    if ($consulta->rowCount()==1)
      echo 1;
    else
      echo 0;
});
    


    

///////////////////////////////////////////////////////////////////////////////////////////////////////
// Al final de la aplicación terminamos con $app->run();
///////////////////////////////////////////////////////////////////////////////////////////////////////
 
$app->run();
?>