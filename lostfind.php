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
    	//Marcador
    	var marker;
		//Animacio de la marca quan la cliquem
        var direcciones = [];
        $(document).ready(function() {
          $.getJSON('http://pekiapp.azurewebsites.net/Slim/api.php/direcciones',
              function(datos) {
                $.each(datos, function(i, field){
                    direcciones[i] = field.ciudad_PIERDE + "," + field.direccion_PIERDE;
                    $.each(direcciones, function(i, direccion){
                        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=' + direccion,
                        	function(resultado) {
                        		$.each(resultado.results, function(i, geometria){
                        			//localització marcador  
                                    var imgRoja = new google.maps.MarkerImage("images/googleMapsIcons/pets_rojo.png");                                 
                        			marker = new google.maps.Marker({
										position: {lat: geometria.geometry.location.lat, lng: geometria.geometry.location.lng},
										map: map,
										draggable: false,
										animation: google.maps.Animation.DROP,
                                        icon: imgRoja
									});
                        		});
                    	});
                    });                    
                });
            });            
        });


		var map;
		function initMap() {
			//Mapa
			map = new google.maps.Map(document.getElementById('map'), {
		    	center: {lat: 41.5231301, lng: 2.4042101},
			    zoom: 12
			});
		}
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhzbq-PRPtTR-tkVSAKZmsTM-wYAm-vBY&callback=initMap">
    </script>

    <div class="container">
        <div class="marge-dalt marge-abaixPlus centrar-text">
            <button class="btn btn-afegir" id="afegir-animal-perdut">AFEGIR ANIMAL PERDUT</button>
        </div>
            <div class="col-md-9 col-md-offset-3">
            <h2 class="centrar-text">Animal Perdut</h2>
            <div class="linea"></div>
                <h4>Informació de l'animal</h4> 
                <form class="form-horizontal" id="form-animalPerdut" name="form-animalPerdut">
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Nom:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="nom" name="nom" placeholder="Nom de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Chip:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="chip" name="chip" placeholder="Chip de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Tipo:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <select class="form-control" id="tipos" name="tipos">
                                <option value="perro">Gat</option>
                                <option value="gato">Gos</option>
                                <option value="especial">Altres</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Sexe:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <select class="form-control" id="sexe" name="sexe">
                                <option>Mascle</option>
                                <option>Famella</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Tamany:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="tamany" name="tamany" placeholder="Mides aproximades de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Raça:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="raça" name="raça" placeholder="Raça de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Edat:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="edat" name="edat" placeholder="Edat de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Color:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="color" name="color" placeholder="Color de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Vacunes:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="vacunes" name="vacunes" placeholder="Introdueix les vacunes de l'animal" type="text">
                        </div>
                    </div>
	                <h4>Informació sobre l'última localització de l'animal</h4>
	                <div class="form-group">
	                    <label class="col-sm-1 control-label">Ciutat:</label>
	                    <div class="col-sm-4 col-sm-offset-1">
	                        <input class="form-control" id="ciutat" name="ciutat" placeholder="Última ciutat on s'ha vist l'animal" type="text">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-sm-1 control-label">Direcció:</label>
	                    <div class="col-sm-4 col-sm-offset-1">
	                        <input class="form-control" id="direccio" name="direccio" placeholder="Última direcció on s'ha vist l'animal" type="text">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-sm-1 control-label">Recompensa:</label>
	                    <div class="col-sm-4 col-sm-offset-1">
	                        <input class="form-control" id="recompensa" name="recompensa" placeholder="Afegir una recompensa és opcional" type="text">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-sm-1 control-label">Descripció:</label>
	                    <div class="col-sm-4 col-sm-offset-1">
	                        <textarea class="form-control" id="descripcio" name="descripcio" placeholder="Afegeix una descripció de com es l'animal" rows="5"></textarea>
	                    </div>
	                </div>
	            <div class="form-group">
	                <div class="col-md-1 centrar-text marge-abaix">
	                    <button class="btn btn-default" id="enviar-animal" type="submit">Afegir Animal</button>
	                </div>
	            </div>
        	</form>
        </div>
        <div class="col-md-12">
            <div class="marge-abaix centrar-text">
	            <button class="btn btn-afegir" id="afegir-animal-trobat">AFEGIR ANIMAL TROBAT</button>
	        </div>
	    </div>
        </div>
    </div>

    <footer id="footer">
    	<script type="text/javascript">
    	var div_afegir = $("#div-afegir");
    	var div_afegir2 = $("#div-afegir2");
    	var form = $("#form-animalPerdut");
    	var form2 = $("#form-animalPerdut");
    	var obert = false;
    	var obert2 = false;

    	$("#afegir-animal-perdut").click(function(){
    		if(obert){
				div_afegir.attr('style', 'display:none');
				obert = false;
    		}else{
    			div_afegir.removeAttr('style');
    			obert = true;
    		}	
    	});

    	$("#afegir-animal-trobat").click(function(){
    		if(obert){
				div_afegir.attr('style', 'display:none');
				obert = false;
    		}else{
    			div_afegir.removeAttr('style');
    			obert = true;
    		}	
    	});
    	
    	
    	$("#enviar-animal").click(function(){
    		$.ajax({
		      url: "Slim/api.php/insertarAnimalPerdut",
		      type: "POST",
		      data: form.serialize(),
		      success: function(responseText){
		                  var responseTextarray = responseText.split(" ");

		                  if(responseTextarray[0] == "1"){
		                    
		                  }
		                  else if(responseTextarray[0] == "0"){
		                  	
		                  }
		                  else{
		                      alert(responseText);
		                  }
		          }
		    });
		  	return false;

    		
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