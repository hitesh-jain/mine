
<?php global $theme;?>     

<script type="text/javascript">
//Initialize first demo:
ddaccordion.init({
	headerclass: "mypets", //Shared CSS class name of headers group
	contentclass: "thepet", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openpet"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

//Initialize 2nd demo:
ddaccordion.init({
	headerclass: "technology", //Shared CSS class name of headers group
	contentclass: "thelanguage", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
	persiststate: false, //persist state of opened contents within browser session?
	toggleclass: ["closedlanguage", "openlanguage"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "<img src='<?php echo url(drupal_get_path('theme',$theme));?>/images/uparrow.png' /> ", "<img src='<?php echo url(drupal_get_path('theme',$theme)); ?>/images/down_aarow.png'/> "], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

ddaccordion.init({
	headerclass: "getQuote", //Shared CSS class name of headers group
	contentclass: "thelanguage", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
	persiststate: false, //persist state of opened contents within browser session?
	toggleclass: ["closedlanguage", "openlanguage"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
        ganesha();
	}
})
ddaccordion.init({
	headerclass: "getQuote1", //Shared CSS class name of headers group
	contentclass: "nextdrop", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	scrolltoheader: false, //scroll to header each time after it's been expanded by the user?
	persiststate: false, //persist state of opened contents within browser session?
	toggleclass: ["closedlanguage", "openlanguage"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix",  "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
        ganesha();   
	}
})
</script>
<script type="text/javascript">
    function ganesha(){
        divs = document.getElementsByClassName( 'accordprefix' );
        [].slice.call( divs ).forEach(function ( div ) {
            div.innerHTML = '<img src="/sites/all/themes/cigna_ttk_2/images/uparrow.png">';
        });
        //document.getElementById("accordprefix").innerHTML = "<img src='/sites/all/themes/cigna_ttk_2/images/uparrow.png'>"
        //document.getElementById("accordprefix").innerHTML = "<img src='/sites/all/themes/cigna_ttk_2/images/uparrow.png'>"
    }
</script>

<?php

/*
if(!empty($_SESSION['quick_quote']['initial_quote_no'])){
 
    $result=quote_details($_SESSION['quick_quote']['initial_quote_no']);
      if(!empty($result)){

            $title=$result['parentProductId'];
            $plan_option_id=$result['entity_id'];
      }     
}*/

$plans = object_to_array($plans);  ?>
<?php array_sort_by_column($plans,'basePremium'); ?>

<div class="thankyoupay planaddons">
<div class="suggestplans suggestplansinfo">
  <article>
    <h1>Plans recommended for you</h1>
    <div class="ModifyDetails">
      <input type="button" value="Compare Plans"/>
    </div>

<?php 
global $base_url;

foreach($plans as $key => $plan): //dpr($plan);

    $stored_quote_details=initial_quote_details($plan['quote_id'],$plan['parentPlanId']);
    //dpr($stored_quote_details);exit;
    //$quote_details=quote_details_by_id($quote_id);

    $planname=_plan_ws_short_name($plan['parentPlanId']);
  
 ?>
    <input id="plan_quote_id<?php echo $plan['parentPlanId']?>" type="hidden" value="<?php echo $plan['quote_id']; ?>" />
    <div class="calculatepremium">
    <section>
      <div class="calculatepremiumd">
      <dd>
      <div class="leftarea">
        <dl>
            <?php if(!empty($plan['uc_product_image']['und']['0']['uri'])):?>
            <img src="<?php echo file_create_url($plan['uc_product_image']['und']['0']['uri']);?>" width="231" height="95" alt=""/> <span id="title_<?php echo $plan['parentPlanId']; ?>"><b><?php echo l($planname,'node/'.$plan['parentPlanId'])?></b></span>
            <?php else:?>
            <img src="<?php  echo url(drupal_get_path('theme',$theme)); ?>/images/plan.png" width="231" height="95" alt=""/>
            <span id="title_<?php echo $plan['parentPlanId']; ?>"><b><?php echo l($planname,'node/'.$plan['parentPlanId'])?></b></span>
            <?php endif;?>
        </dl>
        </div>
        <div class="firstdata">
        <aside class="first">
            <p>
                <div id="shortcnt<?php echo $plan['parentPlanId']?>"><?php echo substr($plan['body']['und']['0']['value'],0,250);?></div>
                <div id="content<?php echo $plan['parentPlanId']?>" style="display: none;"><?php echo $plan['body']['und']['0']['value'];?></div>
                <div class="showmorebtn"><span id="<?php echo $plan['nid']?>" class="show_more show_mor<?php echo $plan['parentPlanId']?>">Show More >> </span> <span id="<?php echo $plan['parentPlanId']?>" class="show_less show_les<?php echo $plan['parentPlanId']?>">Show Less << </span></div>
            </p>
        <b>ADD ONS AVAILBLE : <span><?php  // $addon=addons_details($plan['entity_id'],3);
        
                $addon_count=0;
                if($addon){
                    
                    foreach($addon as $add){
                        $addon_count++;
                    }
                }
              //  echo $addon_count;?></span></b> </aside>
        </span>
        </div>
        <div class="lastdata">
        <aside class="last">
          <div class="rightdata"><?php echo $stored_quote_details['no_adults']?> ADULTS, <?php echo $stored_quote_details['no_childs']?> CHILD</div>
          <ul>
            <li>TERM <span>
              <div class="technology" id="selectedyear"><span id="replace_<?php echo $plan['parentPlanId']; ?>"><?php echo $stored_quote_details['tenure']; ?>YEAR&nbsp;</span></div>
              <div class="thelanguage"><div class="choosetitle">Choose Term</div>
			  <?php $terms=parent_plan_policy_term($plan['parentPlanId']); ?>
               <?php foreach($terms as $term):?>
                    <?php if($term->field_plan_policy_term_value > 1):?>
                        <?php $yrs = 'YEARS';?>
                    <?php else:?>
                        <?php $yrs = 'YEAR';?>
                    <?php endif;?>
                    <div id="tenure_<?php echo $plan['parentPlanId'];?>_<?php echo $term->field_plan_policy_term_value;?>" class="oneyars"><b><?php echo $term->field_plan_policy_term_value;?> <?php echo $yrs; ?></b></div>
               <?php endforeach;?>
              <button id="<?php echo $plan['parentPlanId'];?>" class="getQuote" style="background-color: #000; color:#FFF; padding:5px margin-top:11px; float: right;">Update</button>
              </div>
              </span></li>
            <li>SUM
              INSURED
<span><div class="technology">

			<div style="display: none;" id="selectedSI"><?php echo $stored_quote_details['sum_insured'];?>,</div>
            
            <div style="display: none;" id="plan_option_code_<?php echo $plan['parentPlanId']; ?>"></div>
            
			<div id="replacesi_<?php echo $plan['parentPlanId']; ?>"><?php echo number_format($stored_quote_details['sum_insured'],0);?></div><?php $terms=parent_plan_policy_term($plan['parentPlanId']); ?>&nbsp;</div>
              <div class="thelanguage nextdrop">
              
                    <?php foreach($plan['options'] as $key => $subplan_options){
                        
                            $si = round($subplan_options['field_si_value_value']);
                     ?>
                        <div id="sumsi<?php echo $key;?>_<?php echo $plan['parentPlanId']; ?>" class="oneyars1">
                            
                            <span style="display: none;">
                                    <?php echo $si.':'.$subplan_options['entity_id'].':'.$plan['quote_id']; ?>
                            </span>
                                <b>
                                <img src="<?php echo url(drupal_get_path('theme',$theme));?>/images/rupes_sing.png" width="10" height="13" alt=""/>                                     <?php echo number_format($si,0);?></b></div>
                    <?php }  ?>
              <button id="<?php echo $plan['parentPlanId'];?>" class="getQuote1" style="background-color: #000; color:#FFF; padding:5px; float: right; margin-top:11px;">Update</button>
              
              </div>
              </span></li>
          </ul>
          <input id="planId<?php echo $plan['parentPlanId']?>" name="planId" type="hidden" value="<?php echo $plan['parentPlanId'];?>" />
          <div class="premium"> <span>PREMIUM</span>
          
            <div class="buynowd"><img src="<?php echo url(drupal_get_path('theme',$theme));?>/images/rupes_sing.png" width="12" height="15" alt=""/>&nbsp;<div class="showpricelist" id="getpremium<?php echo $plan['parentPlanId'];?>"><?php echo number_format($stored_quote_details['total_premium']); ?></div>
            
            
              <a  href="<?php echo $base_url; ?>/<?php echo drupal_get_path_alias('node/'.$plan['parentPlanId']); ?>?quote-id=<?php echo $plan['quote_id']; ?>&plan-id=<?php echo $plan['parentPlanId']; ?>" class="linkbuttonclass">Buy Now</a>
            </div>
          </div>
        </aside>
        </div>
        <div class="custom">
          <ul>
            <li class="one"><?php echo $plan['field_most_viewed']['und'][0]['value'];?></li>
            <li class="two">
              <div class="checkthis">
                <input type="checkbox" id="c1" name="cc" />
                <label for="c1"><span></span>ADD TO<br/>
                  COMPARE</label>
              </div>
            </li>
            <li class="two"><img src="<?php echo url(drupal_get_path('theme',$theme));?>/images/man02.png" width="14" height="18" alt=""/><br/>
              EXPERT'S<br/>
              VIEW </li>
            <li class="two"><?php echo l('<img src="'.url(drupal_get_path('theme',$theme)).'/images/arrow1.png" width="14" height="14" alt=""><br>
              VIEW<br/>DETAILS','node/'.$plan['parentPlanId'],$options = array('html' => TRUE))?></li>
          </ul>
        </div>
      </dd>
      </div>
    </section>
    </div>
<?php if(!isset($plan['field_plan_video']["und"][0]['uri'])):?>
    <div id="myModal<?php echo $key;?> " class="reveal-modal videoplaydata"><?php print render_video($plan['field_plan_video'][und][0]['uri'],650,350);?><a class='close-reveal-modal'><img src='sites/all/themes/cigna_ttk_2/images/closed.png'/></a></div>
<?php endif;?>

<?php endforeach;?>
</article>
</div>
<div class="leftsidedata">
<aside>
    <h5>HOSPITALIZATION PLANS</h5>
    <p>These plans are designed for giving maximum benefit under the sum insured lorem ipsum dolor sit amet nunc justo. Avec pharetra nunc biendum lorem.</p>
    <a href="#">> View all add-ons</a>
</aside>
</div>
</div>
