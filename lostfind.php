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

  <!-- Google Maps -->
	<?php  
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?address=cabrils");    
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$data = json_decode(curl_exec($ch),true);  
		
		//print_r($data);
		$latitud = $data['results'][0]['geometry']['location']['lat'];
		$longitud = $data['results'][0]['geometry']['location']['lng'];

		
		curl_close($ch);

	 ?>  

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
      	<form>
      		<div class="form-controls">
      			<label>Nom <span class="obligatori">*</span></label>
      			<input type="text" name="" required>
      		</div>
      		<div class="form-controls">
      			<label>Chip</label>
      			<input type="text" name="">
      		</div>
      		<div class="form-controls">
      			<label>Tipus <span class="obligatori">*</span></label>
      			<select name="example">
				    <option value="A">A</option>
				    <option value="B">A</option>
				    <option value="-">Other</option>
				</select>
      		</div>
      		<div class="form-controls">
      			<label>Estat <span class="obligatori">*</span></label>
  				<select name="example">
				    <option value="A">A</option>
				    <option value="B">A</option>
				    <option value="-">Other</option>
				</select>
      		</div>
      		<div class="form-controls">
      			<button id="enviar-animal" type="submit">Enviar</button>
      		</div>
      	</form>
      </div>
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