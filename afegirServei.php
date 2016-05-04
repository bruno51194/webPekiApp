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
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>
				</header>

				<?php $tipos = $_GET["tipos"]; ?>
				<div class="centrar-text marge-daltPlus">
					<h2>Afegir un Servei</h2>
				</div>
				<div class="container">
					<form class="form-horizontal">
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-4">
					      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="col-sm-2 control-label">Password</label>
					    <div class="col-sm-4">
					      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-4">
					      <button type="submit" class="btn btn-default">Enviar Solicitud</button>
					    </div>
					  </div>
					</form>	
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

	</body>
</html>