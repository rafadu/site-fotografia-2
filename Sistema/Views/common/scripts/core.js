var core = null;

var Core = function(){
	
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
}

$(document).ready(function(){
	core = new Core();
});