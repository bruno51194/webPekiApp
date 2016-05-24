<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<?php 
			$titol = "Contacte - PekiApp";
			$actiu = 5;
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
				<section id="main" class="container 75%">
					<header>
						<h2>Formulari de contacte</h2>
					</header>
					<div class="box">
						<div id="form_contacte">
							<div class="row uniform 50%">
								<div class="6u 12u(mobilep)">
									<input type="text" name="nom" id="nom" value="" placeholder="Nom" />
								</div>
								<div class="6u 12u(mobilep)">
									<input type="email" name="correu" id="correu" value="" placeholder="Correu" />
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<input type="text" name="assumpte" id="assumpte" value="" placeholder="Assumpte" />
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<textarea name="missatge" id="missatge" placeholder="Escriu el teu missatge" rows="6"></textarea>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><button class="button" id="button_contacte">Enviar missatge</button></li>
									</ul>
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
			<script type="text/javascript">
				$(document).ready(function(){
					$("#button_contacte").click(function(){
						$("#alert").remove();
						$("#form_contacte").append("<div id='alert' class='alert alert-success marge-dalt'>Missatge enviat!</div>").fadeIn();
						setTimeout(function(){
							window.location.href = "index.php";
						}, 2000);
					});
				});
			</script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>