//http://ctrlq.org/code/19233-submit-forms-with-javascript
//var jQuery = jQuery.noConflict();


jQuery(document).ready(function(){ 
			jQuery(document).mousemove(function(e){
				jQuery('#x').val(e.pageX);
				jQuery('#y').val(e.pageY);
			});
			jQuery(document).dblclick(function(){
			//jQuery.colorbox({html:"<h1>Welcome</h1>"});
			//alert("Double Click");
			if (typeof(jQuery.colorbox) === 'function') {
			getSelTxt();
			} else {
			getSelText();	
			}

			});

});



function submitFORM(path, params, method) {
    method = method || "post";
 
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
 
    //Move the submit function to another variable
    //so that it doesn't get overwritten.
    form._submit_function_ = form.submit;
 
    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
 
            form.appendChild(hiddenField);
         }
    }
 
    document.body.appendChild(form);
    form._submit_function_();
}
function zg_setcookies(){
	document.cookie = 'font=zawgyi'; 
	submitFORM('#', 'POST',
    {'font':'zawgyi'}); 
	window.location.reload()
	}
function ay_setcookies(){
	document.cookie = 'font=ayar'; 
	submitFORM('#', 'POST',
    {'font':'ayar'});  
	window.location.reload()
	}
function mm3_setcookies(){
	document.cookie = 'font=mm3'; 
	submitFORM('#', 'POST',
    {'font':'mm3'});  
	window.location.reload()
	}
	
var ajaxObj="";
	function getSelText()
	{
		var txt = "";
		if (window.getSelection){  txt = window.getSelection();   }
	   else if (document.getSelection){ txt = document.getSelection();  }
	   else if (document.selection){ txt = document.selection.createRange().text; }
	   else return;
	if(txt==""){return;}
	jQuery('#popup').css("top",(jQuery("#y").val()) + "px");
	jQuery('#popup').css("left",(jQuery("#x").val()) + "px");

	jQuery('#popup').fadeIn(300);
	jQuery('#dic_content').html("loading....");

	if(ajaxObj!=""){ajaxObj.abort(); }

	ajaxObj=jQuery.ajax({
	 type: "GET",
	 url: "http://ayar.co/remote_search.php?word=" +txt,
	 success: function(content){
	jQuery('#dic_content').html(content);
	}
	});

	}
	
	function getSelTxt()
	{
		var txt = "";
		if (window.getSelection){  txt = window.getSelection();   }
	   else if (document.getSelection){ txt = document.getSelection();  }
	   else if (document.selection){ txt = document.selection.createRange().text; }
	   else return;
	if(txt==""){return;}
	jQuery.colorbox({href:"http://ayar.co/remote_search.php?word=" +txt, width:"50%", height:"80%"});
	}
