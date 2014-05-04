var cadastroLink = null;

var CadastroLink = function(){
	var that = this;

	var _constructor = function(){
		var btnCancel = $("input[name='btnCancel']");
		btnCancel.bind("click",core.btnCancelClick);
		var idType = core.getUrlVar('idType');
		if(idType==2)
			$("#typeLink").val(2);
		else if (idType==3)
			$("#typeLink").val(3);
		
		//editar
		if(core.getUrlVar('acao')==2){
			//mudar valor de hidden
			$("#method").val("updateLink");
			//adicionar hidden com idPost
			$("form").append("<input type='hidden' name='idImagem' id='idImagem' value='"+ core.getUrlVar("idImagem") +"'>");
			//carregar imagem e link de acordo com o id
			var parameters = {"controller":"Imagem","method":"selectLink","idImagem":core.getUrlVar("idImagem")};
			core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,loadInfo);
		}
		else{
			//$("#imgFeed").hide();
			$("<br /><br/>").insertAfter("#imgLink");
		}
	}

	var loadInfo = function(data){
		if (data.charAt(0)=="<"){
                    $("#geral").remove();
                    $("body").append(data);
                }
        var convertedData = core.convertToJSON(data);
        //console.log(convertedData);
        $("<br /><br/><img id='imgFeed' src="+convertedData['imagem']['caminhoImagem']+"><br /><br/>").insertAfter("#imgLink");
        $("#txtLink").val(convertedData['imagem']['link']);
        $("form").append("<input type='hidden' name='caminhoImagemVelha' id='caminhoImagemVelha' value='"+ convertedData['imagem']['caminhoImagem'] +"'>");
	}

	_constructor();
}

$(document).ready(function(){
	cadastroLink = new CadastroLink();
});