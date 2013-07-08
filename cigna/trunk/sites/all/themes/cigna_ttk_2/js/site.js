(function($){
    $(document).ready(function(){
                    
        //$( "#radio" ).buttonset();
    
        var si=Drupal.settings.quick_quotation.si_range_value;
        
        var dynamic_si_values = new Array();
        var count=0;
        var realvalues = [1,2,3,4,5,6,7];
        $.each(si, function(key, value) {
            
            var value=(value/100000);
            dynamic_si_values.push((value));
            count++;
        });
        
        var per=100/--count;
        $.each(dynamic_si_values, function(key, value) {
            
            if(key==0){
                
                $('.steps').append('<span class="tick" style="left:0%"><img src="sites/all/themes/cigna_ttk_2/css/images/line_raze.png" alt=""/><br><b>'+value+'</b></span>');
                
            }else{
                $('.steps').append('<span class="tick" style="left: '+(per*key)+'%;"><img src="sites/all/themes/cigna_ttk_2/css/images/line_raze.png" alt=""/><br><b>'+value+'</b></span>');
            }
            //alert(key+'--'+value);
        });
		
		
		
		
        $("#amount_custom").text(dynamic_si_values[0]);
        $("#slider_custom").slider({
            value: 1,
            min: 1,
            max: ++count,
            step:1,
            range: "min",
            slide: function (event, ui) {
                
                $("#amount_custom").text(dynamic_si_values[ui.value-1]);
            }
        });
        
//		$("#slider_custom").insertBefore('<div class="datelist"></div>');  
    /*Quick Quote Range Slider Starts */
    
    if(count){
        var last=++count;
    }
    /*
    var realvalues = [01,02,03,04,05,07,06,08,09];
    
      $("#slider").rangeSlider({
		bounds: {min: 1, max: count},
        defaultValues:{min: 1},
        scales: [
          // Primary scale
          {
            first: function(val){ return val; },
            next: function(val){
                    return val +1;
            },
            stop: function(val){ return false; },
            label: function(val){
                
                    return (dynamic_si_values[Math.round(val)-1]);
            },
            
            format: function(tickContainer, tickStart, tickEnd){    
              tickContainer.addClass("hand-pointer");
            }
          },
          // Secondary scale
          {
            first: function(val){ return val; },
            next: function(val){
              if (val % 10 === 9){
                return val + 2;
              }
              return val + 1;
            },
            stop: function(val){ return false; },
            label: function(){ return null; }
          }],
  
	  });
	 var basicValues = $("#slider").rangeSlider("values");
    
     $( "#amount" ).text( dynamic_si_values[basicValues.min-1]);
     $(".si-hidden-value").val(dynamic_si_values[basicValues.min-1]);
  
	  $("#slider").on("valuesChanged", function(e, data){
	   
       
            if(basicValues.min==last){
                
                $("#slider").rangeSlider("values",(last-1));
            }
	   
            //alert(basicValues.max + '=' + Math.round(data.values.max));
           
            $("#amount").text(dynamic_si_values[Math.round(data.values.min)-1]);
            
            $(".si-hidden-value").val(dynamic_si_values[Math.round(data.values.min)-1]);
            //$(".ui-rangeSlider-rightLabel .ui-rangeSlider-label-value").text(realvalues[Math.round(data.values.max)-1]);
            $("#slider").rangeSlider("values",data.values.min,data.values.max);
   
             //$(".ui-rangeSlider-leftLabel .ui-rangeSlider-label-value").text("'"+realvalues[Math.round(data.values.min)-1]+"'");
            //$(".ui-rangeSlider-rightLabel .ui-rangeSlider-label-value").text("'"+realvalues[Math.round(data.values.max)-1]+"'"); 
		      // console.log("Something moved. min: " + data.values.min + " max: " + data.values.max + " min:" );
		});
    */
        /*Quick Quote Range Slider Ends */
        
        /*
        var realvalues = [1, 2, 3, 4, 5, 7, 10,15,30];
        $( "#slider-range" ).slider({
          range: true,
          min: 1,
          max: 9,
          animate: "fast" ,
          values: [ 2, 6],
          slide: function( event, ui ) {
    	   
                console.log("Something moved. min: " + ui.values[ 0 ] + " max: " + ui.values[ 1 ]);
                                
                $( ".selector" ).slider( "option", "values", [ ui.values[ 0 ], ui.values[ 1 ]] );
              $( "#amount" ).val( realvalues[ui.values[ 0 ]-1] + "-" + realvalues[ui.values[ 1 ]-1] );
              
              }
        });
        // console.log("Something Outside moved. min: " + $( "#slider-range" ).slider( "values", 0 ) + " max: " + $( "#slider-range" ).slider( "values", 1 ));
    $( "#amount" ).val( realvalues[($( "#slider-range" ).slider( "values", 0 ))-1] + "-"+ realvalues[($( "#slider-range" ).slider( "values", 1 ))-1]);
     var gender_value=$("#radio :radio:checked").val();
        
    $("input:radio[name=gender]").click(function() {
        
        gender_value=$("#radio :radio:checked").val(); 
        //alert(gender_value);
    });
	$( "#slider-range" ).on( "slidestop", function( event, ui ) {
	 
       $.ajax({
            url:"get_quote/ajax/slider/premium",
            type:"POST",
            data:{sum_insured_value1:ui.values[0],sum_insured_value2:ui.values[1],gender:gender_value},
            success:function(result){
                
                $(".approx-premium").html(result);
            }
                            
     });
	//	alert(ui.values[ 0 ] + "-"  +ui.values[ 1 ]);	
	} );*/
    
    $('#quick-quote-form').submit(function(){
        
        /*
        $("#quick-quotation-first-name").attr('style','');
        $("#quick-quote-last-name").attr('style','');
        $("#quick-quote-phone-number").attr('style','');
        $("#quick-quote-email").attr('style','');
        
        var frst_val=$("#quick-quotation-first-name").val();
        var frst_id=$("#quick-quotation-first-name").attr("id");
        
        var lst_val=$("#quick-quote-last-name").val();
        var lst_id=$("#quick-quote-last-name").attr("id");
        
        var phone_val=$("#quick-quote-phone-number").val();
        var phone_id=$("#quick-quote-phone-number").attr("id");
        
        var email_val=$("#quick-quote-email").val();
        var email_id=$("#quick-quote-email").attr("id");*/
        
        var location_val=$('#edit-select-location :selected').val();
        var c_id=$("#edit-select-location").attr("id");
       
        var sum_insured_value1=$('#amount_custom').text();
        
        var adult_val=$('#edit-adults :selected').val();
        var child_val=$('#edit-child :selected').val();
        var gender_value=$("#radio :radio:checked").val();
        
        var month_val=$('#edit-dob-month :selected').val();
        var day_val=$('#edit-dob-day :selected').val();
        var year_val=$('#edit-dob-year :selected').val();
        var stage='quick_quote';
        //if(allLetter(frst_val,frst_id)){
            
          //  if(allLetter(lst_val,lst_id)){
                
            //    if(phonenumber(phone_val,phone_id)){
                    
           //         if(ValidateEmail(email_val,email_id)){
                        
                        if(countryselect(location_val,c_id)){
                            
                            
                             $.ajax({
                                url:Drupal.settings.basePath+"quick_quote/ajax/premium",
                                type:"POST",
                                beforeSend: function() { $("#LoadingImage").show()},
                                //data:{sumInsured:sum_insured_value1,frst_val:frst_val,lst_val:lst_val,phone_val:phone_val,email_val:email_val,adult_val:adult_val,child_val:child_val,location_val:location_val,month_val:month_val,day_val:day_val,year_val:year_val,gender_value:gender_value},
                                
                                data:{quick_quote:1,sumInsured:sum_insured_value1,adult_val:adult_val,child_val:child_val,location_val:location_val,month_val:month_val,day_val:day_val,year_val:year_val,gender_value:gender_value},
                                success:function(result){
                                    
                                    $("#LoadingImage").hide();
                                    $("#quote-error").removeAttr('style');
                                    $(".premiumlist").html(result);
                                    
                                }
                            
                            });
                        }
                        
                    //}
            //    }   
          //  }
        //}
        
        return false;        
        
    });
  
    function allLetter(value,id)
    { 
        /*
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
                        'color': '#8c2e0b',
                        'border-color': '#ed541d',
                        'background-position': '8px 8px',
                        'background-repeat': 'no-repeat',
                        'border': '1px solid',
                        'margin': '6px 0',
                        'padding': '10px 10px 10px 50px',
                        'border-color': '#ed541d',
                    });
                    $("#"+id).attr('style','border-color:red');
                    $("#"+id).focus();
            }else{
                    $("#quote-error").text('The name contains invalid characters.');
                    $("#"+id).attr('style','border-color:red');
                    $("#"+id).focus();
            }
         //$("#quote-error").text('The name contains invalid characters.');
         //$("#"+id).attr('style','border-color:red');
         
        return false;
      }*/
      
    }
    function phonenumber(phone_val,id)
    {
        /*
        var phoneno = /^\d{10}$/;
        if(phone_val.match(phoneno))
        {
            $("#quote-error").text('');
            $("#"+id).attr('style','');
            return true;
        }
        else{
            $("#quote-error").text('Not a valid Phone Number.');
            $("#"+id).attr('style','border-color:red');
            $("#"+id).focus();
            return false;
        }*/
    }
    function ValidateEmail(email_val,id)
    {
        /*
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(email_val.match(mailformat)){
                $("#quote-error").text('');
                $("#"+id).attr('style','');
                return true;
        }
        else{
            $("#quote-error").text('You have entered an invalid email address!');
            $("#"+id).attr('style','border-color:red');
            $("#"+id).focus();
            return false;
        }*/
    }
    function countryselect(ucountry,id)
    {
        if(ucountry == "None")
        {
            $("#quote-error").text('Select your country from the list');
            $("#"+id).attr('style','border-color:red');
            $("#"+id).focus();
            return false;
        }
        else{
            $("#quote-error").text('');
            $("#"+id).attr('style','');
            return true;
        }
    }
                                           
    });
})(jQuery);