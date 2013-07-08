(function($){
    $(document).ready(function(){
        
        //$(".proceed_popup").hide();
        
        
        $("#quote-first-name").blur(function(){
            
            $("#quote-error").text("");
            var frst_val=$("#quote-first-name").val();
            var frst_id=$("#quote-first-name").attr("id");
            if(allLetter(frst_val,frst_id)){
                $("#quote-error").text("");
            }
        });
        $("#quote-last-name").blur(function(){
            
            $("#quote-error").text("");
            var lst_val=$("#quote-last-name").val();
            var lst_id=$("#quote-last-name").attr("id");
            if(allLetter(lst_val,lst_id)){    
                $("#quote-error").text("");
            }
        });
        
        $("#quote-phone-number").blur(function(){
            
            $("#quote-error").text("");
            var phone_no=$("#quote-phone-number").val();
            var phone_id=$("#quote-phone-number").attr("id");
             if(phonenumber(phone_no,phone_id)){
                $("#quote-error").text("");
            }    
        });
        $("#edit-email").blur(function(){
            
            $("#quote-error").text("");
            var email_val=$("#edit-email").val();
            var email_id=$("#edit-email").attr("id");
            
            if(ValidateEmail(email_val,email_id)){
                $("#quote-error").text("");
                $(".proceed_popup").show();
            }
        });
        function phonenumber(phone_val,id)
        {
            var phoneno = /^\d{10}$/;
            if(phone_val.match(phoneno))
            {
                $("#quote-error").text('');
                $("#"+id).attr('style','');
                return true;
            }
            else{
                $("#quote-error").text('Not a valid Phone Number.');
                $("#quote-error").css({
                            'background-color':'#fef5f1',
                });
                $("#"+id).attr('style','border-color:red');
                $("#"+id).focus();
                return false;
            }
        }
        function ValidateEmail(email_val,id)
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(email_val.match(mailformat)){
                    $("#quote-error").text('');
                    $("#"+id).attr('style','');
                    return true;
            }
            else{
                $("#quote-error").text('You have entered an invalid email address!');
                $("#quote-error").css({
                            'background-color':'#fef5f1',
                });
                $("#"+id).attr('style','border-color:red');
                
                $("#"+id).focus();
                return false;
            }
        }
        function allLetter(value,id)
        { 
        
          var letters = /^[A-Za-z]+$/;
          if(value.match(letters)){
            $("#quote-error").text('');
            $("#"+id).attr('style','');
            return true;
          }
          else {
                if(value==''){
                        $("#quote-error").text('You must fill in all of the fields.');
                        
                        
                        
                        $("#quote-error").css({
                            'background-color':'#fef5f1',
                            /*
                            'color': '#8c2e0b',
                            'border-color': '#ed541d',
                            'background-position': '8px 8px',
                            'background-repeat': 'no-repeat',
                            'border': '1px solid',
                            'margin': '6px 0',
                            'padding': '10px 10px 10px 50px',
                            'border-color': '#ed541d',*/
                        });
                        $("#"+id).attr('style','border-color:red');
                        $("#"+id).focus();
                }else{
                        $("#quote-error").text('The name contains invalid characters.');
                         $("#quote-error").css({
                            'background-color':'#fef5f1',
                         });
                        $("#"+id).attr('style','border-color:red');
                        $("#"+id).focus();
                }
            return false;
          }
                  
        }
        
    });
})(jQuery);