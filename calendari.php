<!DOCTYPE html>
<html>
<head>
    <?php 
        $titol = "Lost&Find";
        $actiu = 4;
        include 'head.php';
    ?>
    <style>
        .table th{
            background-color: #EE8041;
            color: white;
        }
    </style>
</head>
<body>
    <header id="header">
        <?php include 'topmenu.php';?>  
    </header>
    <?php
    set_time_limit(1000);
    include '_functions/functions.php';
    $id_servei = (isset($_GET['idServei']) ? $_GET['idServei'] : 0);
    $horaMinMati = "9:00";
    $horaMaxMati = "13:00";
    $horaMinTarda = "16:00";
    $horaMaxTarda = "20:00";

    $stringHorari = horarisencer($id_servei);
    $horariComplert = substr($stringHorari, 0, -1);
    $horari = explode(',', $horariComplert);



    $dia_ant = date('Y-m-j');
    

    
    function saber_dia($data){
        $dias = array('','Dilluns','Dimarts','Dimecres','Dijous','Divendres','Dissabte','Diumenge');
        $fecha = $dias[date('N', strtotime($data))];
        return $fecha;       
    }
    function horarisencer($id){
        $conn = conexion();
        $consulta = $conn->query("SELECT horaMatiMin_SERVICIOS, horaMatiMax_SERVICIOS, horaTardaMin_SERVICIOS, horaTardaMax_SERVICIOS FROM servicios WHERE id_SERVICIOS = '$id'");
        $hores = $consulta->fetch_assoc();

        $horesDisponibles = convertirHores($hores);
        $conn->close();
        
        return $horesDisponibles;
    }
    function horeslliures($id, $dia){
       
        $conn = conexion();
        $consulta = $conn->query("SELECT nombre_SERVICIOS, horaMatiMin_SERVICIOS, horaMatiMax_SERVICIOS, horaTardaMin_SERVICIOS, horaTardaMax_SERVICIOS FROM servicios WHERE id_SERVICIOS = '$id'");
        $hores = $consulta->fetch_assoc();

        $horesDisponibles = convertirHores($hores);

        $consulta = $conn->query("SELECT * FROM horesperdudes WHERE pk_idServei = '$id' AND dia_HORESPERDUDES = '$dia'");
        
        $resultados = $consulta;
        
        foreach ($resultados as $hora) {
            $horesDisponibles = str_ireplace($hora['hora_HORESPERDUDES'] . ",", "", $horesDisponibles);
        }
        $horesDisponibles = substr($horesDisponibles, 0, -1);
        $conn->close();

        return explode(",", $horesDisponibles);

    }
    function nomServei($id){
        $conn = conexion();
        $consulta = $conn->query("SELECT nombre_SERVICIOS FROM servicios WHERE id_SERVICIOS = '$id'");
        $hores = $consulta->fetch_assoc();
        $conn->close();
        return $hores;
    }
    $cont = 0;
    $buscarNom = array();
    function nomCita($id, $dia, $hora){
        /*$conn = conexion();

        $consulta = $conn->query("SELECT nom_HORESPERDUDES FROM horesperdudes WHERE pk_idServei = '$id' AND dia_HORESPERDUDES = '$dia' AND hora_HORESPERDUDES = '$hora'");
        
        if($resultado = $consulta->fetch_assoc())
            return $resultado['nom_HORESPERDUDES'];
        else
            return "";*/
        global $cont, $buscarNom;
        $buscarNom[$cont]['id'] = $id;
        $buscarNom[$cont]['dia'] = $dia;
        $buscarNom[$cont]['hora'] = $hora;

        $cont++;
    }


    ?>
    <section id="main">
    <div class="centrar-text">
    <h2>
    <?php $nom = nomServei($id_servei);
    echo $nom['nombre_SERVICIOS'];
    ?>
    </h2>
    </div>

    <div class="container">
        <?php 
            if($id_servei == 0):
                echo '<div class="alert alert-danger">ID de servei desconegut. <a href="miCuenta.php">Tornar al meu compte</a></div>';
            else:
        ?>

        <table class="table table-bordered">
            <tr>
                <th></th>
                <th>
                    <?php 
                    echo $dia_ant; 
                    $dia[1] = $dia_ant;
                    ?>
                </th>
                <th>
                    <?php
                    $dia_seg = strtotime('+1 day' , strtotime ($dia_ant)) ;
                    $dia_seg = date('Y-m-j' , $dia_seg);
                    $dia_ant = $dia_seg;
                    $dia[2] = $dia_ant;
                    echo $dia_ant; 
                    ?>
                </th>
                <th>
                    <?php
                    $dia_seg = strtotime('+1 day' , strtotime ($dia_ant)) ;
                    $dia_seg = date('Y-m-j' , $dia_seg);
                    $dia_ant = $dia_seg;
                    $dia[3] = $dia_ant;
                    echo $dia_ant; 
                    ?>
                </th>
                <th>
                    <?php
                    $dia_seg = strtotime('+1 day' , strtotime ($dia_ant)) ;
                    $dia_seg = date('Y-m-j' , $dia_seg);
                    $dia_ant = $dia_seg;
                    $dia[4] = $dia_ant;
                    echo $dia_ant; 
                    ?>
                </th>
                <th>
                    <?php
                    $dia_seg = strtotime('+1 day' , strtotime ($dia_ant)) ;
                    $dia_seg = date('Y-m-j' , $dia_seg);
                    $dia_ant = $dia_seg;
                    $dia[5] = $dia_ant;
                    echo $dia_ant; 
                    ?>
                </th>
                <th>
                    <?php
                    $dia_seg = strtotime('+1 day' , strtotime ($dia_ant)) ;
                    $dia_seg = date('Y-m-j' , $dia_seg);
                    $dia_ant = $dia_seg;
                    $dia[6] = $dia_ant;
                    echo $dia_ant; 
                    ?>
                </th>
                <th>
                    <?php
                    $dia_seg = strtotime('+1 day' , strtotime ($dia_ant)) ;
                    $dia_seg = date('Y-m-j' , $dia_seg);
                    $dia_ant = $dia_seg;
                    $dia[7] = $dia_ant;
                    echo $dia_ant; 
                    ?>
                </th>
            </tr>
            <tr>
                <th></th>
                <th><?php echo saber_dia($dia[1]); ?></th>
                <th><?php echo saber_dia($dia[2]); ?></th>
                <th><?php echo saber_dia($dia[3]); ?></th>
                <th><?php echo saber_dia($dia[4]); ?></th>
                <th><?php echo saber_dia($dia[5]); ?></th>
                <th><?php echo saber_dia($dia[6]); ?></th>
                <th><?php echo saber_dia($dia[7]); ?></th>
            </tr>

            
            <?php 
            $j = 0;
            for ($i  = 1; $i <= 7; $i ++)
            $lliures[$i] = horeslliures($id_servei, $dia[$i]);

            
            foreach ($horari as $hora): 
                $class = "";
                $nom = "";
            ?>


            <tr>
                <th><?php echo $hora; ?></th>
                <?php
                    if (!in_array($hora, $lliures[1]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "") echo nomCita($id_servei, $dia[1], $hora); ?></td>
                <?php
                    if (!in_array($hora, $lliures[2]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "")  echo nomCita($id_servei, $dia[2], $hora); ?></td>
                <?php
                    if (!in_array($hora, $lliures[3]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "")  echo nomCita($id_servei, $dia[3], $hora); ?></td>
                <?php
                    if (!in_array($hora, $lliures[4]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "")  echo nomCita($id_servei, $dia[4], $hora); ?></td>
                <?php
                    if (!in_array($hora, $lliures[5]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "")  echo nomCita($id_servei, $dia[5], $hora); ?></td>
                <?php
                    if (!in_array($hora, $lliures[6]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "")  echo nomCita($id_servei, $dia[6], $hora); ?></td>
                <?php
                    if (!in_array($hora, $lliures[7]))
                        $class="success";
                    else
                        $class="";
                ?>
                <td id='<?php if($class != ""){ echo "ocupada" . $j; $j++; }?>'><?php if($class != "")  echo nomCita($id_servei, $dia[7], $hora); ?></td>
            </tr>

            <?php endforeach; ?>


        </table>
        <?php endif; ?>
    </div>
    </section>
    <!-- MODAL DE INFO DE CONTACTE ADOPCIÓ -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_contacte">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Informació de la cita</h4>
          </div>
          <div class="modal-body">
              <p><b>Telèfon:</b> <label id="lbl_telf"></label></p>
              <p><b>Descripció:</b> <label id="lbl_descripcio"></label></p>
          </div>
        </div>
      </div>
    </div>

    <script>
    $(document).ready(function(){
        var contador = parseInt("<?php echo $cont-1; ?>");
        var horesOcupades = <?php echo json_encode($buscarNom); ?>;
        var cont = 0;
        function peticioNom(id, dia, hora){
            $.getJSON("Slim/api.php/hores/nomHoresOcupades/" + id + "/" + dia + "/" + hora, function(response){
                if(response != ""){
                    $("td#ocupada" + cont).html('<button class="btn btn-link" id="btn_info_' + response[0].id_USUARIOS + cont + '" data-toggle="modal" href="#modal_contacte"><span class="glyphicon glyphicon-info-sign"></span></button>&nbsp;&nbsp;' + response[0].nombre_USUARIOS + '<button class="close"><span aria-hidden="true">&times;</span></button>');
                    $("td#ocupada" + cont).addClass("success");
                    $("#btn_info_" + response[0].id_USUARIOS + "" + cont).click(function(){OmplirDadesModal(response[0].telefono_USUARIOS, response[0].descripcion_CITAS)});
                }
                cont++;
                if (cont<=contador){
                    peticioNom(horesOcupades[cont].id, horesOcupades[cont].dia, horesOcupades[cont].hora);
                }              
            });
        }

        var lbl_telefon = $("#lbl_telf");
        var lbl_descripcio = $("#lbl_descripcio");


        function OmplirDadesModal(telf, descripcio){
          lbl_telefon.html(telf);
          lbl_descripcio.html(descripcio);
        }

        peticioNom(horesOcupades[cont].id, horesOcupades[cont].dia, horesOcupades[cont].hora);

        
    });
    </script>

    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/jquery.scrollgress.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
    
</div>
</body>
</html>
