$(document).ready(function() {
	var btn_animalTrobat = $("#btn_animal_trobat");
	var btn_adoptarAnimal = $("#btn_adoptar_animal");

	btn_animalTrobat.click(function(){
		$.ajax({
			url: "Slim/api.php/animales/animalesPerdidos/email/" + btn_animalTrobat.val(),
			type: "GET",
			succes: function(responseText){
				if(responseText == 1){
					alert('enviat');
				}else{
					alert('error');
				}
			}
		});
		return false;
	});
});