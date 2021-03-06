<html>
	<head>
		<?php
		//CRIDA DADES ANIMAL
		function animal($id){
			$ch = curl_init();  
			curl_setopt($ch, CURLOPT_URL, "http://pekiapp.azurewebsites.net/Slim/api.php/animales/" . $id);    
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
			$data = json_decode(curl_exec($ch), true);

			curl_close($ch);
			return $data[0];
		}
		$animal = animal($_GET['animal']);
		
		$titol =  $animal['nombre_ANIMALES'] . " - " . ($animal['adopcion_ANIMALES'] == "NO" ? "Lost&Find" : "Adopta") . " - PekiApp";
		$actiu = 0;
		include 'head.php';
        $tamany = ($animal['medida_ANIMALES'][0] == 'g' ? "Gran" : ($animal['medida_ANIMALES'][0] == 'm' ? "Mitjà" : "Petit"));

		?>

	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>
				</header>

			<!-- Main -->
				<section id="main">
					<div class="container">
					<div class="col-md-10 col-md-offset-1">
			      		<div class="marge-abaix">
			      			<a href="serveis-tots.php"><img src="images/banner_serveis.jpg" alt="" class="max100"></a>
			      		</div>
						<div class="well">
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-6">
							          	<h2 class="centrar-text">
						          			<?php echo $animal['nombre_ANIMALES']; ?>
										</h2>
									</div>
								</div>
								<div class="col-md-6">
						          	<div class="centrar-text">
						          		<img src="<?php echo $animal['urlGran_ANIMALES']; ?>" class="img-circle img-animal">
						          	</div>
					          	</div>

					          	<div class="col-md-5 col-md-offset-1">
						          		<p class="no-margin"><b>Nom:</b> <?php echo $animal['nombre_ANIMALES']; ?></p>
							          	<p class="no-margin"><b>Sexe:</b> <?php echo $animal['sexo_ANIMALES']; ?></p>
							          	<p class="no-margin"><b>Mida:</b> <?php echo $tamany; ?></p>
							          	<p class="no-margin"><b>Raça:</b> <?php echo $animal['raza_ANIMALES']; ?></p>
							          	<p class="no-margin"><b>Edat:</b> <?php echo $animal['edad_ANIMALES']; ?></p>
							          	<p class="no-margin"><b>Color:</b> <?php echo $animal['color_ANIMALES']; ?></p>
							          	<p class="no-margin"><b>Vacunes:</b> <?php echo $animal['vacunes_ANIMALES']; ?></p>
						        </div>
					        </div>
				        </div>
				        <div class="well">
				          	<div class="row">
						        <div class="col-md-10 col-md-offset-1">
									<p class="no-margin" style="text-align: justify"><b>Descripció:</b> <br><?php echo $animal['descripcion_ANIMALES']; ?></p>          	
								</div>
							</div>

					        <div class="row">
					        	<div class="text-center marge-dalt">
					        		<?php if($animal['adopcion_ANIMALES'] == "NO") : ?>
					        		<button class="button btn-afegir" id="btn_animal_trobat" value="<?php echo $animal['id_ANIMALES']; ?>">L'he vist!</button>
					        		<div id="result_vist"></div>
					        		<?php else : ?>
					        		<form id="form_adoptar">
					        		<input type="hidden" name="token_usuario" value="<?php echo $_COOKIE['id']; ?>">
					        		<input type="hidden" name="id_animal" value="<?php echo $_GET['animal']; ?>">
					        		<?php if(isset($_COOKIE['tipo']) && $_COOKIE['tipo'] == "normal"): ?>
					        		<button type="submit" class="button btn-afegir" id="btn_animal_adoptar">Adopta</button>
					        		<?php elseif(!isset($_COOKIE['id'])): ?>
				        			<button type="submit" class="button btn-afegir" disabled>Adopta</button>
					        		<p>(Has de <a href="login.php">iniciar sessió</a> o <a href="registre.php">registrar-te</a>)</p>
					        		<?php endif; //si el tipus no es normal, o no està loggat, no surtirà cap botó ?>

					        		</form>
					        		<div id="result_adopta"></div>
				        			<?php endif; ?>
					        	</div>
				      		</div>
			      		</div>
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
			<script src="assets/js/fitxa.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>