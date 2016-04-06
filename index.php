<!DOCTYPE HTML>

<?php 
	include '_functions/functions.php'; 
?>
<html>
	<head>
		<?php 
			$titol = "Pekiapp";
			$actiu = 1;
			include 'head.php';
		?>
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<?php 
					if(!isset($_COOKIE['id'])){
						include 'topmenu.php';
					}else{
						include 'topmenu_val.php';
					} ?>
				</header>

			<!-- Banner -->
				<section id="banner">
					<img src="oie_transparent.png" width="200px" height="220px">

					<div class="resum">
					<h2>Pekiapp</h2>
					<p>Mantindrà organitzada tota la informació que li donis sobre la teva mascota i hi podràs accedir des de qualsevol lloc.
					<br>En el cas de pérdua de la teva mascota Pekiapp ofereix un serivei per posar en contacte la gent que ha perdut la seva mascota <br>amb la gent que hagi trobat alguna mascota, també facilitara la reincerció de mascotes amb el nostre servei d'adopció.</p>
					</div>
					<?php if (!isset($_COOKIE['id'])) :?>
						<ul class="actions">
							<li><a class="button special" href="login.php">Accedeix</a></li>
							<li><a class="button"  href="registro.php">Registra't</a></li>
						</ul>
					<?php else : ?>
						<div style="padding: 20px"/>
					<?php endif ?>
				</section>

				
			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2>Utilitza els nostres serveis</h2>
							<p>PekiApp ofereix a l’usuari tenir un control total sobre els serveis que necessita la seva mascota.<br>
							Des de el telèfon mòbil o l’ordinador, permet accedir a un ampli ventall de professionals (veterinaris, hotels, perruqueries canines, etc...)</p>
						</header>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->		
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
						    <div class="item active">
						      <img src="images/gato-banner.png" alt="veterinario curando perro">
						    </div>
						    <div class="item">
						      <img src="images/veterinario-banner.jpg" alt="gato">
						    </div>
						  </div>

						  <!-- Controls -->
						  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						    <span class="sr-only">Anterior</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						    <span class="sr-only">Següent</span>
						  </a>
						</div>
 <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->						
					</section>
					<section class="box special features">
						<div class="features-row">
							<section>
								<img src="images/seveis/perruqueria_logo.png" alt="perruqueria canina" class="img-circle" width="120px" height="120px">
								<h3>Perruqueries</h3>
								<p>Coneix les millors perruqueries que tens al voltant per portar a les teves mascotes.</p>
							</section>
							<section>
								<img src="images/seveis/paseador_logo.png" alt="passejadors canins" class="img-circle" width="120px" height="120px">
								<h3>Passejadors</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
						<div class="features-row">
							<section>
								<img src="images/seveis/veterinari_logo.png" alt="veterinaris canins" class="img-circle" width="120px" height="120px">
								<h3>Veterinaris</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
							<section>
								<img src="images/seveis/guarderia_logo.png" alt="guarderia canina" class="img-circle" width="120px" height="120px">
								<h3>Guarderies canines</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
						<div class="features-row">
							<section>
								<img src="images/seveis/club_esportiu_logo.png" alt="club esportiu caní" class="img-circle" width="120px" height="120px">
								<h3>Clubs esportius</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
							<section>
								<img src="images/seveis/educacio_canina_logo.png" alt="educacio canina" class="img-circle" width="120px" height="120px">
								<h3>Educadors canins</h3>
								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
					</section>

					<div class="row">
						<div class="6u 12u(narrower)">
							<section class="box special">
								<span class="image featured"><img src="images/lost&find.jpg" alt="perduts i trobats" /></span>
								<h3>Lost & Find</h3>
								<p>Ajuda a les persones que han perdut les seves mascotes, si t'has trobat amb alguna mascota sense propietari accedeix aqui per ajudar-la.</p>
								<ul class="actions">
									<li><a href="#" class="button special">Entrar</a></li>
								</ul>
							</section>

						</div>
						<div class="6u 12u(narrower)">
							<section class="box special">
								<span class="image featured"><img src="images/adoptals.jpg" alt="adopta'ls" /></span>
								<h3>Adopta'ls</h3>
								<p>Tant si vols donar en adopció com si vols adoptar algun animal, entra aqui per poder ajudar als animals sense llar i ajudar en la seva reincerció.</p>
								<ul class="actions">
									<li><a href="#" class="button special">Entrar</a></li>
								</ul>
							</section>

						</div>
					</div>

				</section>

			<!-- CTA -->
				<section id="cta">

					<h2>Subscriu-te</h2>
					<p>Subscriu-te al nostre butlletí per poder rebre totes les novetats de la nostra web!</p>

					<form>
						<div class="row uniform 50%">
							<div class="8u 12u(mobilep)">
								<input type="email" name="email" id="email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'];?>"/>
							</div>
							<div class="4u 12u(mobilep)">
								<input type="submit" value="Subscripció" class="fit" />
							</div>
						</div>
					</form>

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