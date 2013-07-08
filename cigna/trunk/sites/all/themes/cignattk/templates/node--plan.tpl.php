<?php
/**
 * @file
 * Bartik's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
 
 //dpr($_SESSION);exit;
 //dpr($node);exit;
 global $user,$product_conf;
 
 if(isset($_SESSION['quick_quote']['quote_no']) && !empty($_SESSION['quick_quote']['quote_no'])){
    
    $quote_id=$_SESSION['quick_quote']['quote_no'];
    $init_quote_no=quote_details_by_id($quote_id);
       
 }else if(isset($_GET['quote_id'])){
    
    $quote_id=$_GET['quote_id'];
    $init_quote_no=quote_details_by_id($quote_id);
    
    $set_qut_no=db_select('get_quote','q')
                ->fields('q',array('initial_quote_no'))
                ->condition('q.qid',$quote_id)
                ->execute()->fetchField();
                
    $_SESSION['quick_quote']['quote_no']=$quote_id;
    $_SESSION['quick_quote']['initial_quote_no']=$set_qut_no;
    
 }
  if(!empty($init_quote_no['finalpremium'])){
    
    $finalPremium=$init_quote_no['finalpremium'];
  }else{

    $finalPremium=$init_quote_no['basepremium'];
  }
  
 $final_quote=db_select('get_quote','q')
            ->fields('q',array('final_quote_no'))
            ->condition('q.qid',$quote_id)
            ->execute()->fetchField();
            
 if(empty($final_quote)){
    
         if(isset($_SESSION['quick_quote'])){
         
            $_SESSION['quick_quote']['planId']=$node->nid;
            $result=quote_details($_SESSION['quick_quote']['initial_quote_no']);
                        
            if(!empty($result)){
                
                    // Function Defined for fetching all addons related to plan options
                    $quote_addons=addons_details($result['entity_id'],3);
                    
                    if(!empty($quote_addons)){
                    
                           foreach($quote_addons as $key=>$addon){
                                  
                                $add[$key]=array(
                                    'basePremium'=>'',
                                    'discount'=>'',
                                    'extraPremium'=>'',
            						'productId'=>$addon->productId,
            						'productPlanOptionCd'=>$addon->plan_option_cd,
                                    'sumInsured'=>'',
                                );
                           }
                    }        
                    $location=location_details($result['city_id']);
                    if(!empty($location)){
                        $location_value=$location['city_name'];
                        $zone_value=strtoupper($location['zone']);
                    }
                    $insuredDob=date('d/m/Y',$result['dob']);
                    
                    $quote_details=array(
                        'WSQuotationListIO'=>array(
                            'listofquotationTO'=>array(
                                'quotationProductDOList'=>array(
                                    'basePremium'=>'',
                                    'discount'=>'',
                                    'extraPremium'=>'',
                                    'productId'=>$result['productId'],
                					'productPlanOptionCd'=>$result['productPlanOptionCd'],
                					'productTypeCd'=>'SUBPLAN',
                                    'productVersion'=>1,
                					'sumInsured'=>$result['sum_insured'],
                                    'zoneCd'=>'',
                                    'quotationProductInsuredDOList'=>array(
                                        'chewTobaccoCd'=>'NO',
                						'cityCd'=>!empty($location_value) ? $location_value : '',
                                        'consumeAlcoholCd'=>'No',
                                        'discount'=>'',
                						'dob'=>!empty($insuredDob) ? $insuredDob : '',
                                        'emailAddress'=>!empty($result['email_id']) ? $result['email_id'] : '',
                                        'extraPremium'=>'',
                						'genderCd'=>!empty($result['gender']) ? $result['gender'] : 'MALE',
                						'insuredTypeCd'=>'PRIMARY',
                                        'issueAge'=>'',
                                        'mobileNum'=>!empty($values['phone_val']) ? $values['phone_val'] : '',
                                        'modalPremium'=>'',
                						'relationCd'=>'SELF',
                                        'quotationProductInsuredBenefitDOList'=>array(
                                            'amount'=>'',
                                            'benefitId'=>'',
                                            'benefitTypeCd'=>'',
                                            'productId'=>'',
                                        ),
                                        'smokerStatusCd'=>'NO',
                                        'zoneCd'=>!empty($zone_value) ? $zone_value : 'ZONE1',
                					),
                                    'quotationProductAddOnDOList'=>$add,
                                    'quotationProductBenefitDOList'=>array(
                                        'amount'=>'',
                                        'benefitId'=>'',
                                        'benefitTypeCd'=>'',
                                        'productId'=>'',
                                    ),
                                    'quotationProductChargeDOList'=>array(
                                        'chargeAmount'=>'',
                                        'chargeClassCd'=>'',
                                        'chargePercentage'=>'',
                                    ),
                                ),
                                'agentId'=>$result['agentId'],
                                'campaignCd'=>$result['campaignCd'],
                				'channelId'=>$result['channelId'],
                				'noOfAdults'=>$result['no_adults'],
                				'noOfKids'=>$result['no_childs'],
                				'parentProductId'=>$result['parentProductId'],
                                'parentProductVersion'=>$result['parentProductVersion'],
                                'policyType'=>$result['policyType'],
                                'productFamilyId'=>$result['productFamilyId'],
                                'productId'=>$result['productId'],
                                'productPlanOptionCd'=>$result['productPlanOptionCd'],
                                'quotationDt'=>$result['quotationDt'],
                                'quoteTypeCd'=>'FINAL',
                				'saveFl'=>'YES',
                				'tenure'=>1,
                            )
                        )
                    );
                   
                    $response_service = $product_conf->getQuote('compute',$quote_details);    
                    
                        if(!empty($response_service)){
                            
                                $response=$response_service->return->listofquotationTO;
                                if(!empty($response->quoteId)){
                                    
                                    $_SESSION['quick_quote']['final_quote_no']=$response->quoteId;
                                    
                                } 
                             unset($_SESSION['adddon_request']);
                             $addon_response=$response_service->return->listofquotationTO->quotationProductDOList->quotationProductAddOnDOList;
                    
                                if(is_object($addon_response) && !empty($addon_response)){
                                    
                                        db_update('quote_addons')
                                         ->fields(array(
                                                
                                                'basePremium'=>$addon_response->basePremium,
                                                'discount'=>$addon_response->discount,
                                                'extraPremium'=>$addon_response->extraPremium,
                                                'productId'=>$addon_response->productId,
                                                'productPlanOptionCd'=>$addon_response->productPlanOptionCd,
                                                'sumInsured'=>$addon_response->sumInsured,
                                         ))
                                         ->condition('initial_quote_no',$result['initial_quote_no'])
                                         ->execute();
                                         
                                }else if(is_array($addon_response) && !empty($addon_response)){
                                    
                                    foreach($addon_response as $value){
                                        
                                        db_update('quote_addons')
                                         ->fields(array(
                                                'basePremium'=>$value->basePremium,
                                                'discount'=>$value->discount,
                                                'extraPremium'=>$value->extraPremium,
                                                'productId'=>$value->productId,
                                                'productPlanOptionCd'=>$value->productPlanOptionCd,
                                                'sumInsured'=>$value->sumInsured,
                                         ))
                                         ->condition('initial_quote_no',$result['initial_quote_no'])
                                         ->execute();
                                }
                            }
                        }
                    
                }
         }
    }
 
 if(isset($_SESSION['no_of_quotes'])){
    
    $quote_no=$_SESSION['quick_quote']['quote_no'];
    $_SESSION['no_of_quotes'][$quote_no]['planId']=$node->nid;
    $_SESSION['no_of_quotes'][$quote_no]['flag']=1;
        
 }
 
?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript">
  $(function(){
    $( "#accordion3,#accordion4,#accordion,#accordion_ridders,#accordion_ridder_data,#accordian_ridder_attribute_126,#accordian_ridder_attribute_127,#accordian_ridder_attribute_128,#accordian_ridder_attribute_options_3" ).accordion({
      collapsible: true,
      heightStyle: "content"
    });
  });
</script> 
     
<?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
<?php endif; ?>
<?php if(isset($_SESSION['show_all_plans'])){  ?>
<div class='modify_plans'>
                         <?php echo l('CALCULATE PREMIUM','quote/suggestion/details',array('attributes'=>array('class'=>array('show_calculate_premium')))); ?>
                         <?php
                         // Menu defined in quick_quotation module for comparing plans.
                        // echo l('COMPARE','plans/compare',array('attributes'=>array('class'=>array('compare_plans')))); ?>   
    </div>   
<?php   } ?>
<?php if(isset($init_quote_no['entity_id'])){
    
    $attributes = get_plans_attributes(NULL,$init_quote_no['entity_id']);    
}  
 ?>
<div style="border: 1px #000 solid;height:400px;padding: 38px;">
    <div class="left" style="float: left;width: 506px;">
        <input id="quote_id" type="hidden" value="<?php echo $quote_id; ?>"/>
        <img src="<?php echo file_create_url($node->uc_product_image['und']['0']['uri']);?>"/>
        
        <?php if(!isset($_SESSION['show_all_plans'])){  ?>
        
            <?php if(!empty($init_quote_no['no_adults']) && isset($init_quote_no['no_childs'])):?>
        <div style="float: right;margin-top: 12px;">
            <ul><li>ADULTS <b><?php echo $init_quote_no['no_adults']?></b> CHILD <b><?php echo $init_quote_no['no_childs']?></b></li>
            <li>TERM: <b><?php echo (isset($init_quote_no['tenure'])) ? $init_quote_no['tenure'] : '1'?></b> YEARS</li>
            <li>SUM INSURED: Rs. <b><?php echo number_format($init_quote_no['sum_insured'])?></b></li></ul>
        </div>
        <input type="hidden" id="sumInsured" name="sumInsured" value="<?php echo ($init_quote_no['sum_insured']/100000)?>"/>
        <input type="hidden" id="planId" name="planId" value="<?php echo $node->nid;?>"/>        
        <?php endif;?>
            
        <?php  } ?>
        
        <hr />
        
    </div>
    <div class="right" style="float: right;">
            <span>Medical tests are compulsory if<br />
                    above 60 years and opted<br />
                    above 4 lakhs</span>
            <div class="viewd" style="height:200px"><a href="#" class="big-link" data-reveal-id="myModal13" data-animation="none">EXPERT'S VIEW</a></div>
            <?php if(!isset($_SESSION['show_all_plans'])){  ?>
                
                <?php // if(!empty($finalPremium)):?>
                <div id="premium"><b>PREMIUM:Rs.  <?php echo number_format($finalPremium); ?></b></div>
                
                <?php // endif;?>
                <?php if(!empty($finalPremium)):
                     echo  l("Buy Now","complete/application");
                ?>
                <?php else:
                     //echo  l("Buy Now","complete/application"); ?>
                <?php endif?>
            <?php }else{
                     echo  l("Buy Now","quote/suggestion/details");
            } ?>        
    </div>
</div>
<div style="clear: both;"></div>
<?php 

foreach($attributes as $attribs):?>
<div id="accordion">
    <h3><?php echo $attribs['label']?></h3>
        
        <?php  if($attribs['label'] == 'ADD-ONS'){
            
                    $options = addons_details($init_quote_no['entity_id'],$attribs['aid']);
                    
                }else if($attribs['label'] == 'KEY FEATURES'){
                    
                    $options=get_plans_attributes_options(NULL,$node->nid,$attribs['aid']);   
                }
                     
         ?>
            <div id="accordion<?php echo $attribs['aid'];?>">
                <?php foreach($options as $option): 
                            
                            $option=(array)$option;
                            $add_premium=addon_premium($option['productId'],$init_quote_no['initial_quote_no']);
                            
                            $add_premium=addon_premium($option['productId'],$init_quote_no['initial_quote_no']);
                 ?>
                  <h3><?php echo $option['name'];?></h3>
                  <div>
                    <p><?php /*echo $option['description']; */?>Lumpsum payment - 100% of Basic Sum Insured Opted</p>
                    <?php if(!empty($finalPremium)):?>
                    <?php if($attribs['label'] == 'ADD-ONS'):?>
                        <div style="float: right;margin-top: -22px;">
                                
                                <?php  $addon=db_select('quote_stored_addon','a')
                                            ->fields('a')
                                            ->condition('a.initial_quote_no',$init_quote_no['initial_quote_no'])
                                            ->condition('a.oid',$option['productId'])
                                            ->execute()->fetchAssoc();
                                            
                                       if(!empty($addon)){
                                        
                                           $addstyle="display:none;font-family: bold;color: green;";
                                           $removestyle="display:block;font-family: bold;color: red;";
                                              
                                       }else{
                                        
                                            $addstyle="display:block;font-family: bold;color: green;";
                                            $removestyle="display:none;font-family: bold;color: red;";
                                        
                                       } 
                                 ?>
                                 <span>Rs.<?php echo $add_premium['basePremium']; ?></span>

                                 <?php if(!isset($_SESSION['show_all_plans'])){  ?>
                                    <a href="javascript:void(0);" style="<?php echo $addstyle; ?>" class="adAddon" id="addAddon-<?php echo $option['productId'];?>">ADD</a> 
                                    <a href="javascript:void(0);" style="<?php  echo $removestyle; ?>" class="rmAddon" id="removeAddon-<?php echo $option['productId'];?>">REMOVE</a>
                                <?php } ?>
                        </div>
                    <?php else:?>
                        <div style="float: right;margin-top: -22px;"><span style="font-family: bold;color: gray;"  id="addAddon-<?php echo $option['productId'];?>">INCLUDED</span></div>
                    <?php endif;?>
                    <?php endif;?>
                  </div>
                <?php endforeach;?>
            </div>
</div>
<?php endforeach;?>

<?php

    // Fetching the Ridders associated with Plan
    if(!empty($node->field_plan_ridders['und'])){       
            foreach($node->field_plan_ridders['und'] as $plan_ridders){
                //dpr($sub_ridders);exit;
                $plan_rider[]=$plan_ridders['target_id'];
            }    
    }
    /*
    // Fetching the Ridders associated with Sub-Plans
    foreach($sub_plan_ids as $id){
        
        $sub_node=node_load($id);
        if(!empty($sub_node->field_sub_plan_riders['und'])){
            
            foreach($sub_node->field_sub_plan_riders['und'] as $sub_ridders){
                //dpr($sub_ridders);exit;
                $ridders[]=$sub_ridders['target_id'];
            }    
        }  
    }*/
    if(isset($plan_rider) && !empty($plan_rider)){ ?>

    <div id="accordion_ridders">
        <h3>Ridders</h3>
        <div id="accordion_ridder_data">
        <?php foreach($plan_rider as $ridder){
            
            $ridder_node=node_load($ridder);   ?>
            
                    <h3><?php echo $ridder_node->title; ?></h3>
                    <?php  if(isset($ridder_node->attributes)  && !empty($ridder_node->attributes)){  ?>
                              
                                <div id="accordian_ridder_attribute_<?php echo $ridder_node->nid; ?>">
                             <?php  foreach($ridder_node->attributes as $key=>$ridder_attr){  //dpr($key);exit; ?>
                                        
                                        <h3><?php echo $ridder_attr->name; ?></h3>
                                        
                                        <?php if(isset($ridder_attr->options) && !empty($ridder_attr->options)){  ?>
                                             
                                                <div id="accordian_ridder_attribute_options_<?php echo $key; ?>">
                                               <?php  foreach($ridder_attr->options as $key=>$ridder_attr_options){ //dpr($key);exit; ?>
                                                     
                                                        <h3><?php echo $ridder_attr_options->name;  ?></h3>
                                                        <div>Lumpsum payment - 100% of Basic Sum Insured Opted</div>  
                                                      
                                        <?php  } ?></div>
                             <?php } ?>
                                
                     <?php  } ?></div>
        <?php } } ?>
        </div>   
    </div>    
   <?php }
?>
<?php unset($_SESSION['show_all_plans']); ?>
<div id="myModal13" class="reveal-video-modal"><?php //print render_video($node->field_plan_video[und][0]['uri'],960,400);?><a class="close-reveal-modal"><img src="sites/all/themes/cigna_ttk_2/images/closed.png" /></a></div>
