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
                 });
    });
    $('.show_less').each(function(){
                 $(this).click(function(){
                    var nid= $(this).attr('id');
                    $('#content'+nid).hide('slow', function() {
                    });
                 });
    });
});
})(jQuery);