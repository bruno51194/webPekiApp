<!DOCTYPE HTML>
<html>
	<head>
		<?php 
			$titol = "Pekiapp - Perfil d'usuari";
			$actiu = 6;
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
				        <div class="col-md-3">
				        <div class="well">
				        	<ul class="nav nav-pills nav-stacked">
				                <li role="presentation"><a class="pointer" id="btn_perfil">Perfil</a></li>
				                <li role="presentation"><a class="pointer" id="btn_contrasenya">Contrasenya</a></li>

				                <?php 
								if(isset($_COOKIE['tipo'])):
				                switch ($_COOKIE['tipo']) {
				                	case 'normal': ?>
										<li role="presentation"><a class="pointer" id="btn_animals">Animals perduts</a></li>
				                	<?php break;
				                	case 'empresa': ?>
				                		<li role="presentation"><a class="pointer" id="btn_serveis">Serveis</a></li>
				                	<?php break;
				                	case 'protectora': ?>
				                		<li role="presentation"><a class="pointer" id="btn_adopcions">Adopcions</a></li>	
				            	<?php 
				            			break;
				                	}
				            	endif; ?>
				                <li role="presentation"><a href="index.php" id="btn_logout">Tancar Sessió</a></li>
			              	</ul>
				        </div>
				        </div>
			        
						<section id="perfil" class="col-md-9">
					      <h3>El meu perfil</h3>
					      <form id="formPerfil">
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
									<input type="text" class="form-control" id="correu_nou" name="correu_nou" disabled>
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
								
								<button type="button" id="btn_actualitzarPerfil" class="button">Actualitzar</button>
					      </form>
					    </section>
					    <section id="contrasenya" class="col-md-8">
					      <h3>Canviar contrasenya</h3>
					      <form>
					      		<div class="form-group">
					      			<div class="col-md-12">
										<label>Antiga contrasenya:</label>
									</div>
									<div class="col-md-4">
										<input type="password" class="form-control" id="contrasenya_antiga" name="contrasenya_antiga">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<label>Nova contrasenya:</label>
									</div>
									<div class="col-md-4">
										<input type="password" class="form-control" id="contrasenya_nova" name="contrasenya_nova">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<label>Repetir nova contrasenya:</label>
									</div>
									<div class="form-group col-md-4">
										<input type="password" class="form-control" id="repetir_contrasenya_nova" name="repetir_contrasenya_nova">
									</div>
								</div>
								<div class="col-md-12">					
									<button type="button" class="button">Actualitzar</button>
								</div>
					      </form>
					    </section>
					    <section id="animals" class="col-md-8">
					    	<h3>Els meus animals perduts</h3>	    
				            <table class="table table-striped" id="taula_animals">
				                <tr>
				                	<th></th>
				                	<th></th>
				                    <th><strong>Nom</strong></th>
				                    <th><strong>Tipus</strong></th>
				                    <th><strong>Sexe</strong></th>
				                </tr>
				            </table>
				        </section>

				        <section id="serveis" class="col-md-8">
				        	<h3>Els meus serveis</h3>
				        	<div id="div_serveis"></div>
				        </section>
				        <section id="adopcions" class="col-md-8">
				        	<h3>Les meves peticions d'adopció</h3>
				        	<div id="div_adopcions" class="col-md-12"></div>
				        </section>

				        <!-- MODAL DE INFO DE CONTACTE ADOPCIÓ -->
						<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal_contacte">
						  <div class="modal-dialog modal-sm">
						  	<div class="modal-content">
						      <div class="modal-header">
							      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							      <h4 class="modal-title" id="myModalLabel">Informació de contacte</h4>
						      </div>
						      <div class="modal-body">
							      <p><b>Telèfon:</b> <label id="lbl_telf"></label></p>
							      <p><b>Email:</b> <label id="lbl_email"></label></p>
							      <p><b>Ciutat:</b> <label id="lbl_ciutat"></label></p>
							      <p><b>Codi Postal:</b> <label id="lbl_cp"></label></p>
						      </div>
						    </div>
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
			<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
			<script src="assets/js/miCuenta.js"></script>

	</body>
</html>