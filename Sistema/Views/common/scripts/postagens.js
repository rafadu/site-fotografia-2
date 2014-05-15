var postagens = null;

var Postagens = function(){
	var that = this;

	var __constructor = function(){
		var btnBuscaPost = $("#btnBuscaPost");
		btnBuscaPost.bind("click",btnBuscaClick);
		var parametros = {"controller":"Postagem","method":"search","tag":core.getUrlVar("busca"),"isAtivo":core.getUrlVar("isAtivo")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,loadResults);
	}

	var loadResults = function(data){
		if (data.charAt(0)=="<"){
                    $("#geral").remove();
                    $("body").append(data);
                }
		$.get("templates.htm",function(templates){
            //template
            var tmp = $(templates).filter("#searchPainelTemplate").html();
            var convertedData = core.convertToJSON(data);
            var output = Mustache.render(tmp,convertedData);
            $("#postagens").append(output);
        });
	}

	var btnBuscaClick = function(){
        //pegar valor do textBox
        var parametroPesquisa = $("#txtBusca").val();
        $(window.document.location).attr("href","postagens.php?busca="+parametroPesquisa+"&isAtivo="+core.getUrlVar("isAtivo"));
    }

	__constructor();
}

$(document).ready(function(){
	postagens = new Postagens();
});