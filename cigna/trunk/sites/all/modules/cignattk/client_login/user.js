(function($){
$(document).ready(function(){
	/*
	$(document).ajaxComplete(function(e, xhr, settings)
	{
	  
		response = $.parseJSON(xhr.responseText);
		$.each(response, function() {
           
            $.each(this, function(k, v) {
				if(k=="data"){
					$searchResult = v.search('User password has changed successfully.');
					if($searchResult>0){
						$("#edit-pwd").val("");
						$("#edit-new-pass").val("");
						$("#edit-comfirm-pass").val("");
					}
				}
		 });

        });
		//$('#txt').val(xhr.responseText);
	});*/
	$(document).ajaxSuccess(function(e, xhr, settings)
	{
		//alert("success");
	});
	/*$("div").click(function () {
		 //$(this).show();
	});*/
		function reload_form(nArgValue){
				$.ajax({
					url:Drupal.settings.basePath+"/reload_form/"+nArgValue,
					//beforeSend: function() { $('#premium'+nid).replaceWith('<div id="premium'+nid+'">Loading.....')},
					type:"GET",
					data: {divId:nArgValue}, 
					success:function(result){
						$("#change-password").html(result);
						//alert(result);
						//$('#premium'+nid).replaceWith('<div id="premium'+nid+'"><b>Premium :'+premium+'</b></div>');
					}
						
					});
		}

			function submit_update_password(nArgValue){
				$.ajax({
					url:Drupal.settings.basePath+"/reload_form/"+nArgValue,
					//beforeSend: function() { $('#premium'+nid).replaceWith('<div id="premium'+nid+'">Loading.....')},
					type:"GET",
					data: {divId:nArgValue}, 
					success:function(result){
						$("#change-password").html(result);
						//alert(result);
						//$('#premium'+nid).replaceWith('<div id="premium'+nid+'"><b>Premium :'+premium+'</b></div>');
					}
						
					});
			}

});
})(jQuery);

