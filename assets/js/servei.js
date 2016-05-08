$(document).ready(function() {

			function getGET(){
				//funcio encarregada dagafar valors de la url
			   var loc = document.location.href;
			   var getString = loc.split('?')[1];
			   var GET = getString.split('&');
			   var get = {};

			   for(var i = 0, l = GET.length; i < l; i++){
			      var tmp = GET[i].split('=');
			      get[tmp[0]] = unescape(decodeURI(tmp[1]));
			   }
			   return get;
			}

			var get = getGET();

			var tipus = get.tipos;


			$.getJSON('Slim/api.php/profesionales/' + tipus,
		      function(datos) {
		      	$.each(datos, function(i, dato){
		      		alert(dato.id_SERVICIOS);
		      	});
		        
		    });

		return false;
});