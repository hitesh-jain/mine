(function ($){
$(document).ready(function($){
    
    
        // START : For Populating Pre-entered STP Questions entered at quote level
   
         if($("#edit-pro-alcohol :radio:checked").val()==0){
                $("#edit-pro-alcohol-consumption").hide();
         }
         if($("#edit-pro-cigarette :radio:checked").val()==0){
                $("#edit-pro-cigarette-consumption").hide();
         }
         if($("#edit-pro-tobacco :radio:checked").val()==0){
                $("#edit-pro-tobacco-consumption").hide();
         }
         
         //For show/hide select list for STP questions
        $("#edit-pro-alcohol").click(function(){
            
            var alcohol=$("#edit-pro-alcohol :radio:checked").val();  
            if(alcohol==1){
                $("#edit-pro-alcohol-consumption").show();
            }else{
                $("#edit-pro-alcohol-consumption").hide();    
            }
        });
         $("#edit-pro-cigarette").click(function(){
            var cigarette=$("#edit-pro-cigarette :radio:checked").val();  
            if(cigarette==1){
                $("#edit-pro-cigarette-consumption").show();
            }else{
                $("#edit-pro-cigarette-consumption").hide();    
            }
        });
         $("#edit-pro-tobacco").click(function(){
            var tobacco=$("#edit-pro-tobacco :radio:checked").val();  
            if(tobacco==1){
                $("#edit-pro-tobacco-consumption").show();
            }else{
                $("#edit-pro-tobacco-consumption").hide();    
            }
        });  
        
        // END :
         
     $('#edit-same-as').click(function() {
        
        if($("#c1").is(":checked")){
            
            /*
            $("#edit-corresp-address-line-1").attr("disabled", "disabled"); 
            $("#edit-corresp-address-line-2").attr("disabled", "disabled");
            $("#edit-corresp-city").attr("disabled", "disabled");
            $("#edit-corresp-town-district").attr("disabled", "disabled");
            $("#edit-corresp-state").attr("disabled", "disabled");
            $("#edit-corresp-pincode").attr("disabled", "disabled");*/
            
            
            $permanent_add=$("#edit-permnt-address-line-1").val();
            $permanent_add2=$("#edit-permnt-address-line-2").val();
            $permanent_city=$("#edit-permnt-city").val();
            $permanent_district=$("#edit-permnt-town-district").val();
            $permanent_state=$("#edit-permnt-state").val();
            $permanent_pincode=$("#edit-permnt-pincode").val();
             if($permanent_add!=''){
                if($permanent_city !=''){
                    if($permanent_pincode != ''){
                        $("#edit-corresp-address-line-1").val($permanent_add);
                        $("#edit-corresp-address-line-2").val($permanent_add2);
                        $("#edit-corresp-city").val($permanent_city);
                        $("#edit-corresp-town-district").val($permanent_district);
                        $("#edit-corresp-state").val($permanent_state);
                        $("#edit-corresp-pincode").val($permanent_pincode);
                    }
                }  
             }
        }else{
            
            /*
            $("#edit-corresp-address-line-1").removeAttr("disabled");  
            $("#edit-corresp-address-line-2").removeAttr("disabled"); 
            $("#edit-corresp-city").removeAttr("disabled"); 
            $("#edit-corresp-town-district").removeAttr("disabled"); 
            $("#edit-corresp-state").removeAttr("disabled"); 
            $("#edit-corresp-pincode").removeAttr("disabled"); */ 
            
             $("#edit-corresp-address-line-1").val("");
             $("#edit-corresp-address-line-2").val("");
             $("#edit-corresp-city").val("");
             $("#edit-corresp-town-district").val("");
             $("#edit-corresp-state").val("");
             $("#edit-corresp-pincode").val("");    
        }
        
     });
     
    $("#all_questions").hide();
    
    $(".change").click(function(){
        
        $("#all_questions").toggle();
        $("#changed_mark_questions").hide();
        $(".screening_change").hide();
        
        $('input[name="mark_change_screening_flag"]').val("0");
        $('input[name="all_screening_flag"]').val("1");

       /* 
        var app_id= $('input[name="app_id"]').val();
        var insured_id= $('input[name="insured"]').val();
       
        $.ajax({
           url:Drupal.settings.basePath + "application/screening/questions/ajax",
           type:"POST",
           data:{app_id:app_id,insured_id:insured_id},
           success:function(result){
                exit;
                } 
        });*/
        
    });
    $('.conf_error').hide();
    $(".confirm_payment").click(function(){
        
         if($('input[name="cc"]').is(':checked')) {
            
        }else{
            $('.conf_error').show();
            $('.conf_error').text('Please accept above terms');
            return false;
        }
        
    });
    $("#billdesk-payment-form").submit(function(){
        
        if ($('input.paid[type=checkbox]:not(:checked)').length){
            
                $('.conf_error').show();
                $('.conf_error').text('Please accept above terms');
                return false;
        }else{
            $('.conf_error').hide();
        }
        
    });
    
});
})(jQuery);