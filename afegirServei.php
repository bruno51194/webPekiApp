<!DOCTYPE HTML>
<html>
	<head>
		<?php 
			$titol = "Afegir Servei";
			$actiu = 4;
			include 'head.php';

		?>
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>
				</header>

				<?php $tipos = $_GET["tipos"]; ?>
				<div class="col-md-offset-5 marge-dalt marge-abaix">
					<h2>Afegir un Servei</h2>
				</div>
				<div class="container">
				<div class="col-md-offset-3 col-md-3">
					<h3>Tipus de Servei:</h3>
				</div>
					<h3><strong><?php echo $tipos?></strong></h3>
				<div class="centrar-text">
					<form class="form-horizontal" id="form-solicitudServei" name="form-solicitudServei">
					  <div class="form-group">
					  <label class="col-md-2 col-md-offset-2 control-label">Nom:</label>
					    <div class="col-md-4">
					      <input type="text" class="form-control" id="nom" name="nom" placeholder="Afegeix el nom del servei">
					    </div>
					  </div>
					  <div class="form-group">
					  <label class="col-md-2 col-md-offset-2 control-label">Ciutat:</label>
					    <div class="col-md-4">
					      <input type="text" class="form-control" id="ciutat" name="ciutat" placeholder="Afegeix la ciutat del servei">
					    </div>
					  </div>
					  <div class="form-group">
					  <label class="col-md-2 col-md-offset-2 control-label">Direcció:</label>
					    <div class="col-md-4">
					      <input type="text" class="form-control" id="direccio" name="direccio" placeholder="Afegeix la direcció del servei">
					    </div>
					  </div>
					  <div class="form-group">
					  <label class="col-md-2 col-md-offset-2 control-label">Horari de matins:</label>
					    <div class="col-md-4">
					    	<div class="col-md-6">
					    		<input type="time" id="min-mati" class="form-control" name="min-mati"></input>
					    	</div>
					     	<div class="col-md-6">
					     		<input type="time" id="max-mati" class="form-control" name="max-mati"></input>
					     	</div>
					    </div>
					  </div>
					  <div class="form-group">
					  <label class="col-md-2 col-md-offset-2 control-label">Horari de tardes:</label>
					    <div class="col-md-4">
					    	<div class="col-md-6">
					    		<input type="time" id="min-tarda" class="form-control" name="min-tarda"></input>
					    	</div>
					     	<div class="col-md-6">
					     		<input type="time" id="max-tarda" class="form-control" name="max-tarda"></input>
					     	</div>
					    </div>
					  </div>
					  <div class="form-group">
					  <label class="col-md-2 col-md-offset-2 control-label">Descripció:</label>
					    <div class="col-md-4">
					      <textarea class="form-control" id="descripcio" name="descripcio" rows="6" placeholder="Afegeix una descripció sobre els serveis que ofereix"></textarea>
					    </div>
					  </div>
					  <input type="hidden" class="form-control" id="tipus" name="tipus" value="<?php echo $tipos?>">
					  <div class="form-group">
					    <div class="col-sm-offset-4 col-sm-4">
					      <button type="submit" class="btn btn-default">Enviar Solicitud</button>
					    </div>
					  </div>
					</form>
					<div class="marge-abaix"><h6>Quan enviïs la solicitud del servei, ens posarem en contacte mitjançant correu electrònic en un plaç aproximat de 24 a 48 hores.</h6></div>
						
				</div>
				
				</div>
				

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
			<script src="assets/js/afegirServei.js"></script>

	</body>
</html>