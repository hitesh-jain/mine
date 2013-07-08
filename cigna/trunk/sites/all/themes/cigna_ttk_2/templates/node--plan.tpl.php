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
 
// dpr($_SESSION);
 //dpr($node);exit;
 
 global $user,$product_conf,$theme;
       
 if($user->uid==0){
        
        if(isset($_SESSION['guestuser'])){
        
            $guestuser=$_SESSION['guestuser'];
         }
    }
       
 if(isset($_GET['quote-id']) && isset($_GET['plan-id'])){
    
    
    /*
    $quote_id=$_GET['quote_id'];
    $init_quote_no=quote_details_by_id($quote_id);
    
    $set_qut_no=db_select('get_quote','q')
                ->fields('q',array('initial_quote_no'))
                ->condition('q.qid',$quote_id)
                ->execute()->fetchField();
                
    $_SESSION['quick_quote']['quote_no']=$quote_id;
    $_SESSION['quick_quote']['initial_quote_no']=$set_qut_no;*/
    
    
    $quote_data=db_select('get_quote','q')
            ->fields('q')
            ->condition('initial_quote_no',$_GET['quote-id'])
            ->condition('planid',$_GET['plan-id'])
            ->execute()->fetchAssoc();
            
      if($quote_data){

            $_SESSION['quick_quote']=array(
                'uid'=>$quote_data['uid'],
                'sid'=>$quote_data['sid'],
                'initial_quote_no'=>$quote_data['initial_quote_no'],
                'no_adults'=>$quote_data['no_adults'],
                'no_childs'=>$quote_data['no_childs'],
                'region'=>$quote_data['city_id'],
                'sum_insured'=>$quote_data['sum_insured'],
                'gender'=>$quote_data['gender'],
                'dob'=>$quote_data['dob'],
                'hd_option'=>$quote_data['hd_option'],
                'hd_option_price'=>$quote_data['hd_option_price'],
                'quote_no'=>$quote_data['qid'],
                'created'=>$quote_data['created'],
                'modify'=>$quote_data['modify'],
                'tenure'=>$quote_data['tenure'],
                'initial_basePremium'=>$quote_data['basePremium'],
                'total_premium'=>$quote_data['total_premium'],
                'planid'=>$quote_data['planid'],
                
            );
        $quote_id=$_SESSION['quick_quote']['quote_no'];
        $init_quote_no=quote_details_by_id($quote_id); 
        
      }
    }
    
  if(!empty($init_quote_no['finalpremium'])){
    
    $finalPremium=$init_quote_no['finalpremium'];
  }else{

    $finalPremium=$init_quote_no['total_premium'];
  }
  
         if(isset($_SESSION['quick_quote'])){
         
            //$result=quote_details($_SESSION['quick_quote']['initial_quote_no']);
            $result=quote_details_by_id($init_quote_no['qid']);
            
            if(!empty($result)){
                
                    $stored_addon=db_select('quote_addons','q')
                                    ->fields('q')
                                    ->condition('q.qid',$result['qid'])
                                    ->execute()->fetchAssoc();
                if(empty($stored_addon)){
                    
                    // Function Defined for fetching all addons related to plan options
                    $quote_addons=addons_details($result['entity_id'],3);
                    
                    $addon_count=0;
                    if(!empty($quote_addons)){
                    
                           foreach($quote_addons as $key=>$addon){
                    
                                 $addon_count++;             
                                $add[$key]=array(
                                    'basePremium'=>'',
                                    'discount'=>'',
                                    'extraPremium'=>'',
            						//'productId'=>$addon->productId,
                                    'productId'=>$addon->productId,
                                    //'productId'=>'CI1LACFMLY',
            						'productPlanOptionCd'=>$addon->productid,
                                    'sumInsured'=>'',
                                );
                           }
                    }
                    
                    $location=location_details($result['city_id']);
                    if(!empty($location)){
                        $location_value=$location['city_name'];
                        $zone_value=strtoupper($location['zone']);
                    }
                    
                    
                    $people_details=quote_people_details($_SESSION['quick_quote']['quote_no']);
                    
                    
                    if(!empty($people_details)){
                        
                        foreach($people_details as $key=>$people_detail){
                                       
                           $gender=empty($people_detail->gender)  ?  'MALE' : 'FEMALE';
                                  
                            if(!empty($people_detail->tobacco)){
                    
                                $tobacco=_plan_consumption('tobacco',$people_detail->tobacco_consumption);
                            }else{
                                $tobacco='NO';    
                            }
                        
                            if(!empty($people_detail->alcohol)){
                    
                                $alcohol=_plan_consumption('alcohol',$people_detail->alcohol_consumption);
                            }else{
                                $alcohol='NO';   
                            }
                            if(!empty($people_detail->cigarette)){
                                
                                $cigarette=_plan_consumption('cigarette',$people_detail->cigarette_consumption);
                            }else{
                                $cigarette='NO';    
                            }
                              $relation=_plan_relation_value($people_detail->people_type,$people_detail->ordering);    
                              $insuredDob=date('d/m/Y',$people_detail->dob);
                                $people_data[$key]=array(
                                    
                                        'chewTobaccoCd'=>$tobacco,
                						'cityCd'=>!empty($location_value) ? $location_value : '',
                                        'consumeAlcoholCd'=>$alcohol,
                                        'discount'=>'',
                						'dob'=>!empty($insuredDob) ? $insuredDob : '',
                                        'emailAddress'=>!empty($result['email_id']) ? $result['email_id'] : '',
                                        'extraPremium'=>'',
                						'genderCd'=>$gender,
                						'insuredTypeCd'=>'PRIMARY',
                                        'issueAge'=>'',
                                        'mobileNum'=>!empty($values['phone_val']) ? $values['phone_val'] : '',
                                        'modalPremium'=>'',
                						'relationCd'=>isset($relation) && !empty($relation) ? $relation : '',
                                        'quotationProductInsuredBenefitDOList'=>array(
                                            'amount'=>'',
                                            'benefitId'=>'',
                                            'benefitTypeCd'=>'',
                                            'productId'=>'',
                                        ),
                                        'smokerStatusCd'=>$cigarette,
                                        'zoneCd'=>!empty($zone_value) ? $zone_value : 'ZONE1',
                                );
                           }
                    }
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
                                    'quotationProductInsuredDOList'=>$people_data,
                                    
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
                				'saveFl'=>'No',
                				'tenure'=>$result['tenure'],
                            )
                        )
                    );
                     //dpr($quote_details);
                    try{
                        $response_service = $product_conf->getQuote('compute',$quote_details);
                     }catch(Exception $e){
                        return 'Service Not available';
                    }
                     //dpr($response_service);exit;
                     
                        if(!empty($response_service)){
                            
                                $response=$response_service->return->listofquotationTO;
                                
                             unset($_SESSION['adddon_request']);
                             $addon_response=$response_service->return->listofquotationTO->quotationProductDOList->quotationProductAddOnDOList;
                    
                                if(is_object($addon_response) && !empty($addon_response)){
                                    
                                        db_insert('quote_addons')
                                         ->fields(array(
                                                'basePremium'=>$addon_response->basePremium,
                                                'discount'=>$addon_response->discount,
                                                'extraPremium'=>$addon_response->extraPremium,
                                                'productId'=>$addon_response->productId,
                                                'productPlanOptionCd'=>$addon_response->productPlanOptionCd,
                                                'sumInsured'=>$addon_response->sumInsured,
                                                'qid'=>$result['qid'],
                                         ))
                                         //->condition('qid',$result['qid'])
                                         ->execute();
                                         
                                }else if(is_array($addon_response) && !empty($addon_response)){
                                    
                                    foreach($addon_response as $value){
                                        
                                        db_insert('quote_addons')
                                         ->fields(array(
                                                'basePremium'=>$value->basePremium,
                                                'discount'=>$value->discount,
                                                'extraPremium'=>$value->extraPremium,
                                                'productId'=>$value->productId,
                                                'productPlanOptionCd'=>$value->productPlanOptionCd,
                                                'sumInsured'=>$value->sumInsured,
                                                'qid'=>$result['qid'],
                                         ))
                                         //->condition('qid',$result['qid'])
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
     
<?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
<?php endif; ?>
<?php if(isset($_SESSION['show_all_plans'])){  ?>
<div class='modify_plans'>
                         <?php echo l('CALCULATE PREMIUM','quote/suggestion/details',array('attributes'=>array('class'=>array('show_calculate_premium big-link')))); ?>
                         <?php
                         // Menu defined in quick_quotation module for comparing plans.
                        // echo l('COMPARE','plans/compare',array('attributes'=>array('class'=>array('compare_plans')))); ?>   
    </div>   
<?php   } ?>
<?php $attributes = array();?>
<?php if(isset($init_quote_no['entity_id'])){
    
    $attributes = get_plans_attributes(NULL,$init_quote_no['entity_id']);
}    
 ?>
 
 <?php
  
    global $theme;
   // drupal_add_css(drupal_get_path('module','theme').'/css/css_accord/menu_a_style.css');
    //drupal_add_js(drupal_get_path('module','news_media').'/js/jquery-1.9.1.js');
    drupal_add_js(drupal_get_path('module','news_media').'/js/jquery.nestedAccordion.js');
    drupal_add_js(drupal_get_path('module','news_media').'/js/news_media.js');
 
 ?>
<div class="thankyoupay planaddons">

        <article>
        <div class="calculatepremium" style="width:75%;">
            <section>
                
           
           <div class="IPMISilver1">
            <aside> 
            <?php if($node->uc_product_image['und']['0']['uri']):?>
                <img src="<?php echo file_create_url($node->uc_product_image['und']['0']['uri']);?>" width="230" height="94" alt=""/> <span>A CUSTOMIZABLE HOSPITALIZATION PLAN</span>
            <?php else:?>
            <img src="<?php  echo url(drupal_get_path('theme',$theme)); ?>/images/plan.png" width="231" height="95" alt=""/>
            <?php endif;?>
            
        
            <?php if(!isset($_SESSION['show_all_plans'])){  ?>
                <?php if(!empty($init_quote_no['no_adults']) && isset($init_quote_no['no_childs'])){?>
                    
                 <dd>
                    <ul>
                        <li><?php echo $init_quote_no['no_adults'];?> ADULT, <?php echo $init_quote_no['no_childs']?> CHILDREN</li>
                        <li><span>TERM</span> <?php echo (isset($init_quote_no['tenure'])) ? $init_quote_no['tenure'] : ''?> YEAR</li>
                        <li><span>SUM INSURED</span> RS. <?php echo number_format($init_quote_no['sum_insured'])?></li>
                    </ul>
                </dd>
                <input type="hidden" id="sumInsured" name="sumInsured" value="<?php echo ($init_quote_no['sum_insured']/100000)?>"/>
                <input type="hidden" id="planId" name="planId" value="<?php echo $node->nid;?>"/>
            <?php } } ?>
        
            </aside>
            </div>
        
        
        <div class="IPMISilver1 mid">
                <aside class="mid">
                      <h4>KEY FEATURES</h4>
                      <div class="iconkey">
                      
                      <?php    $key_features=plan_images($node->nid,'KEY FEATURES');  
                                    if($key_features){
                                        
                                        foreach($key_features as $feature){  if ($feature->icon_name){ ?>
                                            
                                         <img src="<?php echo url(drupal_get_path('theme',$theme)) ?>/images/<?php  echo $feature->icon_name; ?>" width="17" height="17" alt=""/>
                                         
                    <?php  } } } ?>
                      </div>
                      
                      <div class="iconkeylink"><a href="#">> View all features</a></div>
                      <h4>SELECTED ADD-ONS</h4>
                           <div class="iconkey">
                           </div>
                      	<div class="iconkeylink1"><a href="#" data-reveal-id="myModal13" data-animation="none" class="selectvideo"><img src="<?php echo url(drupal_get_path('theme',$theme)) ?>/images/ex.png" width="14" height="17" alt=""/>&nbsp;&nbsp;EXPERT'S VIEW</a></div>
                </aside>
                </a>
                </div>
                 <div class="IPMISilver1 last">
                <aside class="last">
                    <div class="immedi"><img src="<?php echo url(drupal_get_path('theme',$theme)) ?>/images/meditest.png" width="15" height="15" alt=""/></div>
               		 <p>Medical tests are compulsory if above 60 years and opted above 4 lakhs</p>
                     <!--
                     	<ul>
                        	<li>SI RESTORATION <span>0</span></li>
                            <li>MATERNITY WP<span>0</span></li>
                            <li>POLICY DEDUCTIBLE<span>0</span></li>
                            
                        </ul> -->
                        <?php if(!isset($_SESSION['show_all_plans'])){  ?>
                  		<div class="premium">
                        	<span>PREMIUM</span>
                            <div class="buynowd">
                            <img src="<?php echo url(drupal_get_path('theme',$theme)) ?>/images/rupes_sing.png" width="12" height="15" alt="" style="vertical-align:baseline; padding-right:5px;"/>
                           <div id="premium_value"><?php echo number_format($finalPremium); ?></div>
                            </div>
                        </div>

                        <?php                        
                        if(!empty($finalPremium)){ ?>
                            <a href="complete/application" class="linkbuttonclass" style="float: right; margin-top: 10px;">Buy Now</a>
                        <?php }else{ ?>
                             <!-- <a href="complete/application" class="linkbuttonclass" style="float: right; margin-top: 10px;">Buy Now</a> -->
                        <?php }?>
                        <?php }else{ ?>
                                <!-- <a href="quote/suggestion/details" class="linkbuttonclass" style="float: right; margin-top: 10px;">Buy Now</a> -->
                       <?php  } ?>
                </aside>
                </div>
                 </section>
                 </div>
        </article>
        <input id="quote_id" type="hidden" value="<?php echo $quote_id; ?>"/>
        <div class="IPMISilver1left">
        <aside>
           <h5><?php if($addon_count){
                echo $addon_count;
           }else{
                echo 'No';
            
           }  ?> ADD-ONS AVAILABLE</h5>
           <p>These plans are designed for giving maximum benefit under the sum insured lorem ipsum dolor sit amet nunc justo. Avec pharetra nunc biendum lorem.</p>
           <?php if($addon_count){ ?>
                <a href="#">> View all add-ons</a>?>
            <?php  } ?>
           
           <div class="addone">
           	<ul>
            	<li><a href="#">DOWNLOAD BROCHURE</a></li>
                <li><a href="#">DOWNLOAD FORMS</a></li>
                <li><a href="#">MAIL TO FRIEND</a></li>
                <li><a href="#">SHARE</a></li>
                <li><a href="#">PRINT</a></li>
            </ul>
           </div>
       </aside>
       </div>
    </div>
    
<div class="planaddonslist">
<ul id="acc1" class="accordion">
    <li>
        <h4 class="h"><a class="trigger" href="#">DESCRIPTION</a><span>A SHORT NOTE ON THIS PLAN</span></h4>
            <div class="outer12" style="display: block;">
                <div class="inner" style="">
                    <?php echo $node->body['und']['0']['value']?>
                </div>
            </div>
    </li>
<?php

    $attributes[]=array( 'nid' =>$node->nid,
		                 'aid' => 4,
		                 'label'=>'KEY FEATURES',
                );
        
foreach($attributes as $attribs): $class="open"; $outer_class="shown";  ?>
    <li>
    <?php  if($attribs['label'] == 'ADD-ONS'){
                        
                                $options = addons_details($init_quote_no['entity_id'],$attribs['aid']);   
                            }else if($attribs['label'] == 'KEY FEATURES'){
                                
                                $options=get_plans_attributes_options(NULL,$node->nid,$attribs['aid']);
                            }
        if($options){ ?>
        
        <h4 class="h"><a class="trigger" href="#"><?php echo $attribs['label']?></a><span>CUSTOMIZE YOUR PLAN WITH THESE ADD-ONS</span></h4>
            <div class="outer12" style="display: block;">
                <div class="inner" style="">
                
                    
                    <ul>
                    <?php foreach($options as $option):
                    
                            $option=(array)$option;
                            
                            $add_premium=addon_premium($option['productId'],$init_quote_no['qid']);
                            
                     ?>
                        <li><?php  $addon=db_select('quote_stored_addon','a')
													->fields('a')
													->condition('a.qid',$init_quote_no['qid'])
													->condition('a.oid',$option['productId'])
													->execute()->fetchAssoc();?>
                            <?php if(!empty($addon)){
									   $addstyle="display:none;font-family: bold;color: green;";
									   $removestyle="display:block;font-family: bold;color: red;"; 
								   }else{
										$addstyle="display:block;font-family: bold;color: green;";
										$removestyle="display:none;font-family: bold;color: red;";
								   } 
							 ?>
                           <h5 class="h"><a class="trigger" href="#">
							<?php echo $option['name']; ?></a><?php if($attribs['label'] == 'ADD-ONS'):?>
                                                        <div class="includename">                    
                                                              <?php if(!empty($addon)){
                                                                   $addstyle="display:none;";
                                                                   $removestyle="display:block;"; 
                                                               }else{
                                                                    $addstyle="display:block;";
                                                                    $removestyle="display:none;";
                                                               } 
                                                         ?>   
                                                         <?php  if(!empty($finalPremium)){ ?>
                                                        	<?php if(!isset($_SESSION['show_all_plans'])){  ?>
                                                                <a href="javascript:void(0);" style="<?php echo $addstyle; ?>" class="adAddon" id="addAddon-<?php echo $option['productId'];?>">ADD</a> 
                                                                <a href="javascript:void(0);" style="<?php  echo $removestyle; ?>" class="rmAddon" id="removeAddon-<?php echo $option['productId'];?>">REMOVE</a>    
                                                        <?php } ?>
                                                        <?php  } ?>
                                                        </div>
                                            <?php else: ?>
                                                        <div class="includename"><span id="addAddon-<?php echo $option['productId'];?>">INCLUDED</span></div>
                                        
                                    <?php endif;?>
                           </h5> 
                                <div class="outer" style="display: block;">
                                    <div class="inner" style="">
                                        
                                        <p>
                                            <?php if(isset($option['description'])):?>
                                                <?php echo $option['description'];?>
                                            <?php endif;?>
                                                <?php if($attribs['label'] == 'ADD-ONS'):?>
                                                        <div>                    
                                                              <?php if(!empty($addon)){
                                                                   $addstyle="display:none;font-family: bold;color: green;";
                                                                   $removestyle="display:block;font-family: bold;color: red;"; 
                                                               }else{
                                                                    $addstyle="display:block;font-family: bold;color: green;";
                                                                    $removestyle="display:none;font-family: bold;color: red;";
                                                               } 
                                                         ?>   
                                                         <?php  // if(!empty($finalPremium)){ ?>
                                                         <span class="pricelistdetails"><b>Additional cost: <img src="<?php echo url(drupal_get_path('theme',$theme)) ?>/images/rupes_sing.png" width="12" height="13" alt="" style="vertical-align:baseline; padding-right:5px;"/>&nbsp;<?php echo number_format($add_premium['basePremium']); ?></b></span>
                                                        <?php // } ?>
                                                        </div>
                                            <?php else: ?>
                                                        
                                    <?php endif;?>
                                        </p>
                                   </div>  
                                </div>
                           </li> 
                          <?php endforeach;?>  
                        </ul>
                </div></div>
            </li> 
      <?php } ?>      
<?php endforeach;?>
</ul>
</div>
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
<?php if(isset($node->field_plan_video['und'][0]['uri'])):?>
    <div id="myModal13" class="reveal-modal videoplaydata"><?php //print render_video($node->field_plan_video['und'][0]['uri'],650,350);?><a class='close-reveal-modal' id="closemodel"><img src="sites/all/themes/cigna_ttk_2/images/closed.png" /></a></div>
<?php endif;?>

</div>
