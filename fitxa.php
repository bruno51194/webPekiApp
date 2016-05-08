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
			          	<div class="centrar-text"><img src="<?php echo $animal['url_ANIMALES']; ?>" class="img-circle img-animal"></div>
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
				          	<p style="text-align: justify"><b>Historia:</b> <br>El van abandonar. <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at justo eget metus dictum aliquam. Nam gravida ac ipsum in blandit. Donec ut enim metus. Cras a mi neque. Ut eget turpis finibus, imperdiet arcu sit amet, laoreet ante. Cras fringilla tellus in nisi mollis convallis. Nunc quis hendrerit libero, in dictum diam. Aliquam sit amet nisl enim. Sed convallis est nec lorem elementum consectetur. Donec eleifend, nunc ut mollis vulputate, tortor metus vehicula massa, vitae tincidunt diam nulla eget nisl. Nam iaculis enim sem, eget interdum nulla vulputate vel. Nulla mollis facilisis mi. Nulla non arcu id eros dignissim eleifend. Morbi vel tellus augue. Mauris ultricies ipsum metus, tincidunt vestibulum erat congue ut.</p>
				          	</div>
				        </div>
				        <div class="row">
				        	<div class="text-center marge-dalt">
				        		<?php if($animal['adopcion_ANIMALES'] == "NO") : ?>
				        		<button class="button btn-afegir" id="btn_animal_trobat" value="<?php echo $animal['id_ANIMALES']; ?>">L'he vist!</button>
				        		<?php else : ?>
				        		<button class="button btn-afegir" id="btn_animal_adoptar">Adopta</button>
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