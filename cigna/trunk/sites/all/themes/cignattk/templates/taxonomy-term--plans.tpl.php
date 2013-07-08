<?php 

//dpr($_SESSION);exit;
//dpr($plans);exit;
$_SESSION['show_all_plans']=1;

$plans = object_to_array($plans);?>

<?php array_sort_by_column($plans, 'ordering');?>
<div class="entry-content contectdata span10">
    <div class='modify_plans'>
                         <?php echo l('CALCULATE PREMIUM','quote/suggestion/details',array('attributes'=>array('class'=>array('show_calculate_premium')))); ?>
                         <?php 
                         // Menu defined in quick_quotation module for comparing plans.
                        // echo l('COMPARE','plans/compare',array('attributes'=>array('class'=>array('compare_plans')))); ?>   
    </div>          
  <?php foreach($plans as $plan):?>
  <?php if($plan['type'] == 'plan' && $plan['status'] == 1):?>
  <div class="plandetails">
    <div class="panel1">
      <div class="leftadd">
        <div class="adddata">
          <div class="topt">Cigna TTK <!-- <img src="<?php echo file_create_url($plan['uc_product_image']['und']['0']['uri']);?>"/> --></div>
          <div class="topgold"><?php echo $plan['title']; //l($plan['title'],'node/'.$plan['nid'])?></div>
          <div class="toptext">A hospitalization plan</div>
          <div class="viewd">EXPERT'S VIEW</div> <!--viewd2-->
          <div class=""><?php echo l('VIEW PLAN DETAILS','node/'.$plan['nid'])?>
          </div>
          <!--<img src="../sites/all/themes/cignattk/images/buynow.png" width="190" height="23" alt="">--> </div>
      </div>
      <div class="leftdatates">
        <?php $desc = cignattk_split_string($plan['body']['und']['0']['safe_value'],201);?>
        <?php echo $desc[0];?>
        <span id="content<?php echo $plan['nid']?>" class="more-less"><?php echo $desc[1];?></span>
        <span id="<?php echo $plan['nid']?>" class="show_more show_mor<?php echo $plan['nid']?>">Show More >> </span> <span id="<?php echo $plan['nid']?>" class="show_less show_les<?php echo $plan['nid']?>">Show Less << </span> <br/>
        <span>
        <input type="checkbox" class="compare" name="product_<?php echo  $plan['nid'];?>" value="<?php echo $plan['nid'];?>"/>
        Compare this plan</span> </div>
      <div class="leftmodify">
        <h3> X <?php // echo $plan['field_most_viewed']['und']['0']['value'];?></h3>
      </div>
    </div>
  </div>
  <?php endif;?>
  <?php endforeach;?>
</div>
<?php //print render_video();?>
