<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 
	include '_functions/functions.php'; 
?>
<html>
	<head>
		<title>PEKKIAPP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<script src="assets/js/jquery.min.js" type="text/javascript"></script>

		<!--CSS bootstrap CDN-->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
		<!--JS bootstrap CDN-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
		<script src="assets/js/validator.js" type="text/javascript"></script>
				<script type="text/javascript">
			$(document).ready(function(){
				$('#enviar_login').click(function(){
					var resultadoCorrecto2 = $("#resultadocorrecto2");
					var resultadoError2 = $("#resultado_error2");
					$.ajax({
						url: "resultado_login.php",
						type: "POST",
						data: $("#form_login").serialize(),
						success: function(responseText){

				                var responseTextarray = responseText.split(" ");

				                if(responseTextarray[0] == "1"){
				                	window.location.href = "/scripts/webPekiApp/";
				                }
				                else if(responseTextarray[0] == "2"){
				                	resultadoError2.removeClass("hidden");
				                	resultadoError2.html("<div class='alert alert-danger'>Email o contrasenya incorrectes</div>");

				                }
				                else if(responseTextarray[0] == "3"){
				                	resultadoError2.removeClass("hidden");
				                	resultadoError2.html("<div class='alert alert-danger'>Format invàlid de email</div>");
				                }else{
				                    alert('Opss! Ha ocurrido algun problema.');
				                }
				        }
				    });
					return false;
				});
				$('#enviar_registro').click(function(){
					var resultadoCorrecto = $("#resultadocorrecto");
					var resultadoError = $("#resultadoerror");
					$.ajax({
						url: "resultado_registro.php",
						type: "POST",
						data: $("#form_registro").serialize(),
						success: function(responseText){

				                var responseTextarray = responseText.split(" ");

				                if(responseTextarray[0] == "1"){
				                	$("#form_registro").html("<div id='resultado_correcto' class='form-group text-center'><div class='alert alert-success'><strong>Operació exitosa!</strong>T'has registrat a PekiApp.</div></div>");
				                }
				                else if(responseTextarray[0] == "2"){
				                	resultadoError.removeClass("hidden");
				                	resultadoError.html("<div class='alert alert-danger'>Aquest email ja existeix</div>");

				                }
				                else if(responseTextarray[0] == "3"){
				                	resultadoError.removeClass("hidden");
				                	resultadoError.html("<div class='alert alert-danger'>Format invàlid de email</div>");
				                }
				                else if(responseTextarray[0] == "4"){
				                	resultadoError.removeClass("hidden");
				                	resultadoError.html("<div class='alert alert-danger'>Hi ha camps sense completar</div>");
				                }else{
				                	alert(responseTextarray[0]);
				                    alert('Opss! Ha ocurrido algun problema.');
				                }
				        }
				    });
					return false;
				});
			});
		</script>


		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<?php include 'topmenu.php'; ?>
				</header>

			<!-- Banner -->
				<section id="banner">
					<img src="oie_transparent.png" width="200px" height="220px">

					<div class="resum">
					<h2>Pekiapp</h2>
					<p>Mantindrà organitzada tota la informació que li donis sobre la teva mascota i hi podràs accedir des de qualsevol lloc.
					<br>En el cas de pérdua de la teva mascota Pekiapp ofereix un serivei per posar en contacte la gent que ha perdut la seva mascota <br>amb la gent que hagi trobat alguna mascota, també facilitara la reincerció de mascotes amb el nostre servei d'adopció.</p>
					</div>
					<ul class="actions">
						<li><button type="button" class="button special" data-toggle="modal" data-target="#login">Accedeix</a></li>
						<li><button type="button" class="button" data-toggle="modal" data-target="#registro">Registra't</button></li>
					</ul>
				</section>

				<!-- Modal Registro -->
				<div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title" id="myModalLabel">Registre</h4>
				      </div>
				      <div class="modal-body">
				      <div>
				      	<form id="form_registro" role="form" data-toggle="validator">
				      	<div class="row">
				      		<div class="form-group col-md-5 col-md-offset-1" >
							    <label>Nom</label>
							    <input type="text" class="form-control" name="nom" placeholder="Nom" required>
						  	</div>
						  	<div class="form-group col-md-5">
							    <label>Cognom</label>
							    <input type="text" class="form-control" name="cognom" placeholder="Cognom" required>
						  	</div>
						  	<div class="form-group col-md-10 col-md-offset-1">
							    <label>Correu</label>
							    <input type="email" class="form-control" name="correu" placeholder="Correu electronic" required>
						  	</div>
						  	<div class="form-group col-md-5 col-md-offset-1" >
							    <label>Contrasenya</label>
							    <input type="password" class="form-control" name="contrasenya" placeholder="Contrasenya" required>
						  	</div>
						  	<div class="form-group col-md-5">
							    <label>Repetir contrasenya</label>
							    <input type="password" class="form-control" name="repetirContrasenya" placeholder="Repetir contrasenya" required>
						  	</div>
						  	<div class="form-group col-md-5 col-md-offset-1">
							    <label>Codi Postal</label>
							    <input type="text" class="form-control" name="cp" placeholder="Codi Postal" required>
						  	</div>
						  	<div class="form-group col-md-5">
							    <label>Poblacio</label>
							    <input type="text" class="form-control" name="poblacio" placeholder="Poblacio" required>
						  	</div>
						  	<div class="form-group col-md-10 col-md-offset-1">
							    <label>Adreça</label>
							    <input type="text" class="form-control" name="direccio" placeholder="Adreça" required>
						  	</div>
						  	<div class="form-group col-md-5 col-md-offset-1">
							    <label>Telefon</label>
							    <input type="text" class="form-control" name="telefon" placeholder="Telefon" required>
						  	</div>

						  	
	
						 </div>

							 <div id="resultadoerror" class="form-group text-center hidden">
							 </div>

							    <div class="modal-footer">
								    <div class="form-group">
								    <div class="checkbox">
								      <label>
								        <input type="checkbox" id="terms" data-error="S'han d'acceptar els termes i condicions" required>
								        <span class="esquerra">Accepto els <a>termes i condicions</a>.</span>
								      </label>
								      <div class="help-block with-errors esquerra"></div>
								    </div>
								  </div>
								   
								<div class="form-group">
								    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								    <button type="submit" id="enviar_registro" class="btn btn-primary">Enviar</button>
								</div>
							</div>
				      	</form>
				      </div>				      	
				      </div>
				    
				    </div>
				  </div>
				</div>

				<!-- Modal Login -->
				<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Accedeix</h4>
				      </div>
				      <div class="modal-body">
				      	<form id="form_login" role="form" data-toggle="validator">
				      	<div class="row">
					        <div class="form-group col-md-5 col-md-offset-1" >
							    <label>Email</label>
							    <input type="email" class="form-control" name="email_login" placeholder="Email" required>
						  	</div>
						  	<div class="form-group col-md-5">
							    <label>Contrasenya</label>
							    <input type="password" class="form-control" name="contrasenya_login" placeholder="Contrasenya" required>
						  	</div>
						</div>
					  	</form>			      
				      </div>
				  	<div id="resultado_error2" class="form-group text-center hidden">
						  	<div class="alert alert-danger">
					  		Format invàlid de email
						</div>
					</div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				        <button type="submit" id="enviar_login" class="btn btn-primary">Enviar</button>
				      </div>
				    </div>
				  </div>
				</div>

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
								<span class="image featured"><img src="images/pic02.jpg" alt="" /></span>
								<h3>Lost & Find</h3>
								<p>Ajuda a les persones que han perdut les seves mascotes, si t'has trobat amb alguna mascota sense propietari accedeix aqui per ajudar-la.</p>
								<ul class="actions">
									<li><a href="#" class="button special">Entrar</a></li>
								</ul>
							</section>

						</div>
						<div class="6u 12u(narrower)">
							<section class="box special">
								<span class="image featured"><img src="images/pic03.jpg" alt="" /></span>
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

					<h2>Sign up for beta access</h2>
					<p>Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc.</p>

					<form>
						<div class="row uniform 50%">
							<div class="8u 12u(mobilep)">
								<input type="email" name="email" id="email" placeholder="Email Address" />
							</div>
							<div class="4u 12u(mobilep)">
								<input type="submit" value="Sign Up" class="fit" />
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