<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
	      html, body { height: 100%; margin: 0; padding: 0; }
	    </style>
	    <?php 
			$titol = "Lost&Find";
			$actiu = 2;
			include 'head.php';
			include '_functions/functions.php';
		?>
		<link rel="stylesheet" href="assets/css/custom.css" />
  </head>
  <body>

<!-- Head -->
  	<header id="header">
		<?php include 'topmenu.php';?>	 
	</header>

	<?php  
	//obtener latidud a traves de una direccion
	function latitud($direccio){
		
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?address=" . $direccio);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$data = json_decode(curl_exec($ch),true);  
		
		//print_r($data);
		$latitud = $data['results'][0]['geometry']['location']['lat'];
		//$longitud = $data['results'][0]['geometry']['location']['lng'];
		
		curl_close($ch);
		return $latitud;
	}
	//obtener longitud a traves de una direccion
	function longitud($direccio){
		
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?address=" . $direccio);    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$data = json_decode(curl_exec($ch),true);  
		
		//print_r($data);
		//$latitud = $data['results'][0]['geometry']['location']['lat'];
		$longitud = $data['results'][0]['geometry']['location']['lng'];
		return $longitud;

		curl_close($ch);
	}

	$idUsuari = $_COOKIE['id'];

	?>  

	<!-- Google Maps -->
  	<div id="map"></div>
    <script type="text/javascript">

		var map;
		function initMap() {

		//Mapa
		map = new google.maps.Map(document.getElementById('map'), {
	    	center: {lat: 41.5259339, lng: 2.3632897},
		    zoom: 14
		});

		//Localitzacio de la marca
		var localizacion = {lat: 41.5259339, lng: 2.3632897};

		//Marcador
		var marker = new google.maps.Marker({
			position: localizacion,
			map: map,
			draggable: true,
			animation: google.maps.Animation.DROP,
			title: 'Cabrils'
		});
		//Listener quan es clica el marcador
	  	marker.addListener('click', toggleBounce);

		//Animacio de la marca quan la cliquem
		function toggleBounce() {
			if (marker.getAnimation() !== null) {
			    marker.setAnimation(null);
			} else {
			    marker.setAnimation(google.maps.Animation.BOUNCE);
			}
		}
	}
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhzbq-PRPtTR-tkVSAKZmsTM-wYAm-vBY&callback=initMap">
    </script>

    <div class="container">		    
      <div class="marge-dalt marge-abaix centrar-text">
        <button class="btn btn-afegir" id="afegir-animal">AFEGIR ANIMAL PERDUT</button>
      </div>
      <div id="div-afegir" class="col-md-4 center-text" style="display: none">
      <strong></strong><h4>Informació de l'animal</h4></strong>
      	<form class="form-horizontal" id="form-animalPerdut">
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Nom:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="nom" placeholder="Nom de l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Chip:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="chip" placeholder="Chip de l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Tipo:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      	<select class="form-control" id="tipos">
					<option>gat</option>
				    <option>gos</option>
				    <option>Altres</option>
				</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Sexe:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      	<select class="form-control" id="sexe">
					<option>Mascle</option>
				    <option>Famella</option>
				</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Tamany:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="tamany" placeholder="Mides aproximades de l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Raça:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="raça" placeholder="Raça de l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Edat:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="edat" placeholder="Edat de l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Color:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="color" placeholder="Color de l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Vacunes:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="vacunes" placeholder="Introdueix les vacunes de l'animal">
		    </div>
		  </div>
		  <strong><h4>Informació sobre l'última localització de l'animal</h4></strong>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Ciutat:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="ciutat" placeholder="Última ciutat on s'ha vist l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Direcció:</label>
		    <div class="col-sm-10 col-sm-offset-1">
		      <input type="text" class="form-control" id="direccio" placeholder="Última direcció on s'ha vist l'animal">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-1 control-label">Recompensa:</label>
		    <div class="col-sm-9 col-sm-offset-2">
		      <input type="text" class="form-control" id="recompensa" placeholder="Afegir una recompensa és opcional">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Descripció:</label>
		    <div class="col-sm-12">
		      <textarea class="form-control" rows="5" id="descripcio" placeholder="Afegeix una descripció de com es l'animal"></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-10">
		      <button type="submit" class="btn btn-default">Afegir</button>
		    </div>
		  </div>
		</form>
      </div>
      <!-- end:Main Form -->
	<script src="assets/js/forms.js"></script>
    </div>

    <footer id="footer">
    <script type="text/javascript">
    	var div_afegir = $("#div-afegir");
    	$("#afegir-animal").click(function(){
    		div_afegir.removeAttr('style');
    	});
    	$("#enviar-animal").click(function(){
    		div_afegir.attr('style', 'display:none');
    	})
	</script>
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
  </body>
</html>