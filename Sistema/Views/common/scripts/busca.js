var busca = null;

var Busca = function(){
	var that = this;

	var _constructor = function(){
		//requisiçao ajax
		var parametros = {"controller":"Postagem","method":"search","tag":core.getUrlVar("busca")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,loadSearchResults);
	}

	var loadSearchResults = function(data){
		var convertedData = core.convertToJSON(data);
		var template = $("#template").html();
		var output = Mustache.render(template,data);
		$("#main").append(output);
	}

	_constructor();
}

$(document).ready(function(){
	busca = new Busca();
});