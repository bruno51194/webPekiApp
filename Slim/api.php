<?php
// Activamos las sesiones para el funcionamiento de flash['']
@session_start();
 
require 'Slim/Slim.php';
// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();
 
// Creamos la aplicación.
$app = new \Slim\Slim();
 
// Configuramos la aplicación. http://docs.slimframework.com/#Configuration-Overview
// Se puede hacer en la línea anterior con:
// $app = new \Slim\Slim(array('templates.path' => 'vistas'));
// O bien con $app->config();
$app->config(array(
    'templates.path' => 'vistas',
));
 
// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
$app->contentType('text/html; charset=utf-8');
 
// Definimos conexion de la base de datos.
// Lo haremos utilizando PDO con el driver mysql.
define('BD_SERVIDOR', 'eu-cdbr-azure-north-d.cloudapp.net');
define('BD_NOMBRE', 'pekiappbbdd');
define('BD_USUARIO', 'b509fbe59f7e43');
define('BD_PASSWORD', '69edfef4');
 
// Hacemos la conexión a la base de datos con PDO.
// Para activar las collations en UTF8 podemos hacerlo al crear la conexión por PDO
// o bien una vez hecha la conexión con
// $db->exec("set names utf8");
$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
 
////////////////////////////////////////////
// Definición de rutas en la aplicación:
// Ruta por defecto de la aplicación /
////////////////////////////////////////////
 
$app->get('/', function() {
            echo "hola api";
        });
 
// Cuando accedamos por get a la ruta /usuarios ejecutará lo siguiente:
$app->get('/usuarios', function() use($db) {
            // Si necesitamos acceder a alguna variable global en el framework
            // Tenemos que pasarla con use() en la cabecera de la función. Ejemplo: use($db)
            // Va a devolver un objeto JSON con los datos de usuarios.
            // Preparamos la consulta a la tabla.
            $consulta = $db->prepare("select * from usuarios");
            $consulta->execute();
            // Almacenamos los resultados en un array asociativo.
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // Devolvemos ese array asociativo como un string JSON.
            echo json_encode($resultados);
        });
 
 
// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
$app->get('/usuarios/:idusuario', function($usuarioID) use($db) {
            // Va a devolver un objeto JSON con los datos de usuarios.
            // Preparamos la consulta a la tabla.
            // En PDO los parámetros para las consultas se pasan con :nombreparametro (casualmente 
			// coincide con el método usado por Slim).
			// No confundir con el parámetro :idusuario que si queremos usarlo tendríamos 
			// que hacerlo con la variable $usuarioID
            $consulta = $db->prepare("select * from usuaris where nom=:param1");
 
            // En el execute es dónde asociamos el :param1 con el valor que le toque.
            $consulta->execute(array(':param1' => $usuarioID));
 
            // Almacenamos los resultados en un array asociativo.
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            // Devolvemos ese array asociativo como un string JSON.
            echo json_encode($resultados);
        });
 
// Alta de usuarios en la API REST
$app->post('/usuarios',function() use($db,$app) {
    // Para acceder a los datos recibidos del formulario
    $datosform=$app->request;
 
    // Los datos serán accesibles de esta forma:
    // $datosform->post('apellidos')
 
    // Preparamos la consulta de insert.
    $consulta=$db->prepare("insert into usuaris(nombre,apellido,contrasenya) 
					values (:nombre,:apellido,:password)");
 
    $estado=$consulta->execute(
            array(
                ':nombre'=> $datosform->post('nombre'),
                ':apellido'=> $datosform->post('apellido'),
                ':password'=> $datosform->post('password')
                )
            );
    if ($estado)
        echo json_encode(array('estado'=>true,'mensaje'=>'Datos insertados correctamente.'));
    else
        echo json_encode(array('estado'=>false,'mensaje'=>'Error al insertar datos en la tabla.'));
});
 
// Programamos la ruta de borrado en la API REST (DELETE)
$app->delete('/usuarios/:nombre',function($nombre) use($db)
{
   $consulta=$db->prepare("delete from usuaris where nombre=:nombre");
 
   $consulta->execute(array(':nombre'=>$nombre));
 
if ($consulta->rowCount() == 1)
   echo json_encode(array('estado'=>true,'mensaje'=>'El usuario '.$nombre.' ha sido borrado correctamente.'));
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