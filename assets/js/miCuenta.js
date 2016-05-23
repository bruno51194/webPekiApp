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
    var seccioCites = $("#cites");
    var btn_perfil = $("#btn_perfil");
    var btn_contrasenya = $("#btn_contrasenya");
    var btn_animals = $("#btn_animals");
    var btn_serveis = $("#btn_serveis");
    var btn_adopcions = $("#btn_adopcions");
    var btn_cites = $("#btn_cites");

    function amagarSeccions(){
      seccioAnimals.hide();
      seccioContrasenya.hide();
      seccioPerfil.hide();
      seccioServeis.hide();
      seccioAdopcions.hide();
      seccioCites.hide();
      $("#error").remove();
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
    btn_cites.click(function(){
      amagarSeccions();
      mostrarSeccio(seccioCites);
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
            $("#formPerfil").append('<div class="alert alert-success">Dades actualitzades correctament!</div>').fadeIn();
            setTimeout(function() {
              location.reload();
            }, 2000); 
          }else if(response == "2"){
            $("error").remove();
            $("#formPerfil").append('<div class="alert alert-danger" id="error">Error en l\'actualització de perfil. Hi ha camps sense completar</div>').fadeIn();

          }else{
            $("error").remove();
            $("#formPerfil").append('<div class="alert alert-danger" id="error">Error en l\'actualització de perfil. Comprova que els tipus de dades siguin correctes</div>').fadeIn();
          }
        }
      });
    });

    $("#btn_actualitzarContrasenya").click(function(){
      $.ajax({
        url: "Slim/api.php/usuarios/actualizarContrasenya",
        type: "POST",
        data: $("#formContrasenya").serialize(),
        success: function(response){
          if(response == "1"){
            $("#div-error").html('<div class="alert alert-success">Dades actualitzades correctament!</div>').fadeIn();
            setTimeout(function() {
              location.reload();
            }, 2000); 
          }else if(response == "2"){

            $("#div-error").html('<div class="alert alert-danger" id="error">Error en l\'actualització de contrasenya. La contrasenya no pot tenir menys de 5 caràcters</div>').fadeIn();
          }else{

            $("#div-error").html('<div class="alert alert-danger" id="error">Error en l\'actualització de contrasenya. Comprova que els tipus de dades siguin correctes</div>').fadeIn();
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

    var div_cites = $("#cites");

    function citesAceptades(){
        $.getJSON("Slim/api.php/citesAceptades/" + getCookie("id"), 
        function(datos){
          if (datos == ""){
              seccioAnimals.html('<h3>Les meves cites sol·licitades</h3><div class="alert alert-success" role="alert">No tens cap cita acceptada.</div>');
          }else{
            $.each(datos, function(i, campos){
              div_cites.append('<div class="panel panel-default"> <div class="panel-body"> <div class="col-md-3"><strong>Dia:</strong> ' + campos.dia_CITAS + "</div><div class='col-md-2'><strong>Hora:</strong> " + ' ' + campos.hora_CITAS + "</div><div class='col-md-6'><strong>Servei:</strong> " +' ' + campos.nombre_SERVICIOS  + '</div>'+ (campos.estado_CITAS == 'aceptada' ? "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>" : "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>") + '</div></div>');
            });
          }

      });
    }


   var div_serveis = $("#div_serveis");
    function CitasServicios(){    
        $.getJSON("Slim/api.php/serveisUsuari/" + getCookie("id"), 
            function(datos){
              $.each(datos, function(i, servicio){
              div_serveis.append('<h3>' + servicio.tipus_SERVICIOS + '</h3><strong><h4>' + servicio.nombre_SERVICIOS + '</h4></strong>' + '<a href="calendari.php?idServei=' + servicio.id_SERVICIOS + '" class="btn btn-primary marge-abaixPlus"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> &nbsp; CALENDARI</a>');
              div_serveis.append('<table class="table table-striped" id="taula_serveis_' + servicio.id_SERVICIOS + '"><tr><th><strong>Dia</strong></th><th><strong>Hora</strong></th><th><strong>Descripció</strong></th><th></th><th></th></tr></table>');
              var taula_serveis = $("#taula_serveis_" + servicio.id_SERVICIOS);
              $.getJSON("Slim/api.php/citesServei/" + servicio.id_SERVICIOS, function(cites){ 
                if (cites != "")
                $.each(cites, function(i, cita){
                  taula_serveis.append('<tr><td>' + cita.dia_CITAS + '</td><td>' + cita.hora_CITAS + '</td><td>' + cita.descripcion_CITAS  + '</td><td><button class="btn btn-info" data-toggle="modal" href="#modal_contacte" id="btn_modal_' + cita.id_USUARIOS + '">INFO</button></td><td>' + '<button class="btn btn-success" id="' + servicio.id_SERVICIOS + i + '">ACCEPTAR</button><button class="btn btn-danger" id="' + servicio.id_SERVICIOS + cita.id_CITAS +  '">CANCELAR</button></td></tr>' );
                  $("#btn_modal_" + cita.id_USUARIOS).click(function(){OmplirDadesModal(cita.telefono_USUARIOS, cita.email_USUARIOSl, cita.poblacion_USUARIOS, cita.CP_USUARIOS)});
                  horaReservada($("#" + servicio.id_SERVICIOS + i), servicio.id_SERVICIOS, cita.dia_CITAS, cita.hora_CITAS, cita.id_CITAS, cita.fk_usuario_CITAS);
                  horaCancelada($("#" + servicio.id_SERVICIOS + cita.id_CITAS), cita.id_CITAS);
                });
                else
                  taula_serveis.html('<div class="alert alert-warning">No tens sol·licituds per aquest servei</div>');
              });
            });
         });
    }

    var div_adopcions = $("#div_adopcions");
    function SolicitudsAdopcio(){
      $.getJSON("Slim/api.php/protectora/solicitudesAnimales/" + getCookie("id"),
        function(datos){
          if (datos!="")
          $.each(datos, function(i, solicitud){
            div_adopcions.append('<div class="solicitud"><div class="panel-heading"><table class="no-margin"><tr><td><img src="' + solicitud.url_ANIMALES + '" alt="foto"></td><td><b>Nom:</b> <a href="fitxa.php?animal=' + solicitud.id_ANIMALES + '" target="_blank">' + solicitud.nombre_ANIMALES +'</a></td><td><b>Solicitant:</b> ' + solicitud.nombre_USUARIOS +'</td><td><button class="btn btn-info"  data-toggle="modal" href="#modal_contacte" id="btn_modal_' + solicitud.id_USUARIOS + '">DADES</button></td><td class="alinear-dreta"><button class="btn btn-success" id="acceptar_' + solicitud.id_ANIMALES + '">ACCEPTAR</button>&nbsp;<button class="btn btn-danger" id="cancelar_' + solicitud.id_ANIMALES + '">CANCELAR</button></td></tr></table></div></div>');
            $("#btn_modal_" + solicitud.id_USUARIOS).click(function(){OmplirDadesModal(solicitud.telefono_USUARIOS, solicitud.email_USUARIOSl, solicitud.poblacion_USUARIOS, solicitud.CP_USUARIOS)});
            AcceptarAdopcio($("#acceptar_" + solicitud.id_ANIMALES), solicitud.token_USUARIOS, solicitud.id_ANIMALES);
            CancelarAdopcio($("#cancelar_" + solicitud.id_ANIMALES), solicitud.token_USUARIOS, solicitud.id_ANIMALES);
          });
        else
           div_adopcions.append('<div class="alert alert-warning">No tens sol·licituds</div>');
        });
    }

    function horaReservada(boton,idServei,dia,hora,idCita,idUsuario){

      var notificacioOK = $("#notificacioOK");

      boton.click(function(){
          $.ajax({
              url: "Slim/api.php/serveis/solicitudes/aceptar",
              type: "POST",
              data: {
                idServei: idServei,
                dia: dia,
                hora: hora,
                idCita: idCita,
                idUsuario: idUsuario 
              },
              success: function(responseText){
                  var responseTextarray = responseText.split(" ");
                  if(responseTextarray[0] == "111"){
                    location.reload();          
                  }else{
                    alert(responseText);
                  }
              }
            });
      });
    }

    function horaCancelada(boton,idCita){

      boton.click(function(){
          $.ajax({
              url: "Slim/api.php/serveis/solicitudes/cancelar",
              type: "POST",
              data: {
                idCita: idCita
              },
              success: function(responseText){
                  var responseTextarray = responseText.split(" ");
                  if(responseTextarray[0] == "1"){
                     location.reload(); 
                  }else{
                    alert(responseText);
                  }
              }
            });
      });
    }

    var lbl_telefon = $("#lbl_telf");
    var lbl_email = $("#lbl_email"); 
    var lbl_ciutat = $("#lbl_ciutat");
    var lbl_cp = $("#lbl_cp");

    function OmplirDadesModal(telf, email, ciutat, cp){
      lbl_telefon.html(telf);
      lbl_email.html(email);
      lbl_ciutat.html(ciutat);
      lbl_cp.html(cp);
    }

    function CancelarAdopcio(boton, usuario, animal){
      boton.click(function(){     
            $.ajax({
              url: "Slim/api.php/protectora/solicitudes/cancelar",
              type: "POST",
              data: {
                token_usuario: usuario,
                id_animal: animal
              },
              success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "11"){
                    location.reload();
                  }else{
                      alert(responseText);
                  }
              }
            });
      });
    }
    function AcceptarAdopcio(boton, usuario, animal){
      boton.click(function(){
            $.ajax({
              url: "Slim/api.php/protectora/solicitudes/aceptar",
              type: "POST",
              data: {
                token_usuario: usuario,
                id_animal: animal
              },
              success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1"){
                    location.reload();
                  }else{
                      alert(responseText);
                  }
              }
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
      deleteCookie("tipo");
    });


    //CONTROL DE USUARI
    switch(getCookie("tipo")) {
        case "normal":
            DadesPerfil();
            AnimalesPerdidos();
            citesAceptades();
            break;
        case "empresa":
            DadesPerfil();
            CitasServicios();
            break;
        case "protectora":
            DadesPerfil();
            SolicitudsAdopcio();
            break;
    } 
});