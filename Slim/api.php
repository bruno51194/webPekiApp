<?php
// Activamos las sesiones para el funcionamiento de flash['']
@session_start();
 
require 'Slim/Slim.php';

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
/////////////////// GETS ///////////////////
////////////////////////////////////////////
 
$app->get('/', function() {
            echo "hola api";
        });
 
//obtenim tots els usuaris
$app->get('/usuarios', function() use($db) {

            $consulta = $db->prepare("select * from usuarios");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
        });

//obtenim tots els animals
$app->get('/animales', function() use($db) {

            $consulta = $db->prepare("select * from animales");
            $consulta->execute();
            
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($resultados);
        });

//obtenim un susuario en concret
$app->get('/usuarios/:idusuario', function($usuarioID) use($db) {

            $consulta = $db->prepare("select * from usuarios where id_USUARIOS=:param1");

            $consulta->execute(array(':param1' => $usuarioID));
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            echo json_encode($resultados);
        });

//obtenim un animal en concret
$app->get('/animales/:idanimal', function($animalID) use($db) {

            $consulta = $db->prepare("select * from animales where id_ANIMALES=:param1");
 
            $consulta->execute(array(':param1' => $animalID));
 
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            echo json_encode($resultados);
        });
 
// Insertar usuari
$app->post('/insertarUsuarios',function() use($db,$app) {
    
    $datosform=$app->request;
 
    $consulta=$db->prepare("INSERT INTO usuaris(password_USUARIOS,email_USUARIOS,direccion_USUARIOS,poblacion_USUARIOS,CP_USUARIOS,telefono_USUARIOS,nombre_USUARIOS,apellido_USUARIOS) 
					VALUES(:password,:correu,:password,:direccio,:poblacio,:codiPostal,:telefon,:nom,:cognom)");
 
    $estado=$consulta->execute(
            array(
                ':nom'=> $datosform->post('nom'),
                ':cognom'=> $datosform->post('cognom'),
                ':password'=> $datosform->post('contrasenya'),
                ':correu' => $datosform->post('correu'),
                ':poblacio' => $datosform->post('poblacio'),
                ':codiPostal' => $datosform->post('cp'),
                ':direccio' => $datosform->post('direccio'),
                ':telefon' => $datosform->post('telefon')
                )
            );
    if ($estado)
        echo json_encode(array('estado'=>true,'mensaje'=>'Datos insertados correctamente.'));
    else
        echo json_encode(array('estado'=>false,'mensaje'=>'Error al insertar datos en la tabla.'));
});
 
// DELETE un usuari per el seu id
$app->delete('/usuarios/:id',function($id) use($db)
{
   $consulta=$db->prepare(" DELETE FROM usuarios WHERE id_USUARIOS=:id");
 
   $consulta->execute(array(':id'=>$id));
 
if ($consulta->rowCount() == 1)
   echo json_encode(array('estado'=>true,'mensaje'=>'El usuario con el id '.$id.' ha sido borrado correctamente.'));
 else
   echo json_encode(array('estado'=>false,'mensaje'=>'ERROR: ese registro no se ha encontrado en la tabla.'));
 
});
 
 
// Actualización de datos de usuario (PUT)
$app->put('/usuarios/:nombre',function($nombre) use($db,$app) {
    // Para acceder a los datos recibidos del formulario
    $datosform=$app->request;
 
    // Los datos serán accesibles de esta forma:
    // $datosform->post('apellidos')
 
    // Preparamos la consulta de update.
    $consulta=$db->prepare("update usuaris set nombre=:nombre, apellido=:apellido, password=:password 
							where nombre=:nombre");
 
    $estado=$consulta->execute(
            array(
                ':nombre'=> $datosform->post('nombre'),
                ':apellido'=> $datosform->post('apellido'),
                ':password'=> $datosform->post('password')
                )
            );
 
    // Si se han modificado datos...
    if ($consulta->rowCount()==1)
      echo json_encode(array('estado'=>true,'mensaje'=>'Datos actualizados correctamente.'));
    else
      echo json_encode(array('estado'=>false,'mensaje'=>'Error al actualizar datos, datos 
						no modificados o registro no encontrado.'));
});
 

///////////////////////////////////////////////////////////////////////////////////////////////////////
// Al final de la aplicación terminamos con $app->run();
///////////////////////////////////////////////////////////////////////////////////////////////////////
 
$app->run();
?>