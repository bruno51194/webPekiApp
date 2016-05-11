$(document).ready(function() {
	var afegirAnimal = $("#afegir-animal-adopta");
	var div_afegir = $("#div-afegir");
	var obert = false;
	var formulari = $("#form-animalAdopta");
	var divAnimals = $("#div_animals")

    afegirAnimal.click(function(){
        if(obert){
            div_afegir.attr('style', 'display:none');
            obert = false;
        }else{
            div_afegir.removeAttr('style');
            obert = true;
        }   
    });

    formulari.submit(function(){
      var formData = new FormData(formulari.get(0));
        $.ajax({
          url: "Slim/api.php/insertarAnimalAdopcio",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(responseText){
                  var responseTextarray = responseText.split(" ");

                  if(responseTextarray[0] == "1" && responseTextarray[1] == "1"){
                    div_afegir.hide();
                    formulari.trigger("reset");
                  }
                  else if(responseTextarray[0] == "0" || responseTextarray[1] == "0"){
                    div_afegir.append('<div class="alert alert-danger">Error al registrar l\'animal, refresca i torna a probar. Si el problema persisteix <a href="contacte.php">contacta</a></div>');
                  }
                  else{
                      alert(responseText);
                  }
          }
        });
        return false;        
    });

});