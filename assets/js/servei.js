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
			var panell_professionals = $("#panell-professionals");

			$.getJSON('Slim/api.php/profesionales/' + tipus,
		      function(datos) {
		        $.each(datos, function(i, dato){
		          panell_professionals.append('<div class="panel-heading"> <h3 id="titol" class="panel-title centrar-text"> ' + dato.nombre_SERVICIOS + '</h3> </div>');
		          panell_professionals.append('<div class="panel-body"> ' + '<strong>Ciutat:</strong><br> ' + dato.ciudad_SERVICIOS + ' <br><strong>Direcció:</strong><br>' + dato.direccion_SERVICIOS + ' <br><strong>Horari:</strong><br>' + dato.horario_SERVICIOS + ' <br><strong>Descripció:</strong><br>' + dato.descripcion_SERVICIOS + '<div class="izquierda"><button onclick="funcioCita(' + dato.id_SERVICIOS + ')" type="button" value=' + dato.id_SERVICIOS + ' data-toggle="modal" data-target="#modalCita" id="cita" name="cita" class="btn btn-primary">Solicitar Cita</button></div> </div>');
		        });
		    });

		return false;

});

function funcioCita(id){

	document.cookie = "idServei = " + id;

}

function hores(dia){

	 function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
    }

	//Peticio a hores perdudes per si hi ha alguna que esta ocupada i despres carregarles a les hores.
	var horari = $("#horari");

	$.get('Slim/api.php/horesDisponibles/' + getCookie('idServei') + '/' + dia,
		      function(datos) {
		        var arrayHores = datos.split(',');
		        horari.html('');
		        $.each(arrayHores, function(i, hora){
		        	if(hora == ""){
						horari.append('<option value="default" selected="selected">Hores disponibles</option>');
		        	}else{
		        		horari.append('<option value="' + hora +'">' + hora + '</option>');
		        	}
		        	
		        });
       		});
}

function enviarCita(){

	var formCita = $("#formCita");

      $.ajax({
      url: "Slim/api.php/insertarCita",
      type: "POST",
      data: formCita.serialize(),
      success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] != "1"){
                      alert(responseText);
                  }
          }
      });
    }