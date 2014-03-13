var cadastroPost = null;

var CadastroPost = function(){
	var that = this;

	var _constructor = function(){
		var buttonAdd = $("#add");
		buttonAdd.bind("click",addField);
		var buttonAddTag = $("#addTag");
		buttonAddTag.bind("click",addTag);
		if(core.getUrlVar("acao")==2){
			$("#method").val("update");
			$("form").append("<input type='hidden' name='idPost' id='idPost' value='"+ core.getUrlVar("idPost") +"'>");
			var parameters = {"controller":"Postagem","method":"loadPost","idPost":core.getUrlVar("idPost")};
			core.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,loadInfo);
			//carregar informações
		}
		else
			$("#status").hide();
	}

	var addField = function(){
		var id = $(".img").last().attr("name");
		if (id==null)
			id="img_0"; 
		id = id.replace("img_","");
		id *= 1;
		id +=1;
		$("#imagens").append("<input type='file' class='img' accept='image/*' name='img_"+ id +"' id='img_"+ id +"'/>");
		$("#img_"+id).focus();
	}

	var addTag = function(){
		var id = $(".tag").last().attr("name");
		if (id==null)
			id="tag_0";
		id = id.replace("tag_","");
		id *= 1;
		id +=1;
		$("#tags").append("<input type='text' class='tag' name='tag_" + id +"' id='tag_" + id +"'/>");
		$("#tag_"+id).focus();	
	}

	var loadInfo = function(data){
		if (data.charAt(0)=="<"){
                    $("#geral").remove();
                    $("body").append(data);
                }
		var convertedData = core.convertToJSON(data);
		$("#txtTitulo").val(convertedData['postagem']['titulo']);
		$("#txtDescricao").val(convertedData['postagem']['texto']);
		$("#tipoPostagem_"+convertedData['postagem']['idTipoPostagem']).prop("checked",true);
		var output = Mustache.render($("#imgTemplate").html(),convertedData);
		$("#imagens").append(output);
		output = Mustache.render($("#tagTemplate").html(),convertedData);
		$("#tags").append(output);
	}

	_constructor();

}

$(document).ready(function(){
	cadastroPost = new CadastroPost();
});