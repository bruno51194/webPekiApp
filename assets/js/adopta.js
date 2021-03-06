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
                  $("#alert-error").remove();
                  formulari.trigger("reset");
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

    var resetFiltre = $("#netejar_filtre");

    resetFiltre.click(function(){
      $('input[name=especie]').attr('checked',false);
      $('input[name=tamany]').attr('checked',false);
      $('input[name=sexe]').attr('checked',false);
    });

});