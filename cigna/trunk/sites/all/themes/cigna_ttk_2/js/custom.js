(function ($){
$(document).ready(function($){
    
    /*
    $('.ctools-use-modal-processed').click(function(){
        
        var first_name = $('input[id=quote-first-name]').val();
        var last_name = $('input[id=quote-last-name]').val();
        var phone_name = $('input[id=quote-phone-number]').val();
        var email = $('input[id=edit-email]').val();
        //alert(first_name+' '+last_name+ ' '+phone_name+' '+email);
        $.ajax({
               url:Drupal.settings.basePath + 'quick_quotation/ajax/lead/save',
               type:"POST",
               async:false,
               data:{first_name:first_name,last_name:last_name,phone_name:phone_name,email:email},
               success:function(result){
                
               }    
            });
    });*/
    
    $('.videoplaydata').hide('fast', function() {
        });
    $('.selectvideo').click(function(){
        $('.videoplaydata').show('slow', function() {
        });
    });;
    $('#closemodel').click(function(){
        $('.videoplaydata').hide('fast', function() {
        });
        //$('.videoplaydata').css('display:none');
    });
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
                    $('#shortcnt'+nid).hide('slow', function() {
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
                    $('#shortcnt'+nid).show('slow', function() {
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
    
    //mobile number validation for callback facility
    $("#call_submit").click(function(e)
    {
        var empty_count=0; // variable to store error occured status
        var phone_number_value = '';
    
        $("input:submit").attr("disabled", true);
        
        if($("#phone").val().length == 0)
        {
//            alert("first : "+$("#phone").val().length);
            $("#errormsg").text("this field can't be blank").show("fast");
            empty_count=1; 
        }
        else if($("#phone").val().length != 10)
        {
//            alert("second = "+$("#phone").val().length);
            $("#errormsg").text("Mobile should be 10 digits").show("fast");
            empty_count=1;                    
        }
        
        if(empty_count == 1)
        {
            e.preventDefault();
        }
        else
        {   
            e.preventDefault();
            phone_number_value = $("#phone").val();
            $.ajax({
                    url:Drupal.settings.basePath+"site_structure/ajax/callback_facitlity",
                    type:"POST",
                    //beforeSend: function() { $("#LoadingImage").show()},
                    //data:{sumInsured:sum_insured_value1,frst_val:frst_val,lst_val:lst_val,phone_val:phone_val,email_val:email_val,adult_val:adult_val,child_val:child_val,location_val:location_val,month_val:month_val,day_val:day_val,year_val:year_val,gender_value:gender_value},
                    
                    data:{phoneNumber:phone_number_value},
                    success:function(result){
                        $("#callback_msg").html("<h3><b>Your request received. We'll call you back shortly.</b></h3>");
                    }                
                });            
        }
    });
       
    $("#countrySelection").change(function() {
        if ($(this).val()) {
            window.open($(this).val(), '_blank');                        
        }
    });
    
    //user registration checkbox validation
    $("#user-register-form").submit(function(e){
        
        if ($('#edit-field-terms-conditions-1:checked').val() == undefined) {
          alert('Please accept the Terms & Conditions to register.');
          e.preventDefault();
        }        
    });
        
   });
})(jQuery);