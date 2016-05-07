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
									echo "<span class='image featured'><img src='images/pic01.jpg' alt='' /></span>";
									break;
								case 'Passejadors':
									echo "<p>Troba als millors passejadors per deixar als teus animals.</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/pic01.jpg' alt='' /></span>";
									break;
								case 'Veterinaris':
									echo "<p>Els millors profesionals licenciats en veterinaria</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/seveis/veterinari-servei.jpg' alt='' /></span>";
									break;
								case 'Clubs Esportius':
									echo "<p>Porta les teves mascotes als clubs esportius més selectes</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/pic01.jpg' alt='' /></span>";
									break;
								case 'Educadors Canins':
									echo "<p>Els millors professionals en el sector de l'educació canina</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/pic01.jpg' alt='' /></span>";
									break;
								case 'Guarderies Canines':
									echo "<p>Deixa els teus animals a les nostres guarderies amb la máxima tranquilitat</p>";
									echo "</header>";
									echo "<span class='image featured'><img src='images/pic01.jpg' alt='' /></span>";
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
						<div id="panell-professionals" class="panel panel-info marge-abaix"></div>
					</div>
					
					  
					

				</section>			

				<section id="banner_serveis">
					<?php //posar un if per controlar que nomes aparegui al accedir amb un usuari que sigui una empresa ?>
					<div class="centrar-text">
						<span class='image featured'><a href="afegirServei.php?tipos=<?php echo $tipos ?>"><img src='images/afegeix-servei.png' alt='afegir servei' /></a></span>
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
			<script src="assets/js/servei.js"></script>

	</body>
</html>