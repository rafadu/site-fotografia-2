var core = null;

var Core = function(){
	var that = this;
	this.IsAppleDevice = function(){
		return navigator.userAgent.match(/iPhone/i) ||
             navigator.userAgent.match(/iPad/i) ||
             navigator.userAgent.match(/iPod/i);
	}

	this.convertToJSON = function(obj){
        return $.parseJSON(obj);
    }

    this.ajaxRequisition = function(verb,address,parameters,successMethod){
        $.ajax({
            type: verb,
            url: address,
            data: parameters,
            success: successMethod,
            error: function(o){
                alert("deu erro");
                console.log(o);
            }
        });
    }
	
    var getUrlVars= function(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    
    this.getUrlVar= function(name){
        return getUrlVars()[name];
    }

    var btnBuscaClick = function(){
        //pegar valor do textBox
        var parametroPesquisa = $("#txtBusca").val();
        $(window.document.location).attr("href","busca.html?busca="+parametroPesquisa);
    }
    
    var txtBuscaClick = function(){
        $("#txtBusca").val("");
        $("#txtBusca").focus();
    }

    this.loadFeeds = function(idTipoImagem){
        var parameters = {"controller":"Imagem","method":"loadFeed","idTipoImagem":idTipoImagem}
        that.ajaxRequisition("POST","..\\Application\\Dispatch.php",parameters,makeTemplate);
    }

    var makeTemplate = function(data){
        $.get("templates.htm",function(templates){
            //template
            var tmp = $(templates).filter("#feedTemplate").html();
            var convertedData = core.convertToJSON(data);
            var output = Mustache.render(tmp,convertedData);
            if(convertedData['feeds'][0]['idTipoImagem']==2)
                $("#feeds").append(output);
            else
                $("#parceiros").append(output);
        });
    }

    this.btnCancelClick = function(){
        $(window.document.location).attr("href","painel.php");
    }

    var _constructor = function(){
        var btnBusca = $("#btnBusca");
        btnBusca.bind("click",btnBuscaClick);
        var txtBusca = $("#txtBusca");
        txtBusca.bind("click",txtBuscaClick);
        if(document.URL.indexOf("contato.html")>0){
            that.loadFeeds(2);
            that.loadFeeds(3);
        }
    }

    _constructor();
}

$(document).ready(function(){
	core = new Core();
});