var painel = null;

var Painel = function(){
	var that = this;

	var __constructor = function(){
		var parametros = {"controller":"Postagem","method":"loadLastPosts","painel":"1"};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,loadPosts);
		parametros = {"controller":"Report","method":"painelReport"};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,report);
	}

	var loadPosts = function(data){
		if (data.charAt(0)=="<"){
            $("#geral").remove();
            $("body").append(data);
        }

        $.get("templates.htm",function(templates){
            //template
            var tmp = $(templates).filter("#postsInPainel").html();
            var convertedData = core.convertToJSON(data);
            var output = Mustache.render(tmp,convertedData);
            $("#ultimasPostagens").append(output);
        });

	}

	var report = function(data){
		if (data.charAt(0)=="<"){
            $("#geral").remove();
            $("body").append(data);
        }
        $.get("templates.htm",function(templates){
            //template
            var tmp = $(templates).filter("#report").html();
            var convertedData = core.convertToJSON(data);
            var output = Mustache.render(tmp,convertedData);
            $("#estatisticas").append(output);
        });
	}


	__constructor();
}

$(document).ready(function(){
	painel = new Painel();
});