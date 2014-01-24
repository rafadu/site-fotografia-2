var index = null;

var Index = function(){
	var that = this;

	var _constructor = function(){
		//fazer a requisição ajax, passando o loadPosts como parametro de metodo de sucesso
		var parameters = {"controller":"Postagem","method":"loadIndexPosts"};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,loadPosts);
	}

	var loadPosts = function(data){
		var convertedData = core.convertToJSON(data);
		var template = $("#template").html();
		var output = Mustache.render(template,convertedData);
		$("#main").append(output);
	}
	_constructor();
	
}

$(document).ready(function(){
	index = new Index();
});