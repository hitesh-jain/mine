(function ($){
$(document).ready(function($){
	$('#mega-menu-tut').dcMegaMenu({
		rowItems: '2',
		speed: 'fast'
	});
    // for show more and show less option
    $('.show_more').each(function(){
                 $(this).click(function(){
                    var nid= $(this).attr('id');
                    $('#content'+nid).show('slow', function() {
                    });
                    $('.show_mor'+nid).hide('slow', function() {
                    });
                    $('.show_les'+nid).show('slow', function() {
                    });
                 });
    });
    $('.show_less').each(function(){
                 $(this).click(function(){
                    var nid= $(this).attr('id');
                    $('#content'+nid).hide('slow', function() {
                    });
                    $('.show_les'+nid).hide('slow', function() {
                    });
                    $('.show_mor'+nid).show('slow', function() {
                    });
                    
                 });
    });
    //var planid=new Array();
    $(".compare").click(function(index){
            
            
        if($(this).is(":checked")){
       
            planid= $(this).val();
            $.ajax({
               url:Drupal.settings.basePath + 'quick_quotation/ajax/compare',
               type:"POST",
               data:{planid:planid,checked:1},
               success:function(result){
                    
                exit;
               }    
            });
        }else{
            planid= $(this).val();
            $.ajax({
               url:Drupal.settings.basePath + 'quick_quotation/ajax/compare',
               type:"POST",
               data:{planid:planid,checked:0},
               success:function(result){
                
               }    
            });   
        }
    });
});
})(jQuery);