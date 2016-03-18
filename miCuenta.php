<!DOCTYPE HTML>
<html>
	<head>
		<?php 
			$titol = "Lost&Find Mi cuenta";
			$actiu = 0;
			include 'head.php';
		?>
		<link rel="stylesheet" href="assets/css/custom.css" />
	</head>
	<body>
		<div id="page-wrapper">
			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>
				</header>

			<!-- Main -->
				<section id="main" class="container">
			        <div class="container">
			        <div class="centrar-text">
			        	<h2>Àrea de configuració</h2>
			        </div>		         
			        <div class="menuConfiguracio col-md-4">
			        	<ul>
						  <li><a role="button" data-toggle="collapse" data-parent="#accordion" href="#laMevaCompte" aria-expanded="true" aria-controls="laMevaCompte">El meu perfil</a></li>
						  <li><a href="#">Els meus animals</a></li>
						  <li><a href="#">Serveis</a></li>
						  <li><a href="#">Lost and Find</a></li>
						  <li><a href="#">Adopcions</a></li>
						  <li><a href="#">Compras</a></li>
						</ul>
			        </div>
		            	<div id="laMevaCompte" class="panel-collapse collapse in col-md-8" role="tabpanel" aria-labelledby="headingOne">
					      <div class="panel-body">
						      <h3>El meu perfil</h3>
						      <form>
						      		<div class="form-group col-md-3">
										<label>Nom:</label>
										<input type="text" class="form-control" id="nom_nou" name="nom_nou">
									</div>
									<div class="form-group col-md-3">
										<label>Cognom:</label>
										<input type="text" class="form-control" id="cognom_nou" name="cognom_nou">
									</div>
									<div class="form-group col-md-6">
										<label>Correu electrònic:</label>
										<input type="text" class="form-control" id="correu_nou" name="correu_nou">
									</div>
									<div class="form-group col-md-4">
										<label>Població:</label>
										<input type="text" class="form-control" id="poblacio_nou" name="poblacio_nou">
									</div>
									<div class="form-group col-md-4">
										<label>Codi Postal:</label>
										<input type="text" class="form-control" id="cp_nou" name="cp_nou">
									</div>
									<div class="form-group col-md-4">
										<label>Telèfon:</label>
										<input type="text" class="form-control" id="telefon_nou" name="telefon_nou">
									</div>
									<div class="form-group col-md-12">
										<label>Descripció:</label>
										<textarea class="form-control" rows="4" id="descripcio_nou" name="descripcio_nou"></textarea>
									</div>
									<button type="button" id="enviar" class="button">Actualitzar</button>
						      </form>
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
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>