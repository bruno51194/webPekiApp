<html>
<head>
	<title>Pekiapp | Registre</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/forms.css">
</head>
<body>
	<div class="text-center" style="padding:50px 0">
		<div class="logo">Registre</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form id="register-form" class="text-left">
				<div class="login-form-main-message"></div>
				<div class="main-login-form">
					<div class="login-group">
						<div class="form-group">
							<label for="reg_email" class="sr-only">Email</label>
							<input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="reg_password" class="sr-only">Contrasenya</label>
							<input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="Contrasenya">
						</div>
						<div class="form-group">
							<label for="reg_password_confirm" class="sr-only">Confirmar contrasenya</label>
							<input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="Confirmar contrasenya">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Nom</label>
							<input type="text" class="form-control" id="reg_name" name="reg_name" placeholder="Nom">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Cognoms</label>
							<input type="text" class="form-control" id="reg_surname" name="reg_surname" placeholder="Cognoms">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Codi Postal</label>
							<input type="text" class="form-control" id="reg_cp" name="reg_cp" placeholder="Codi Postal">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Població</label>
							<input type="text" class="form-control" id="reg_pob" name="reg_pob" placeholder="Població">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Adreça</label>
							<input type="text" class="form-control" id="reg_addr" name="reg_addr" placeholder="Adreça">
						</div>
						<div class="form-group">
							<label for="reg_fullname" class="sr-only">Telèfon</label>
							<input type="text" class="form-control" id="reg_telf" name="reg_tel" placeholder="Telèfon">
						</div>
						<div class="form-group">
							<label>Compte:</label><br>
	                        <select class="select-style" id="tipo" name="tipo">
	                            <option value="normal">Personal</option>
	                            <option value="empresa">Professional</option>
	                            <option value="protectora">Protectora</option>
	                        </select>
	                    </div>				
						<div class="form-group login-group-checkbox">
							<input type="checkbox" class="" id="reg_agree" name="reg_agree">
							<label for="reg_agree">Estic d'acord amb els <a href="termes.php" target="_blank">termes i condicions</a>.</label>
						</div>

					</div>
					<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
				</div>
				<div class="etc-login-form">
					<p>Ja tens un compte? <a href="#">entra aquí</a></p>
				</div>
			</form>
		</div>
		<!-- end:Main Form -->
		<script src="assets/js/forms.js"></script>
	</div>
</body>
</html>