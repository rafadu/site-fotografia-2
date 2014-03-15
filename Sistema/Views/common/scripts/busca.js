var busca = null;

var Busca = function(){
	var that = this;

	var _constructor = function(){
		//requisiçao ajax
		var parametros = {"controller":"Postagem","method":"search","tag":core.getUrlVar("busca")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,loadSearchResults);
		core.loadFeeds(2);
        core.loadFeeds(3);
	}

	var loadSearchResults = function(data){
            if (data.charAt(0)=="<"){
                    $("#geral").remove();
                    $("body").append(data);
                }
		var convertedData = core.convertToJSON(data);
		var template = $("#template").html();
		var output = Mustache.render(template,convertedData);
		$("#main").append(output);
	}

	_constructor();
}

$(document).ready(function(){
	busca = new Busca();
});