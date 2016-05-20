$(document).ready(function() {      

        //GOOGLE MAPS I TAULA ANIMALS
        var taula_animals = $("#taula_animals");

        $.getJSON('http://pekiapp.azurewebsites.net/Slim/api.php/animalesPerdidos',
              function(datos) {
                
                $.each(datos, function(i, campos){
                    direccion = campos.ciudad_PIERDE + "," + campos.direccion_PIERDE;
                    if (datos == ""){
                        taula_animals.html('<h3>Els meus animals perduts</h3><div class="alert alert-warning" role="alert">No hi ha animals perduts.</div>');
                    }else{
                        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=' + direccion,
                            function(resultado) {
                                $.each(resultado.results, function(i, geometria){
                                    //localització marcador  
                                    var imgRoja = new google.maps.MarkerImage("images/googleMapsIcons/pets_rojo.png");                                 
                                    var marker = new google.maps.Marker({
                                        position: {lat: geometria.geometry.location.lat, lng: geometria.geometry.location.lng},
                                        map: map,
                                        draggable: false,
                                        animation: google.maps.Animation.DROP,
                                        icon: imgRoja
                                    });
                                    var infowindow = new google.maps.InfoWindow();
                                    makeInfoWindowEvent(infowindow, marker, campos.nombre_ANIMALES, campos.url_ANIMALES, campos.id_ANIMALES, campos.sexo_ANIMALES);


                              });
                        });
                        var tipo = (campos.tipo_ANIMALES == "perro" ? "Gos" : (campos.tipo_ANIMALES == "gato" ? "Gat" : "Altres"));
                        var tamany = (campos.medida_ANIMALES[0] == 'g' ? "Gran" : (campos.medida_ANIMALES[0] == 'm' ? "Mitjà" : "Petit"));
                        taula_animals.append("<tr><td>" + '<img src="' + campos.url_ANIMALES + '" alt="fotoanimal">' +"</td><td>" + campos.nombre_ANIMALES + "</td><td>" + tipo + "</td><td>" + campos.sexo_ANIMALES + "</td><td>" + tamany + "</td><td>" + campos.raza_ANIMALES + "</td><td>" + campos.edad_ANIMALES + "</td><td>" + campos.color_ANIMALES + "</td><td>" + campos.vacunes_ANIMALES + "</td><td><a href='fitxa.php?animal=" + campos.id_ANIMALES + "' class='btn btn-info'>Més info</a></tr>");

                    }
                                   
                });
            });

        function makeInfoWindowEvent(infowindow, marker, nombre, url, id, sexe) {
            google.maps.event.addListener(marker, 'click', function() {
               infowindow.setContent('<div style="font-size: 8pt; font-family: verdana"><img src="' + url + '" alt="foto"><br>' + nombre + '<br>' + sexe + '<br><a class="btn btn-info" href="fitxa.php?animal=' + id + '">Fitxa</a>');
               infowindow.open(map,marker);
            });
        }            


        //AFEGIR ANIMALS

        var div_afegir = $("#div-afegir");
        var div_afegir2 = $("#div-afegir2");
        var form = $("#form-animalPerdut");
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
            if(obert2){
                div_afegir2.attr('style', 'display:none');
                obert2 = false;
            }else{
                div_afegir2.removeAttr('style');
                obert2 = true;
            }   

        });
        
        

        form.submit(function(){
            var formData = new FormData(form.get(0));
            $.ajax({
              url: "Slim/api.php/insertarAnimalPerdut",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              success: function(responseText){
                          var responseTextarray = responseText.split(" ");

                          if(responseTextarray[0] == "1" && responseTextarray[1] == "1"){
                            $("#alert-error").remove();
                            form.trigger("reset");
                            div_afegir.append('<div class="alert alert-success">Animal registrat correctament!</div>');
                            setTimeout(function() {
                              location.reload();
                            }, 2000);                          
                          }else{
                            $("#alert-error").remove();
                            div_afegir.append('<div class="alert alert-danger" id="alert-error">Error al registrar l\'animal, refresca i torna a probar. Si el problema persisteix <a href="contacte.php">contacta</a></div>');
                          }
                  }
            });
            return false;

            
        });

});