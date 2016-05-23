$(document).ready(function() {
	var btn_animalTrobat = $("#btn_animal_trobat");
	var btn_adoptarAnimal = $("#btn_animal_adoptar");

	function getGET(variable)
	{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
	}


	btn_animalTrobat.click(function(){
		var bool = true;
		if (bool) {
		$("#result_vist").html('<div class="alert alert-success">S\'ha enviat un correu a l\'anunciant amb les teves dades perquè pogueu contactar</div>').fadeIn();
    	setTimeout(function() {
          window.location.href= "lostfind.php";
        }, 4000); 
    	bool = false;
		}

	});

	btn_adoptarAnimal.click(function(){
		var bool = true;
		if (bool) {
		$.ajax({
			url: "Slim/api.php/animales/adoptar",
			type: "POST",
			data: $("#form_adoptar").serialize(),
			success: function(responseText){
				responseTextArray = responseText.split(' ');
				if(responseTextArray[0] == "1" && responseTextArray[1] == "1"){
					$("#result_adopta").html('<div class="alert alert-success">S\'ha notificat a la protectora de la teva petició</div>').fadeIn();
			    	setTimeout(function() {
			          window.location.href= "adopta.php";
			        }, 4000); 
				}else{
					alert(responseText);
				}
			}
		});
		bool = false;
		return false;
		}
	});
});