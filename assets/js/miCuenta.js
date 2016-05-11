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
    var seccioContrasenya = $("#contrasenya");
    var seccioAnimals = $("#animals");
    var seccioServeis = $("#serveis");
    var seccioAdopcions = $("#adopcions");
    var btn_perfil = $("#btn_perfil");
    var btn_contrasenya = $("#btn_contrasenya");
    var btn_animals = $("#btn_animals");
    var btn_serveis = $("#btn_serveis");
    var btn_adopcions = $("#btn_adopcions");

    function amagarSeccions(){
      seccioAnimals.hide();
      seccioContrasenya.hide();
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
    btn_contrasenya.click(function(){
      amagarSeccions();
      mostrarSeccio(seccioContrasenya);
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
    function DadesPerfil(){
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
    }


    $("#btn_actualitzarPerfil").click(function(){
      $.ajax({
        url: "Slim/api.php/usuarios/actualizar/" + getCookie("id"),
        type: "POST",
        data: $("#formPerfil").serialize(),
        success: function(response){
          if(response == "1"){
            location.reload();
          }else{
            alert(response);
          }
        }
      });
    });

    //ANIMALS PERDUTS
    var taula_animals = $("#taula_animals");
    var forms = [];
 
    function AnimalesPerdidos(){
      $.getJSON("Slim/api.php/animalesPerdidos/" + getCookie("id"), 
        function(datos){
          if (datos == ""){
              seccioAnimals.html('<h3>Els meus animals perduts</h3><div class="alert alert-success" role="alert">No tens animals perduts.</div>');
          }else{
            $.each(datos, function(i, campos){
              taula_animals.append('<tr><td><form id="formAnimal_' + campos.ANIMALES_id_ANIMALES + '"><input name="id_animal" id="id_animal" type="hidden" value="' + campos.ANIMALES_id_ANIMALES + '"><button type="submit" class="btn btn-link eliminar"><span class="glyphicon glyphicon-remove"></span></button></form></td><td><img src="' + campos.url_ANIMALES + '" alt="fotoAnimal"><td>' + campos.nombre_ANIMALES + "</td><td>" + campos.tipo_ANIMALES + "</td><td>" + campos.sexo_ANIMALES + '</td></tr>');
              var form = $("#formAnimal_" + campos.ANIMALES_id_ANIMALES);
              submitForms(form);
            });
          }

      });
    }


    var div_serveis = $("#div_serveis");
    function CitasServicios(){    
        $.getJSON("Slim/api.php/serveisUsuari/" + getCookie("id"), 
            function(datos){
              $.each(datos, function(i, servicio){
              div_serveis.append('<h3>' + servicio.tipus_SERVICIOS + '</h3><strong><h4>' + servicio.nombre_SERVICIOS + '</h4></strong>');
              div_serveis.append('<table class="table table-striped" id="taula_serveis_' + servicio.id_SERVICIOS + '"><tr><th><strong>Dia</strong></th><th><strong>Hora</strong></th><th><strong>Descripció</strong></th></tr></table>')
              var taula_serveis = $("#taula_serveis_" + servicio.id_SERVICIOS);
              $.getJSON("Slim/api.php/citesServei/" + servicio.id_SERVICIOS, function(cites){
                $.each(cites, function(i, cita){
                  taula_serveis.append('<tr><td>' + cita.dia_CITAS + '</td><td>' + cita.hora_CITAS + '</td><td>' + cita.descripcion_CITAS  + '</td></tr>');
                });
              });
            });
         });
    }





    function submitForms(form){
        form.submit(function(){
            $.ajax({
              url: "Slim/api.php/animales/eliminar",
              type: "POST",
              data: form.serialize(),
              success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1"){
                    location.reload();
                  }else{
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


    //CONTROL DE USUARI
    switch(getCookie("tipo")) {
        case "normal":
            DadesPerfil();
            AnimalesPerdidos();
            break;
        case "empresa":
            DadesPerfil();
            CitasServicios();
            break;
        case "protectora":
            DadesPerfil();

            break;
    } 
});