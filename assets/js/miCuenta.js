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
});