var post = null;

var Post = function(){
	var that = this;

	var _constructor = function(){
		var parameters = {"controller":"Postagem","method":"loadPost","idPost":core.getUrlVar("idPost")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,loadPosts);
		core.loadFeeds(2);
        core.loadFeeds(3);
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
	post = new Post();
});