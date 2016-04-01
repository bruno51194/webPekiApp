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
		?>
		<link rel="stylesheet" href="assets/css/custom.css" />
  </head>
  <body>

<!-- Head -->
  	<header id="header">
		<?php include 'topmenu.php'; ?>
	</header>

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
        <button class="btn button">AFEGIR ANIMAL PERDUT</button>
      </div>
    </div>

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
  </body>
</html>