var link = null;

var Link = function(){
	var that = this;

	var __constructor = function(){
		var parametros = {"controller":"Imagem","method":"loadFeed","idTipoImagem":core.getUrlVar("idTipoImagem")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,loadLinks);
		$("#btnNovoLink").bind("click",btnNovoLink);
	}

	var loadLinks = function(data){
		if (data.charAt(0)=="<"){
                    $("#geral").remove();
                    $("body").append(data);
                }
        $.get("templates.htm",function(templates){
            //template
            var tmp = $(templates).filter("#searchLinks").html();
            var convertedData = core.convertToJSON(data);
            var output = Mustache.render(tmp,convertedData);
            $("#links").append(output);
            $(".excluirLink").bind("click",btnExcluirLinkClick);
        });
	}

	var btnNovoLink = function(){
		$(window.document.location).attr("href","cadastroLink.html?acao=1&idType="+core.getUrlVar("idTipoImagem"));
	}

	var btnExcluirLinkClick = function(){
		var parametros = {"controller":"Imagem","method":"deleteFeed","idImagem":this.id,"caminhoImagem":$("#"+this.id).attr("src")};
		core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parametros,function(o){});
		$(window.document.location).attr("href","links.php?idTipoImagem="+core.getUrlVar("idTipoImagem"));
	}

	__constructor();
}

$(document).ready(function(){
	link = new Link();
});