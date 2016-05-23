<!DOCTYPE HTML>
<html>
	<head>
		<?php 
			$titol = "Serveis";
			$actiu = 4;
			include 'head.php';

		?>
	</head>
	<body>

		<?php

			if(isset($_POST['solicitar'])){

				define('BD_SERVIDOR', 'eu-cdbr-azure-north-d.cloudapp.net');
				define('BD_NOMBRE', 'pekiappbbdd');
				define('BD_USUARIO', 'b509fbe59f7e43');
				define('BD_PASSWORD', '69edfef4'); 
			
				$dia = $_POST['data'];
			    $hora = $_POST['horari'];
			    $descripcio = $_POST['descripcio'];

			    $conn = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);

			    $sql1 = "SELECT id_USUARIOS FROM usuarios WHERE token_USUARIOS = '" . $_COOKIE['id'] . "'";
			    $result = $conn->query($sql1);
			    $idusuario = $result->fetch_assoc();
			    $idServei = $_COOKIE['idServei'];

			    $sql2 = "INSERT INTO citas(fk_usuario_CITAS, fk_servicio_CITAS,dia_CITAS,hora_CITAS, descripcion_CITAS) 
			                    VALUES('" . $idusuario['id_USUARIOS'] . "','" . $idServei . "','". $dia . "','". $hora . "','" . $descripcio ."')";
			    if ($conn->query($sql2) === FALSE) {
			        echo "Error insertin' record: " . $conn->error;
			    }else{
			        echo "1";
			    } 

			}

		?>

		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>

				</header>

				<?php $tipos = $_GET["tipos"]; ?>

			<!-- Main -->
				<section id="main" class="container">

					<div class="centrar-text">
					<header>
						<h2><?php echo $tipos ?></h2>				
						<?php 
							switch ($tipos) {
								case 'Perruqueries':
									echo "<p>Les millors perruqueries per portar a les teves mascotes.</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/perruqueria-servei.jpg' alt='' /></span>";
									break;
								case 'Passejadors':
									echo "<p>Troba als millors passejadors per deixar als teus animals.</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/pasejadors-servei.jpg' alt='' /></span>";
									break;
								case 'Veterinaris':
									echo "<p>Els millors profesionals licenciats en veterinaria</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/veterinari-servei.jpg' alt='' /></span>";
									break;
								case 'Clubs Esportius':
									echo "<p>Porta les teves mascotes als clubs esportius més selectes</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/club-servei.jpg' alt='' /></span>";
									break;
								case 'Educadors':
									echo "<p>Els millors professionals en el sector de l'educació animal</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/ensinistradors-servei.jpg' alt='' /></span>";
									break;
								case 'Residencies':
									echo "<p>Deixa els teus animals a les nostres residencies d'animals amb la máxima tranquilitat</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/guarderia-servei.jpg' alt='' /></span>";
									break;
								default:
									break;
							}
						?>
					</div>
				</section>

				<section class="container">

					<div class="centrar-text"><h2>Llistat de profesionals:</h2></div>
				
					<div class="col-md-offset-2 col-md-8">
						<div id="panell-professionals"></div>
					</div>
					
					  
					<!-- Modal -->
					<div class="modal fade" id="modalCita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Solicitar Cita</h4>
					      </div>
					      <div class="modal-header">
						      <form id="formCita" class="form-horizontal" action="serveis.php?tipos=<?php echo $tipos; ?>" method="POST" role="form">
						      		<div class="form-group col-md-6">
									    <label>Data:</label>
									    <input type="date" class="form-control" id="data" name="data" onchange="hores(data.value)">
									</div>
									<div class="form-group col-md-6">
										<label>Hora:</label>
										<select id="horari" name="horari"></select>	
									</div>
									<div class="form-group col-md-12">
									    <label>Descripcio:</label>
									    <textarea class="form-control" id="descripcio" name="descripcio" placeholder="Explica breument en que consisteix la teva visita" rows="3"></textarea>
									</div>
									<input type="submit" id="solicitar" name="solicitar" value="Solicitar" class="btn btn-primary"></input>
								</form>
					      </div>					       
					      <div class="modal-footer">
					       		        
					      </div>
					    </div>
					  </div>
					</div>

				</section>			

				<section id="banner_serveis">
					<div class="centrar-text">
						<span class='image featured'><a href="afegirServei.php?tipos=<?php echo $tipos ?>"><img src='images/afegeix-servei.png' alt='afegir servei' /></a></span>
					</div>
					
				</section>

			<!-- Footer -->
				<footer id="footer">
				<?php include 'footer.php'; ?>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/servei.js"></script>

	</body>
</html>