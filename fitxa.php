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
		
		$titol =  $animal['nombre_ANIMALES'] . " - " . ($animal['adopcion_ANIMALES'] == "NO" ? "Lost&Find" : "Adopta");
		$actiu = 0;
		include 'head.php';
		?>

	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>
				</header>

			<!-- Main -->
				<section id="animal" class="container">
					<div class="container">
			          	<h2 class="centrar-text">
		          		<?php echo $animal['nombre_ANIMALES']; ?>
						</h2>
			          	<div class="centrar-text"><img src="<?php echo $animal['urlGran_ANIMALES']; ?>" class="img-circle img-animal"></div>
			          	<div class="marge-dalt">
				          	<div class="col-md-3 col-md-offset-1">
				          		<p><b>Nom:</b> <?php echo $animal['nombre_ANIMALES']; ?></p>
					          	<p><b>Sexe:</b> <?php echo $animal['sexo_ANIMALES']; ?></p>
					          	<p><b>Tamany:</b> <?php echo $animal['medida_ANIMALES']; ?></p>
					          	<p><b>Raça:</b> <?php echo $animal['raza_ANIMALES']; ?></p>
					          	<p><b>Edat:</b> <?php echo $animal['edad_ANIMALES']; ?></p>
					          	<p><b>Color:</b> <?php echo $animal['color_ANIMALES']; ?></p>
					          	<p><b>Vacunes:</b> <?php echo $animal['vacunes_ANIMALES']; ?></p>
					        </div>
					        <div class="col-md-7">
								<p style="text-align: justify"><b>Descripció:</b> <br><?php echo $animal['descripcion_ANIMALES']; ?></p>				          	
							</div>
				        </div>
				        <div class="row">
				        	<div class="text-center marge-dalt">
				        		<?php if($animal['adopcion_ANIMALES'] == "NO") : ?>
				        		<button class="button btn-afegir" id="btn_animal_trobat" value="<?php echo $animal['id_ANIMALES']; ?>">L'he vist!</button>
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
			        			<?php endif; ?>
				        	</div>
				        </div>

			      	</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
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