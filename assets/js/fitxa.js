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
		$.ajax({
			url: "Slim/api.php/animales/animalesPerdidos/email/" + btn_animalTrobat.val(),
			type: "GET",
			succes: function(responseText){
				if(responseText == "1"){
					alert('enviat');
				}else{
					alert(responseText);
				}
			}
		});
		return false;
	});

	btn_adoptarAnimal.click(function(){
		$.ajax({
			url: "Slim/api.php/animales/adoptar",
			type: "POST",
			data: $("#form_adoptar").serialize(),
			success: function(responseText){
				responseTextArray = responseText.split(' ');
				if(responseTextArray[0] == "1" && responseTextArray[1] == "1"){
					window.location.href= "adopta.php";
				}else{
					alert(responseText);
				}
			}
		});
		return false;
	})
});