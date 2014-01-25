var post = null;

var Post = function(){
	var that = this;

	var _constructor = function(){
		var parameters = {"controller":"Postagem","method":"loadPosts","idPost":core.getUrlVar("idPost")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,loadPosts);
	} 

	var loadPosts = function(data){
		var convertedData = core.convertToJSON(data);
		var output = Mustache.render($("#template").html(),convertedData);
		$("#main").append(output);
	}

	_constructor();
}

$(document).ready(function(){
	post = new Post();
});