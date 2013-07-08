(function($){
    
    $(document).ready(function(){
		
		var si=Drupal.settings.get_quote.si_range_value;
        
        var clicked=$(".suggest_clicked").val();
        
        var min_value=0;
        
        if(clicked==1 || clicked==2 || clicked==3){
         
            if(clicked==3){
                min_value=2;
            }else{
                min_value=1;
            }   
            $('.form-item-hd-current-cover').hide();
            $('#works').hide();    
        }else if(clicked==4 ){
            
            min_value=1;
            $('.form-item-hd-current-cover').show();
            $('#works').show();
        }
        
        $("#edit-hd-check-1").click(function(){
            
            if($('input[name="hd_check[1]"]').is(':checked')) {
             
                $('.form-item-hd-current-cover').show();
                $('#works').show();
            }else{
                $('.form-item-hd-current-cover').hide();
                $('#works').hide();
            }
        });
        
       var dynamic_si_values = new Array();
       var count=0;
       $.each(si, function(key, value) {
            
            var value=(value/100000);
            dynamic_si_values.push((value));
            count++;
        });
        
        var per=100/--count;
        $.each(dynamic_si_values, function(key, value) {
            
            if(key==0){
                
                $('.steps').append('<span class="tick" style="left:0%";>|<br>'+value+'</span>');
                
            }else{
                $('.steps').append('<span class="tick" style="left: '+(per*key)+'%;">|<br>'+value+'</span>');
            }
        });
        $("#amount_custom").text(dynamic_si_values[0]);
        $(".si_hidden_value").val(dynamic_si_values[0]);
        
        var result=$("#slider_custom").slider({
            value: min_value,
            min: 1,
            max: ++count,
            step:1,
            range: "min",
        });
        var already_cover=0;
        
        $( "#edit-hd-current-cover" ).change(function() {
        
            if(this.selectedIndex){
            
                var hd_selected_value=$("#edit-hd-current-cover :selected").val();
                already_cover=this.selectedIndex;
                
                result.slider("value", this.selectedIndex);
                $("#amount_custom").text(dynamic_si_values[this.selectedIndex-1]);
                $(".si_hidden_value").val(dynamic_si_values[this.selectedIndex-1]);    
            }
       });
       
       $("#slider_custom").on( "slide", function( event, ui ) {
       
                $("#amount_custom").text(dynamic_si_values[ui.value-1]);
                $(".si_hidden_value").val(dynamic_si_values[ui.value-1]);
                
                if(already_cover){
                    
                   if(ui.value<already_cover){
                        $("#amount_custom").text(dynamic_si_values[already_cover-1]);
                        $(".si_hidden_value").val(dynamic_si_values[already_cover-1]);
                        return false;
                    }
                }
       });
       
    
        
     $("#name-adult").hide();
     $("#user-details").hide();
     $("#region-details").hide();
     $("#si-details").hide();
     $(".si-done").hide();

     $(".quote-submit").attr('style','display:none');   
     $(".count-done").click(function(){
        
        
        var no_adult=$('#edit-adults :selected').val();
        var no_child=$('#edit-child :selected').val();
        $.ajax({
            url:Drupal.settings.basePath+"get_quote/ajax/people/count",
            type:"POST",
            beforeSend: function() { $("#LoadingImage_people").show()},
            data:{no_adult:no_adult,no_child:no_child},
            success:function(result){
                //alert($result);exit;
                $("#LoadingImage_people").hide();
                $("#name-adult").hide();
                $('.people-flow').removeClass('active');
                //$('.people-details-flow').addClass('active');
                $('.details-form').html(result);
                $("#edit-cycle-start").remove();
                $("#edit-content-cycle-end").remove();
                $("#edit-cycle-start").remove();
                $("#edit-content-cycle-end").remove();
                $('#carousel_home').cycle({
        			fx:'fade',
        			prev: '#btn_prev',
        			next: '#btn_next',
        			speed:  'fast', 
        			timeout: 0, 	
	           });
               
              $(".tobacco_value").hide();
               
               $("#carousel_home .adultfieldsdetails").each(function(index){
        
                    var aid=$(this).attr('id');
                    if($("#edit-ad-tobacco-"+aid+" :radio:checked").val()==1){
                            $("#edit-ad-tobacco-yes-"+aid).show();
                    }
                    if($("#edit-ad-alcohol-"+aid+" :radio:checked").val()==1){
                            $("#edit-ad-alcohol-yes-"+aid).show();
                    }
                    if($("#edit-ad-cigarette-"+aid+" :radio:checked").val()==1){
                            $("#edit-ad-cigarette-yes-"+aid).show();
                    }
                    $("#edit-ad-tobacco-"+aid).click(function(){
                       var tobacco=$("#edit-ad-tobacco-"+aid+" :radio:checked").val(); 
                       if(tobacco==1){
                            $("#edit-ad-tobacco-yes-"+aid).show();
                       }else{
                            $("#edit-ad-tobacco-yes-"+aid).hide();    
                       }
                    });
                   $("#edit-ad-alcohol-"+aid).click(function(){
                    
                        var alcohol=$("#edit-ad-alcohol-"+aid+" :radio:checked").val();
                        if(alcohol==1){
                            $("#edit-ad-alcohol-yes-"+aid).show();
                        }else{
                            $("#edit-ad-alcohol-yes-"+aid).hide();     
                        }
                   }); 
                   $("#edit-ad-cigarette-"+aid).click(function(){
                    
                        var cigarette=$("#edit-ad-cigarette-"+aid+" :radio:checked").val();
                        if(cigarette==1){
                            $("#edit-ad-cigarette-yes-"+aid).show();
                        }else{
                            $("#edit-ad-cigarette-yes-"+aid).hide();
                        }
                   }); 
                });
                $("#carousel_home .childfieldsdetails").each(function(index){
        
                    var aid=$(this).attr('id');
                     if($("#edit-ch-tobacco-"+aid+" :radio:checked").val()==1){
                            $("#edit-ch-tobacco-yes-"+aid).show();
                    }
                    if($("#edit-ch-alcohol-"+aid+" :radio:checked").val()==1){
                            $("#edit-ch-alcohol-yes-"+aid).show();
                    }
                    if($("#edit-ch-cigarette-"+aid+" :radio:checked").val()==1){
                            $("#edit-ch-cigarette-yes-"+aid).show();
                    }
                    $("#edit-ch-tobacco-"+aid).click(function(){
                       var tobacco=$("#edit-ch-tobacco-"+aid+" :radio:checked").val(); 
                       if(tobacco==1){
                            $("#edit-ch-tobacco-yes-"+aid).show();
                       }else{
                            $("#edit-ch-tobacco-yes-"+aid).hide();    
                       }
                    });
                   $("#edit-ch-alcohol-"+aid).click(function(){
                    
                        var alcohol=$("#edit-ch-alcohol-"+aid+" :radio:checked").val();
                        if(alcohol==1){
                            $("#edit-ch-alcohol-yes-"+aid).show();
                        }else{
                            $("#edit-ch-alcohol-yes-"+aid).hide();
                        }
                   }); 
                   $("#edit-ch-cigarette-"+aid).click(function(){
                    
                        var cigarette=$("#edit-ch-cigarette-"+aid+" :radio:checked").val();
                        if(cigarette==1){
                            $("#edit-ch-cigarette-yes-"+aid).show();
                        }else{
                            $("#edit-ch-cigarette-yes-"+aid).hide();      
                        }
                   });
                });
              /*
              if($(".first_done").is(':empty')){
                
                $(".first_done").append("<div class='click_it'>Hello</div>");
              }
              $(".first_done").trigger('click');*/
              
               $(".people-details-flow").trigger("click");
            }
        });
     });
     /*
     $(".first_done").click(function(){
        
          $(".quote-submit").attr('style','display:none');
            $(".people-flow").removeClass('active');
            $(".region-flow").removeClass('active');
            $(".si-flow").removeClass('active');
            $(this).toggleClass('active');
            $("#user-details").toggle();
            $("#name-adult").hide();
            $("#si-details").hide();
            $("#region-details").hide(); 
       
     });*/
     $(".calculate a").click(function(){
           
        var aid=$('#carousel_home .adultfieldsdetails').attr('id');
        var gender_value=$("#edit-ad-gender-"+aid+" :radio:checked").val();
        var month_val=$("#edit-ad-dob-"+aid+"-month :selected").val();
        var day_val=$("#edit-ad-dob-"+aid+"-day :selected").val();
        var year_val=$("#edit-ad-dob-"+aid+"-year :selected").val();
        
        var sum_insured_value1=$('.si_hidden_value').val();
        var adult_val=$('#edit-adults :selected').val();
        var child_val=$('#edit-child :selected').val();
        var location_val=$('#edit-select-region :selected').val();
        
        var hd_option=$("#edit-hd-check-1").val();
        
        var hd_option_price=$("#edit-hd-current-cover :selected").val();
        
        var people_details ={};
        people_details['adults']={};
         $("#carousel_home .adultfieldsdetails").each(function(index){
             
                    var aid=$(this).attr('id');
                    var gender=$("#edit-ad-gender-"+aid+" :radio:checked").val();
                    var month=$("#edit-ad-dob-"+aid+"-month :selected").val();
                    var day=$("#edit-ad-dob-"+aid+"-day :selected").val();
                    var year=$("#edit-ad-dob-"+aid+"-year :selected").val();
                    
                    var tobacco=$("#edit-ad-tobacco-"+aid+" :radio:checked").val();
                    var alcohol=$("#edit-ad-alcohol-"+aid+" :radio:checked").val();
                    var cigarette=$("#edit-ad-cigarette-"+aid+" :radio:checked").val();
                    
                    
                    var tobacco_consumption=$("#edit-ad-tobacco-yes-"+aid+" :selected").val();
                    var alcohol_consumption=$("#edit-ad-alcohol-yes-"+aid+" :selected").val();
                    var cigarette_consumption=$("#edit-ad-cigarette-yes-"+aid+" :selected").val();
                    
                    people_details['adults'][aid]={
                        'gender':gender,
                        'month':month,
                        'day':day,
                        'year':year,
                        'tobacco':tobacco,
                        'alcohol':alcohol,
                        'cigarette':cigarette,
                        'tobacco_consumption':tobacco_consumption,
                        'alcohol_consumption':alcohol_consumption,
                        'cigarette_consumption':cigarette_consumption,  
                    };       
        });
        people_details['childs']={};
        $("#carousel_home .childfieldsdetails").each(function(index){
             
                    var aid=$(this).attr('id');
                    var gender=$("#edit-ch-gender-"+aid+" :radio:checked").val();
                    
                    var month=$("#edit-ch-dob-"+aid+"-month :selected").val();
                    var day=$("#edit-ch-dob-"+aid+"-day :selected").val();
                    var year=$("#edit-ch-dob-"+aid+"-year :selected").val();
                    
                    var tobacco=$("#edit-ch-tobacco-"+aid+" :radio:checked").val();
                    var alcohol=$("#edit-ch-alcohol-"+aid+" :radio:checked").val();
                    var cigarette=$("#edit-ch-cigarette-"+aid+" :radio:checked").val();
                    
                    var tobacco_consumption=$("#edit-ch-tobacco-yes-"+aid+" :selected").val();
                    var alcohol_consumption=$("#edit-ch-alcohol-yes-"+aid+" :selected").val();
                    var cigarette_consumption=$("#edit-ch-cigarette-yes-"+aid+" :selected").val();
                    
                    people_details['childs'][aid]={
                        'gender':gender,
                        'month':month,
                        'day':day,
                        'year':year,
                        'tobacco':tobacco,
                        'alcohol':alcohol,
                        'cigarette':cigarette,  
                        'tobacco_consumption':tobacco_consumption,
                        'alcohol_consumption':alcohol_consumption,
                        'cigarette_consumption':cigarette_consumption,
                    };            
        });
        
        $.ajax({
           url:Drupal.settings.basePath+"quick_quote/ajax/premium",
           type:"POST",
           beforeSend: function() { $("#LoadingImage").show()},
           data:{sumInsured:sum_insured_value1,adult_val:adult_val,child_val:child_val,month_val:month_val,day_val:day_val,year_val:year_val,gender_value:gender_value,location_val:location_val,hd_option:hd_option,hd_option_price:hd_option_price,people_details:people_details},
           success:function(result){    
            $("#LoadingImage").hide();
            $("#approx-premium").html(result);
            $(".si-done").toggle();
           }    
        });
        
     });
     
     /* Tobacco , Alcohol , Cigarette Values Start */
     $(".tobacco_value").hide();
     $("#carousel_home .adultfieldsdetails").each(function(index){
        
        
                    var aid=$(this).attr('id');
                     
                    if($("#edit-ad-tobacco-"+aid+" :radio:checked").val()==1){
                            $("#edit-ad-tobacco-yes-"+aid).show();
                    }
                    if($("#edit-ad-alcohol-"+aid+" :radio:checked").val()==1){
                            $("#edit-ad-alcohol-yes-"+aid).show();
                    }
                    if($("#edit-ad-cigarette-"+aid+" :radio:checked").val()==1){
                            $("#edit-ad-cigarette-yes-"+aid).show();
                    }
                    //alert(aid);
                    $("#edit-ad-tobacco-"+aid).click(function(){
                       var tobacco=$("#edit-ad-tobacco-"+aid+" :radio:checked").val(); 
                       if(tobacco==1){
                            $("#edit-ad-tobacco-yes-"+aid).show();
                       }else{
                            $("#edit-ad-tobacco-yes-"+aid).hide();    
                       }
                    });
                   $("#edit-ad-alcohol-"+aid).click(function(){
                    
                        var alcohol=$("#edit-ad-alcohol-"+aid+" :radio:checked").val();
                        if(alcohol==1){
                            $("#edit-ad-alcohol-yes-"+aid).show();
                        }else{
                            $("#edit-ad-alcohol-yes-"+aid).hide();     
                        }
                   }); 
                   $("#edit-ad-cigarette-"+aid).click(function(){
                    
                       var cigarette=$("#edit-ad-cigarette-"+aid+" :radio:checked").val();
                        if(cigarette==1){
                            $("#edit-ad-cigarette-yes-"+aid).show();
                        }else{
                            $("#edit-ad-cigarette-yes-"+aid).hide();
                        }
                   }); 
     });
     $("#carousel_home .childfieldsdetails").each(function(index){
        
                    var aid=$(this).attr('id');
                    if($("#edit-ch-tobacco-"+aid+" :radio:checked").val()==1){
                            $("#edit-ch-tobacco-yes-"+aid).show();
                    }
                    if($("#edit-ch-alcohol-"+aid+" :radio:checked").val()==1){
                            $("#edit-ch-alcohol-yes-"+aid).show();
                    }
                    if($("#edit-ch-cigarette-"+aid+" :radio:checked").val()==1){
                            $("#edit-ch-cigarette-yes-"+aid).show();
                    }
                    $("#edit-ch-tobacco-"+aid).click(function(){
                       var tobacco=$("#edit-ch-tobacco-"+aid+" :radio:checked").val(); 
                       if(tobacco==1){
                            $("#edit-ch-tobacco-yes-"+aid).show();
                       }else{
                            $("#edit-ch-tobacco-yes-"+aid).hide();    
                       }
                    });
                   $("#edit-ch-alcohol-"+aid).click(function(){
                    
                        var alcohol=$("#edit-ch-alcohol-"+aid+" :radio:checked").val();
                        if(alcohol==1){
                            $("#edit-ch-alcohol-yes-"+aid).show();
                        }else{
                            $("#edit-ch-alcohol-yes-"+aid).hide();
                        }
                   }); 
                   $("#edit-ch-cigarette-"+aid).click(function(){
                    
                        var cigarette=$("#edit-ch-cigarette-"+aid+" :radio:checked").val();
                        if(cigarette==1){
                            $("#edit-ch-cigarette-yes-"+aid).show();
                        }else{
                            $("#edit-ch-cigarette-yes-"+aid).hide();      
                        }
                   });
     });
     /* Tobacco , Alcohol , Cigarette Values Ends */
     
     $(".content-done").click(function(){
            
        var people_details ={};
        people_details['adults']={};
        
        $("#carousel_home .adultfieldsdetails").each(function(index){
             
                    var aid=$(this).attr('id');
                    var gender=$("#edit-ad-gender-"+aid+" :radio:checked").val();
                    var month=$("#edit-ad-dob-"+aid+"-month :selected").val();
                    var day=$("#edit-ad-dob-"+aid+"-day :selected").val();
                    var year=$("#edit-ad-dob-"+aid+"-year :selected").val();
                    
                    var tobacco=$("#edit-ad-tobacco-"+aid+" :radio:checked").val();
                    var alcohol=$("#edit-ad-alcohol-"+aid+" :radio:checked").val();
                    var cigarette=$("#edit-ad-cigarette-"+aid+" :radio:checked").val();
                    
                    if(tobacco!=0){
                        var tobacco_consumption=$("#edit-ad-tobacco-yes-"+aid+" :selected").val();
                                              
                    }else{
                        var tobacco_consumption=0;
                    } 
                    if(alcohol!=0){
                        
                        var alcohol_consumption=$("#edit-ad-alcohol-yes-"+aid+" :selected").val();
                    }else{
                        var alcohol_consumption=0;
                    }
                    if(cigarette!=0){
                        var cigarette_consumption=$("#edit-ad-cigarette-yes-"+aid+" :selected").val();
                    }else{
                        var cigarette_consumption=0;
                    }
                    people_details['adults'][aid]={
                        'gender':gender,
                        'month':month,
                        'day':day,
                        'year':year,
                        'tobacco':tobacco,
                        'alcohol':alcohol,
                        'cigarette':cigarette,
                        'tobacco_consumption':tobacco_consumption,
                        'alcohol_consumption':alcohol_consumption,
                        'cigarette_consumption':cigarette_consumption,  
                    };       
        });
        
        people_details['childs']={};
        $("#carousel_home .childfieldsdetails").each(function(index){
             
                    var aid=$(this).attr('id');
                    var gender=$("#edit-ch-gender-"+aid+" :radio:checked").val();
                    
                    var month=$("#edit-ch-dob-"+aid+"-month :selected").val();
                    var day=$("#edit-ch-dob-"+aid+"-day :selected").val();
                    var year=$("#edit-ch-dob-"+aid+"-year :selected").val();
                    
                    var tobacco=$("#edit-ch-tobacco-"+aid+" :radio:checked").val();
                    var alcohol=$("#edit-ch-alcohol-"+aid+" :radio:checked").val();
                    var cigarette=$("#edit-ch-cigarette-"+aid+" :radio:checked").val();
                    
                    if(tobacco!=0){
                        var tobacco_consumption=$("#edit-ch-tobacco-yes-"+aid+" :selected").val();
                                              
                    }else{
                        var tobacco_consumption=0;
                    } 
                    if(alcohol!=0){
                        
                        var alcohol_consumption=$("#edit-ch-alcohol-yes-"+aid+" :selected").val();
                    }else{
                        var alcohol_consumption=0;
                    }
                    if(cigarette!=0){
                        var cigarette_consumption=$("#edit-ch-cigarette-yes-"+aid+" :selected").val();
                    }else{
                        var cigarette_consumption=0;
                    }
                    
                    people_details['childs'][aid]={
                        'gender':gender,
                        'month':month,
                        'day':day,
                        'year':year,
                        'tobacco':tobacco,
                        'alcohol':alcohol,
                        'cigarette':cigarette,  
                        'tobacco_consumption':tobacco_consumption,
                        'alcohol_consumption':alcohol_consumption,
                        'cigarette_consumption':cigarette_consumption,
                    };            
        });
        
         $.ajax({
            url:Drupal.settings.basePath+"get_quote/ajax/data/save",
            type:"POST",
            //beforeSend: function() { $("#LoadingImage").show()},
            data:{people_details:people_details},
            success:function(result){
                
                //$("#LoadingImage_people").hide();
                $(".people-details-flow").removeClass('active');
                //$(".region-flow").addClass('active');
                $("#user-details").hide();
                //$("#region-details").show();
                $(".region-flow").trigger("click");
                }
         }); 
        
        
     });
     $(".region-done").click(function(){
        
        $(".region-flow").removeClass('active');
        //$(".si-flow").addClass('active');
        $("#region-details").hide();
        //$("#si-details").show();
        $(".si-flow").trigger("click");
     });
      $(".si-done").click(function(){
         $(".si-flow").removeClass('active');
         $("#si-details").hide();
         $(".quote-submit").attr('style','display:block');
     });
     
     $(".people-details-flow").bind('click',function(){
            
            $(".quote-submit").attr('style','display:none');
            $(".people-flow").removeClass('active');
            $(".region-flow").removeClass('active');
            $(".si-flow").removeClass('active');
            $(this).toggleClass('active');
            $("#user-details").toggle();
            $("#name-adult").hide();
            $("#si-details").hide();
            $("#region-details").hide();
     });
     
    $(".people-flow").click(function(){
        
        $(".quote-submit").attr('style','display:none');
        $(".people-details-flow").removeClass('active');
        $(".region-flow").removeClass('active');
        $(".si-flow").removeClass('active');
        $(this).toggleClass('active');
        $("#name-adult").toggle();
        $("#user-details").hide();
        $("#si-details").hide();
        $("#region-details").hide();
    }); 
    
    $(".region-flow").click(function(){
        
        $(".quote-submit").attr('style','display:none');
        $(".people-details-flow").removeClass('active');
        $(".people-flow").removeClass('active');
        $(".si-flow").removeClass('active');
        $(this).toggleClass('active');
        $("#name-adult").hide();
        $("#user-details").hide();
        $("#si-details").hide();
        $("#region-details").toggle();
    });
    
    $(".si-flow").click(function(){
        
        //$('#slider-quote').rangeSlider('resize');
        $(".people-details-flow").removeClass('active');
        $(".people-flow").removeClass('active');
        $(".region-flow").removeClass('active');
        $(this).toggleClass('active');
        $("#name-adult").hide();
        $("#user-details").hide();
        $("#region-details").hide();
        $("#si-details").toggle();
        $(".quote-submit").attr('style','display:none');
        
    });
   
    $(".close").click(function(){
            location.reload();
        
    }); 
           
    });
})(jQuery);