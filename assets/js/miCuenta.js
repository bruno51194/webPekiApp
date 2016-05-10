$( document ).ready(function() {
    
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
    function deleteCookie(cname) {
      document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    //SECCIONS
    var seccioPerfil = $("#perfil");
    var seccioAnimals = $("#animals");
    var seccioServeis = $("#serveis");
    var seccioAdopcions = $("#adopcions");
    var btn_perfil = $("#btn_perfil");
    var btn_animals = $("#btn_animals");
    var btn_serveis = $("#btn_serveis");
    var btn_adopcions = $("#btn_adopcions");

    function amagarSeccions(){
      seccioAnimals.hide();
      seccioPerfil.hide();
      seccioServeis.hide();
      seccioAdopcions.hide();
    }

    amagarSeccions();

    function mostrarSeccio(seccio){
      seccio.removeAttr("style");
    }

    btn_perfil.click(function(){
      amagarSeccions();
      mostrarSeccio(seccioPerfil);
    });
    btn_animals.click(function(){
      amagarSeccions();
      mostrarSeccio(seccioAnimals);
    });
    btn_serveis.click(function(){
      amagarSeccions();
      mostrarSeccio(seccioServeis);
    });
    btn_adopcions.click(function(){
      amagarSeccions();
      mostrarSeccio(seccioAdopcions);
    });


    //DADES PERSONALS
    $.getJSON('http://pekiapp.azurewebsites.net/Slim/api.php/usuariosToken/' + getCookie("id"),
      function(datos) {
        $.each(datos, function(i, camps){
          $("#nom_nou").attr("value", camps.nombre_USUARIOS);
          $("#cognom_nou").attr("value", camps.apellido_USUARIOS);
          $("#correu_nou").attr("value", camps.email_USUARIOSl);
          $("#poblacio_nou").attr("value", camps.poblacion_USUARIOS);
          $("#cp_nou").attr("value", camps.CP_USUARIOS);
          $("#telefon_nou").attr("value", camps.telefono_USUARIOS);
        });
    });

    //ANIMALS PERDUTS
    var taula_animals = $("#taula_animals");
    var forms = [];
 

    $.getJSON("Slim/api.php/animalesPerdidos/" + getCookie("id"), 
      function(datos){
        if (datos == ""){
            seccioAnimals.html('<h3>Els meus animals perduts</h3><div class="alert alert-success" role="alert">No tens animals perduts.</div>');
        }else{
          $.each(datos, function(i, campos){
            taula_animals.append('<tr><td><a id="eliminarAnimal_' + campos.ANIMALES_id_ANIMALES + '" href="miCuenta.php"><span class="glyphicon glyphicon-remove eliminar"></span></a></td><td><img src="' + campos.url_ANIMALES + '" alt="fotoAnimal"><td>' + campos.nombre_ANIMALES + "</td><td>" + campos.tipo_ANIMALES + "</td><td>" + campos.sexo_ANIMALES + '</td><td><form id="formAnimal' + campos.ANIMALES_id_ANIMALES + '" enctype="multipart/form-data"><input name="foto" type="file"><input name="prueba" type="text" value="asd"><button type="submit">Enviar</button></form></td></tr>');
            var form = $("#formAnimal" + campos.ANIMALES_id_ANIMALES);
            submitForms(form);
          });
        }

    });

    var taula_serveis = $("#taula_serveis");

    $.getJSON("Slim/api.php/cites/" + getCookie("id"), 
      function(datos){
        if (datos == ""){
            seccioAnimals.html('<h3>Solicituds</h3><div class="alert alert-success" role="alert">No tens cap solicitud de cita.</div>');
        }else{
          $.each(datos, function(i, campos){
            taula_serveis.append('<tr><td>' + campos.dia_CITAS + '</td><td>' + campos.hora_CITAS + '</td><td>' + campos.descripcion_CITAS  + '</td></tr>');
          });
        }

    });


    function submitForms(form){
        form.submit(function(){
          alert(form.serialize());
            $.ajax({
              url: "Slim/api.php/animales/actualizarFoto",
              //contentType: false,
              type: "POST",
              enctype: "multipart/form-data",
              //data: form.serialize(),
              data : new FormData( this ),
              processData: false,
              success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1"){
                    alert('correcte');
                  }
                  else if(responseTextarray[0] == "0"){
                    alert('incorrecte');
                  }
                  else if(responseTextarray[0] == "2"){
                    alert('arxiu malfet');
                  }
                  else{
                      alert(responseText);
                  }
              }
            });
            return false;
        });
    }

    //TANCAR SESSIÓ
    var btn_logout = $("#btn_logout");

    btn_logout.click(function(){
      deleteCookie("id");
      deleteCookie("email");
    });
});