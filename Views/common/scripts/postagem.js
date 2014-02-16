var postagem = null;

var Postagem = function(){
	var that = this;

	var _constructor = function(){
		var parameters = {"controller":"Postagem","method":"loadPosts","tipoPostagem":core.getUrlVar("tipoPostagem")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,loadPosts);
	}

	var loadPosts = function(data){
            if (data.charAt(0)=="<"){
                    $("#geral").remove();
                    $("body").append(data);
                }
		var convertedData = core.convertToJSON(data);
		var output = Mustache.render($("#template").html(),convertedData);
		$("#main").append(output);
	}
	_constructor();
}

$(document).ready(function(){
	postagem = new Postagem();
});