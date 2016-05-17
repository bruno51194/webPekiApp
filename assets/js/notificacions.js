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
    function is_int(n){
	    return (Number(n)) && (n % 1 === 0);
	}



    switch(getCookie("tipo")) {
        case "normal":
            
            break;
        case "empresa":
            peticio("citas");
            break;
        case "protectora":
            peticio("adopcions");
            break;
    } 

    function peticio(funcio){
		$.ajax({
			url: "Slim/api.php/notificacions/" + funcio + "/" + getCookie('id'),
			type: "GET",
			success: function(response){
				var responseArray = response.split(' ');
				if(is_int(responseArray[0]) && responseArray[0] > 0)
					$("#notificacions").html(responseArray[0]);

			}
		});
    }

});