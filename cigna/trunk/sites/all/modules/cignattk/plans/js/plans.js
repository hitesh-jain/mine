(function ($){
    $(document).ready(function() {
        
            $('.getQuote').each(function(){
                
                 $(this).click(function(){
                    
                     var nid= $(this).attr('id');
                     
                     //var tenureVal = $("#selectedyear").text();
                     
                     var tenureVal = $("#replace_"+nid).text();
                     var tenureVal = parseInt(tenureVal);
                     
                     var siVal = $("#selectedSI").text();
                     var sumInsuredVal = parseInt(siVal);
                     
                     var planId = $("#planId"+nid).val();
                     var qid=$("#plan_quote_id"+nid).val();         
                                                                  
                     //alert(tenureVal+' '+sumInsuredVal+' '+planId +' '+qid);
                     //var planoptioncd=$('#planoptioncode').val();
                     
                     var planoptioncd=$('#plan_option_code_'+nid).text();
                     
                     $.ajax({
                        url:Drupal.settings.basePath+"plans/ajax/sum_insured",
                        beforeSend: function() { $('#getpremium'+nid).text('Loading.....')},
                        type:"POST",
                        data: {ajax:1,tenure_status:1,tenure:tenureVal,sumInsured:sumInsuredVal,planId:planId,qid:qid,planoptioncd:planoptioncd}, 
                        success:function(premium){
                            
                            $('#getpremium'+nid).replaceWith('<div id="getpremium'+nid+'"><b>'+premium+'</b></div>');
                            
                        }
                          
                        });
                     });
                
                });
            $('.oneyars').each(function(){
                
                 $(this).click(function(){
                       
                     var id=$(this).attr('id');
                     var id_sep=id.split("_");
                     var tenureVal =id_sep[2];
                     if(tenureVal==1){
                        var year_str='YEAR';
                     }else{
                        var year_str='YEARS';
                     }
                        $("#replace_"+id_sep[1]).text(tenureVal+' '+year_str);
                     });
                });
            $('.oneyars1').each(function(){
                 $(this).click(function(){
                    
                     var nid= $(this).attr('id');
                     var siVal = $('#'+nid).text();
                     
                     var sum_spilt = siVal.split(":");
                     var sumInsuredVal = parseInt(sum_spilt[0]);
                     var planid_sp=nid.split("_");
                     
                     $('#plan_option_code_'+planid_sp[1]).text(sum_spilt[1]);
                     //$('#replacesi_'+planid_sp[1]).replaceWith('<span id="replacesi">'+sumInsuredVal+'</span>');
                     $('#replacesi_'+planid_sp[1]).text(sumInsuredVal);
                     
                 });
                
                });
            $('.getQuote1').each(function(){
                
                 $(this).click(function(){
                     var nid= $(this).attr('id');
                     
                     var tenureVal = $("#selectedyear").text();
                     var tenureVal = parseInt(tenureVal);
                     
                     var siVal = $("#replacesi_"+nid).text();
                     var sumInsuredVal = parseInt(siVal);
                     
                     var planId = $("#planId"+nid).val();
                     var planoptioncd=$('#plan_option_code_'+nid).text();
                     
                     var qid=$("#plan_quote_id"+nid).val();
                    // alert(tenureVal+' '+sumInsuredVal+' '+planId + ' ' + planoptioncd);
                     $.ajax({
                        url:Drupal.settings.basePath+"plans/ajax/sum_insured",
                        beforeSend: function() { $('#getpremium'+nid).text('Loading.....')},
                        type:"POST",
                        data: {ajax:1,tenure:tenureVal,sumInsured:sumInsuredVal,planId:planId,planoptioncd:planoptioncd,qid:qid}, 
                        success:function(premium){
                            
                                $('#getpremium'+nid).replaceWith('<div id="getpremium'+nid+'"><b>'+premium+'</b></div>');
                            }
                          
                        });
                     });
                
                });
            $('.adAddon').each(function(){
                
                 $(this).click(function(){
                    
                        var quote_id=$("input[id=quote_id]").val();
                        var addId= $(this).attr('id');
                        var optionId = addId.split('-');
                        var optionId = optionId['1'];
                        
                        var sumInsuredVal = $('input[id=sumInsured]').val();
                        var planIdval = $('input[id=planId]').val();
                        
                        
                        
                     $.ajax({
                        
                        url:Drupal.settings.basePath+"plans/get-base-premium/add",
                         
                        beforeSend: function() { $('#premium_value').text('Loading.....')},
                        type:"POST",
                        data: {quote_id:quote_id,ajax:1,tenure:1,adAddon:1,oId:optionId,sumInsured:sumInsuredVal,planId:planIdval}, 
                        success:function(premium){
                               
                            $('#premium_value').text(premium);
                            $('#'+addId).hide();
                            $("#removeAddon-"+optionId).show();
                        }  
                        });
                     });
            });
            $('.rmAddon').each(function(){
                
                 $(this).click(function(){
                    
                        var quote_id=$("input[id=quote_id]").val();
                        var rmId= $(this).attr('id');
                        var optionId = rmId.split('-');
                        var optionId = optionId['1'];
                        var sumInsuredVal = $('input[id=sumInsured]').val();
                        var planIdval = $('input[id=planId]').val();
                     $.ajax({
                        
                        url:Drupal.settings.basePath+"plans/get-base-premium/add",
                        
                        beforeSend: function() { $('#premium_value').text('Loading.....')},
                        type:"POST",
                        data: {quote_id:quote_id,ajax:1,tenure:1,rmAddon:1,oId:optionId,sumInsured:sumInsuredVal,planId:planIdval}, 
                        success:function(premium){
                              
                            $('#premium_value').text(premium);
                           $('#'+rmId).hide();
                           $("#addAddon-"+optionId).show();
                            }  
                        });
                     }); 
            });
    });
})(jQuery);