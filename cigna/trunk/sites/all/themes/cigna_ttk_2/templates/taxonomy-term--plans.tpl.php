
<?php
 
global $theme;

//dpr($_SESSION);exit;
//dpr($plans);exit;
$_SESSION['show_all_plans']=1;
$plans = object_to_array($plans);?>

<?php array_sort_by_column($plans, 'ordering');?>
    <div class="thankyoupay planaddons">
        <div class="suggestplans">
        <article>
        <div class="topdatalistplan">
          <h1>Showing all plans for you</h1>
          <div class="ModifyDetails">
            <a name='calculate' class="big-link" id="calculate" href="<?php echo url('quote/suggestion/details') ?>?clicked=1">Calculate Premium</a>
            &nbsp;&nbsp;&nbsp;
            <input type="button" value="Compare Plans"/>
          </div>
          <?php if($plans){?>
          <?php foreach($plans as $key=>$plan){ //dpr($plan);exit; ?>
                <?php if($plan['type'] == 'plan' && $plan['status'] == 1){?>
                    <div class="sectionlist">
                    <section>
                        <dd>
                          <dl>
                                <?php if(isset($plan['uc_product_image']['und']['0']['uri'])):?>
                                <img src="<?php echo file_create_url($plan['uc_product_image']['und']['0']['uri']);?>" width="231" height="95" alt=""/> <!-- <span>AN AFFORDABLE HOSPITALIZATION PLAN --></span>
                                <?php else:?>
                                    <img src="<?php  echo url(drupal_get_path('theme',$theme)); ?>/images/plan.png" width="231" height="95" alt=""/>
                                <?php endif;?>
                          </dl>
                          
                          <aside>
                            <p>
                                <div id="shortcnt<?php echo $plan['nid']?>"><?php echo substr($plan['body']['und']['0']['value'],0,250);?></div>
                                <div id="content<?php echo $plan['nid']?>" style="display: none;"><?php echo $plan['body']['und']['0']['value'];?></div>
                                <div class="showmorebtn"><span id="<?php echo $plan['nid']?>" class="show_more show_mor<?php echo $plan['nid']?>">Show More >> </span> <span id="<?php echo $plan['nid']?>" class="show_less show_les<?php echo $plan['nid']?>">Show Less << </span></div>
                            </p>
                            <b>ADD ONS AVAILBLE : <span><?php $addon=addons_details($plan['nid'],3); $count=count($addon);echo $count;?></span></b> </aside>
                          <div class="custom">
                            <ul>
                              <li class="one"><?php echo $plan['field_most_viewed']['und'][0]['value'];?></li>
                              <li class="two">
                                <div class="checkthis">
                                  <input type="checkbox" id="c<?php echo $key;?>" name="cc" />
                                  <label for="c<?php echo $key;?>"><span></span>ADD TO<br/>
                                    COMPARE</label>
                                </div>
                              </li>
                              <li class="two"> <img src="<?php  echo url(drupal_get_path('theme',$theme)); ?>/images/man02.png" width="14" height="18" alt=""/><br/>
                              <a href="#" data-reveal-id="myModal<?php echo $key;?>" data-animation="none">
                                EXPERT'S<br/>
                                VIEW </a></li>
                              <li class="two"> <img src="<?php echo  url(drupal_get_path('theme',$theme)); ?>/images/arrow1.png" width="14" height="14" alt=""/><br/>
                              <?php echo l('VIEW DETAILS','node/'.$plan['nid']) ?>
                            </ul>
                          </div>
                        </dd>
                        <?php if(isset($plan->field_plan_video[und][0]['uri'])):?>
                            <div id="myModal<?php echo $key;?>" class="reveal-modal"><?php print render_video($plan->field_plan_video[und][0]['uri'],650,350);?><a class='close-reveal-modal'><img src="sites/all/themes/cigna_ttk_2/images/closed.png" /></a></div>
                        <?php endif;?>
                    </section>
                
                     </div>
              <?php } ?>
          <?php }?>
        <?php }else{?>
            <div class="sectionlist">
                    <section>
                    <h4>There are no plans to display.</h4>
                    </section>
            </div>
            
        <?php }?>
          
        </article>
         </div>
       <div class="planleftdetails">
        <aside>
        <h5>HOSPITALIZATION PLANS</h5>
        <p>These plans are designed for giving maximum benefit under the sum insured lorem ipsum dolor sit amet nunc justo. Avec pharetra nunc biendum lorem.</p>
        <a href="<?php echo $base_url.'/plans/indemnity-plans'?>"> > View All Plans</a></aside>
        </div>
    
    <!-- 
        <div class="bottondata">
        <article class="botton">
          <h3>Other plans you might be interested in</h3>
          <div class="datalist">
            <data>
              <h4 class="frst">PERSONAL ACCIDENT<br />
                <span>A FIXED BENEFIT PLAN</span></h4>
              <p>Ideal plan for lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique etiam ac lacus massa wivamus varius.</p>
              <img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/arrow_1.png" width="21" height="21" alt=""/> </data>
          </div>
          <div class="datalist">
            <data>
              <h4 class="sec">CRITICAL ILLNESS<br />
                <span>A FIXED BENEFIT PLAN</span></h4>
              <p>Ideal plan for lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique etiam ac lacus massa wivamus varius.</p>
              <img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/arrow_1.png" width="21" height="21" alt=""/> </data>
          </div>
          <div class="datalist">
            <data>
              <h4 class="thre">HOSPITAL CASH<br />
                <span>A FIXED BENEFIT PLAN</span></h4>
              <p>Ideal plan for lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique etiam ac lacus massa wivamus varius.</p>
              <img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/arrow_1.png" width="21" height="21" alt=""> </data>
          </div>
          <div class="datalist last">
            <data class="last">
              <h4>FIXED BENEFIT PLANS?</h4>
              <p>These plans are designed for giving maximum benefit under the sum insured lorem ipsum dolor sit amet nunc justo. Avec pharetra nunc biendum lorem. </p>
            </data>
          </div>
        </article>
      </div>
     -->