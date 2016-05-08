// Form Submission
  var servei = $("#form-solicitudServei");
  servei.submit(function() {

      $.ajax({
      url: "Slim/api.php/afegirServei",
      type: "POST",
      data: servei.serialize(),
      success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1"){
                    window.location.href = "index.php";
                  }else{
                    alert(responseTextarray[0]);
                    alert('Opss! Ha ocurrido algun problema.');
                  }
          }
      });
      return false;
  });