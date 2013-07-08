<?php global $user, $base_url, $theme;  ?>
<?php drupal_add_js(drupal_get_path('theme',$theme).'/js/modify_preference.js'); ?>

<div id='myModal420' class='reveal-modal'>
<table border="0" cellspacing="0" cellpadding="0" width="100%"  style="bgcolor:#000000;">
	<tr>
		<td width="270" style="border:none;">
			<table border="1" cellspacing="1" cellpadding="1"  class="custom-user-profile">
				<tr>
					<td class="active" id="change-password-td">
					<a href="javascript:void(0);" onclick="return fnc_ChangeTab(1);">Change Password</a></td>
				</tr>
				<tr>
					<td id="update-profile-td"><a href="javascript:void(0);" onclick="return fnc_ChangeTab(2);">Update Profile</a></td>
				</tr>
				<tr>
					<td id="email-settings-td"><a href="javascript:void(0);" onclick="return fnc_ChangeTab(3);">Email Settings</a></td>
				</tr>
			</table>
		</td>
		<td style="border:none;" valign="top">
			<div id="message"></div>
			<div id="change-password" style="display:block;"> 
			</br><p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
			<?php
				$form_id = "client_login_form";
				echo drupal_render(drupal_get_form($form_id));
			?>
			</div>
			<div id="update-profile" style="display:none;"> 
				</br><p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
				<?php
				$form_id = "client_login_update_profile_form";
				echo drupal_render(drupal_get_form($form_id));
				?>
			</div>
			<div id="email-settings" style="display:none;"></br><p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
				<?php
				$form_id = "client_login_update_email_form";
				echo drupal_render(drupal_get_form($form_id));
				?>
			</div>
		</td>
	</tr>
</table>
<a class='close-reveal-modal'><img src='<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/closed.png'/></a>
</div>
<?php       
        global $user;
        
        if ($user->uid) {
            print pop_servicerequest();
        } 
?>

    <div class="myaccount">
      <div class="rightdata">
        <article>
          <h1><?php  echo $user->data['first_name']; ?>&nbsp;<?php echo $user->data['last_name']; ?></h1>
                <menu>
<!--
                    <ul id="user_profile_menu">
                        <li><a href="#" data-reveal-id="myModal420" data-animation="none">MODIFY PREFERENCES</a></li>
                        <li><a href="dashboard/notifications">NOTIFICATIONS</a></li>
                        <li><a href="dashboard/documents-locker">DOCUMENTS LOCKER</a></li>
                        <li><a href="dashboard/my-expiried-policies">MY EXPIRED POLICIES</a></li>
                    </ul>
-->
                <?php print get_topLeftDashboard_menu(); ?>
                </menu>
                <?php $display_flag=1; ?>
                <?php 
                    foreach($policies as $policy){ 
                        $node=node_load($policy->planid);
                ?>
                    <?php
                        if ($policy->applications_status == 'completed'){
                            
                            if($display_flag){
                     ?>
                     <h4>Your Policies</h4>
                     <?php  $display_flag=0;  } ?>
                <div class="sectionarea">                    
                    <section>
                      <div class="ddlist frst">
                        <dd class="frst">
                            <img src="<?php echo file_create_url($node->uc_product_image['und']['0']['uri']);?>" />
                        </dd>
                      </div>
                      <div class="ddlist sect">
                        <dd class="sect">
                          <p class="toptext">Policy number: <span><?php echo $policy->policy_no; ?></span></p>
                          <p>INSURED <span><?php echo $policy->no_adults; ?> ADULT, <?php echo $policy->no_childs; ?> CHILDREN</span></p>
                          <p>TERM <span><?php echo $policy->tenure; ?> YEAR</span></p>
                          <p>SUM INSURED Rs:<span><?php echo number_format($policy->sum_insured); ?></span></p>
                          <?php if(!empty($policy->policy_end_date)){ ?>
                                <p>VALID UPTO <span><?php echo ($policy->policy_end_date); ?></span></p>
                          <?php } ?>
                        </dd>
                      </div>
                      <div class="ddlist thrd">
                        <dd class="thrd">
                          <ul>
                            <li><a href="receipt-pdf-file?qid=<?php echo $policy->qid; ?>" target="_blank">DOWNLOAD RECEIPT</a></li>
                            <li><a href="proposal-file?qid=<?php echo $policy->qid; ?>" target="_blank">DOWNLOAD POLICY</a></li>
                            <?php
                            /*
                                global $user, $base_url;
                                
                                if ($user->uid) {
                                    echo '<li><a href="" data-reveal-id="myModal778" data-animation="none">Service Request</a></li>';
                                }
                                else{
                                    echo '<li><a href="'.$base_url.'/user" >Service Request</a></li>';
                                }
                             */                                                     
                            ?>
                            <li><a href="#" >Service Request</a></li>
                            <li><a href="#">RENEW POLICY</a></li>
                          </ul>
                        </dd>
                      </div>
                    </section>
                </div>
                <div class="sectionarea btnm">
                    <section class="btnm">
                      <p>There are no pending claims on this policy. 
                      <?php
                           if(strtotime($policy->policy_end_date) > strtotime('today'))
                           { 
                                echo "This policy is not yet due for renewal.";
                           }
                           else
                           {
                                echo "Your Policy Expired. Apply for renewal.";
                           } 
                      ?>
                      </p>
                    </section>
                </div>                  
                <?php 
                    }
                    else if ($policy->applications_status == 'partial')
                    {
                ?>
                    <div class="sectionarea">
                    <section>
                      <div class="ddlist frst">
                        <dd class="frst"> 
                            <img src="<?php echo file_create_url($node->uc_product_image['und']['0']['uri']);?>" width="231" height="95" alt=""/>
                        </dd>
                      </div>
                      <div class="ddlist fouth">
                        <dd class="fouth">
                          <h4>SERVICE STATUS</h4>
                          <p>INSURED <span><?php echo $policy->no_adults; ?> ADULT, <?php echo $policy->no_childs; ?> CHILDREN</span></p>
                          <p>TERM <span><?php echo $policy->tenure; ?> YEAR</span></p>
                          <p>SUM INSURED <span><?php echo number_format($policy->sum_insured); ?></span></p>
                        </dd>
                      </div>
                    </section>
                  </div>
                  <div class="sectionarea btnm">
                    <section class="btnm">
                      <p>Application received & is under process.</p>
                    </section>
                  </div>
              <?php
                }
               } 
              ?>
              <?php
                    $stored_quote=db_select("get_quote",'q')
                                    ->fields('q')
                                    ->condition('uid',$user->uid)
                                    ->condition('status',1)
                                    ->orderBy('created','DESC')
                                    ->range(0,2)
                                    ->execute()->fetchAll();
                                    
                    //dpr($stored_quote); exit;
                    
                    foreach($stored_quote as $result){
        
                        //dpr($result);exit;
                        $planid=db_select('field_data_field_plan_id','i');
                        $planid->innerJoin('node','n','n.nid=i.entity_id');
                        $planid->fields('i',array('entity_id'))
                                ->condition('n.status',1)
                                ->condition('i.entity_id',$result->planid);
                                         
                        $planid=$planid->execute()->fetchField();
                        
                        //dpr($planid); exit;
                       
                       /*
                       if(!empty($result->policy_start_date)){
                         
                            //$startingDate=strtotime($result->policy_start_date);
                            //$valid_days=(((int)($result->tenure)) * 365)-1;
                            //$valid_end_date = date('d M Y',strtotime(date("j/n/Y", $startingDate) . " + ".$valid_days." day"));
                            //$result->policy_end_date=$valid_end_date;
                       }*/
                       
                       $result->planid=$planid;                          
                       $quote_policy[$result->qid]=$result;
                       
                       //dpr($quote_policy); exit;
                       
                    }
                                    
                    if($quote_policy)
                    {
                        foreach ($quote_policy as $sdata)
                        {
                            $node=node_load($sdata->planid);
              ?>
                          <div class="sectionarea">
                            <section>
                              <div class="ddlist frst">
                                <dd class="frst"> 
                                    <img src="<?php echo file_create_url($node->uc_product_image['und']['0']['uri']);?>" />
                                </dd>
                              </div>
                              <div class="ddlist fouth">
                                <dd class="fouth">
                                  <h4>QUOTE</h4>
                                  <p>INSURED <span><?php echo $sdata->no_adults; ?> ADULT, <?php echo $sdata->no_childs; ?> CHILDREN</span></p>
                                  <p>TERM <span><?php echo $sdata->tenure; ?> YEAR</span></p>
                                  <p>SUM INSURED <span><?php echo number_format($sdata->sum_insured); ?></span></p>
                                  <p>PREMIUM <span><?php echo number_format($sdata->total_premium); ?></span></p>
                                </dd>
                              </div>
                            </section>
                          </div>
                          <div class="sectionarea btnm">
                            <section class="btnm">
                              <p></p>
                            </section>                            
                          </div>
              <?php
                        }
                    }
              ?>
               <div class="sectionarea last">
                <section class="last">
                  <div class="ddlist lastleft">
                    <dd class="lastleft">Lorem ipsum dolor set amet consectetur </dd>
                  </div>
                  <div class="ddlist lastright">
                    <dd class="lastright">
                      <a href="<?php echo $base_url; ?>/quote/suggestion/details?clicked=1" class="linkbuttonclass">Buy Additional Policy</a>
                    </dd>
                  </div>
                </section>
              </div> 
        </article>
      </div>
      <div class="leftdata">
        <aside>
          <div class="bolgdata">
            <h5>LOYALTY BENEFITS</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique.</p>
          </div>
          <div class="bolgdata">
            <h5>YOUR RELATIONSHIP MANAGER</h5>            
            <div class="man"><img src="<?php global $base_url; echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/man.png" width="20" height="21" alt=""></div>
            <div class="nameadd">Arundhuti Balakrishnan <br />
              +91 98802 88467</div>
            <p>If you need further lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique.</p>
          </div>
          <div class="bolgdata">
            <h5>QUICK LINKS</h5>
            <ul>
              <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('hospital-locator')?>">HOSPITAL LOCATOR</a></li>
              <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('branch-locator')?>">BRANCH LOCATOR</a></li>
              <?php
                    
                    if ($user->uid) {
                        echo '<li><a href="" data-reveal-id="myModal778" data-animation="none">Service Request</a></li>';
                    }
                    else{
                        echo '<li><a href="'.$base_url.'/user" >Service Request</a></li>';
                    }                                                     
              ?>
              <li>CLAIMS FORM</li>
              <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('claims-process')?>">CLAIMS PROCESS</a></li>
              <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('feedback')?>">FEEDBACK</a></li>
              <li class="last"><a href="<?php print $base_url.'/'.drupal_get_path_alias('grievance-redressal')?>">GRIEVANCE REDRESSAL</a></li>
            </ul>
          </div>
          <div class="bolgdata">
            <h5>TOOLS</h5>
            <ul>
              <li>PREMIUM CALCULATOR</li>
              <li class="last">CALENDAR</li>
            </ul>
          </div>
        </aside>
      </div>
    </div>