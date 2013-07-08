<?php

    $arg=arg();
    
    global $base_url;
    global $theme;
    $age='';
    $year=$proposer_details['year'];
    $day=$proposer_details['day'];
    $month=$proposer_details['month'];
    
    $age=age_from_dob($day,$month,$year);
    $dob='('.$day.'-'.$month.'-'.$year.')';
    

if(isset($_SESSION['quick_quote'])){
        
        $quote_id=$_SESSION['quick_quote']['quote_no'];
        $quote_details=quote_details_by_id($quote_id);
        
        //$quote_details=quote_details($_SESSION['quick_quote']['initial_quote_no']);
        $qid=$_SESSION['quick_quote']['quote_no'];
        if(!empty($quote_details['finalpremium'])){
            $finalPremium=$quote_details['finalpremium'];
        }else{
            $finalPremium=$quote_details['total_premium'];
        } 
        $add_c=addon_count($qid);       
}
 ?>
 <div class="purchasepage">
 <h3>Please check if all the details entered by you are true and accurate.</h3>
<div class="confirm">
        <blockquote>
          <div class="listd sel">
            <article class="sel">
              <div class="details">
                <aside>
                  <h2>PLAN DETAILS</h2>
                  <ul>
                    <li><span>Sum Insured</span>&nbsp;&nbsp;<?php  echo ($quote_details['sum_insured']/100000); ?> LAKHS</li>
                    <li><span>Coverage Period</span>&nbsp;&nbsp;<?php echo $quote_details['tenure']; ?> YEARS</li>
                    <li><span>Add-Ons</span>&nbsp;&nbsp;<?php  echo (isset($add_c) ? $add_c : 'NONE' )  ?></li>
                  </ul>
                </aside>
              </div>
              <div class="details">
                <aside>
                  <ul>
                    <li><?php echo $quote_details['no_adults']; ?> ADULT &nbsp;&nbsp;<?php echo $quote_details['no_childs']; ?> CHILD</li>
                    <li><span>Age of eldest member</span>&nbsp;&nbsp;<?php echo $age; ?> YEARS</li>
                    <li><span>Premium Amount</span>&nbsp;&nbsp;<img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/small_R.png" width="8" height="11" alt="">&nbsp;<?php echo number_format($finalPremium); ?></li>
                  </ul>
                </aside>
              </div>
              <div class="details bottom">
                <aside class="bottom">
                  <ul>
                    <li><span>Discounts</span>&nbsp;&nbsp;NONE</li>
                  </ul>
                </aside>
              </div>
            </article>
          </div>
          <div class="listd se2">
            <article class="se2">
              <div class="details">
                <aside>
                  <h2>PROPOSER</h2>
                  <ul>
                    <li class="space"><?php echo $proposer_details['fname']; ?>&nbsp;<?php echo $proposer_details['lname']; ?></li>
                    <li class="space"><?php  echo $age; ?>Years</li>
                    <li class="space"><?php echo  $proposer_details['gender']==0  ? 'Male': 'Female'; ?></li>
                  </ul>
                </aside>
              </div>
              <div class="details">
                <aside>
                  <ul>
                    <li><?php  echo $proposer_details['permnt_address_line_1']; ?><br />
                      <?php  echo $proposer_details['permnt_city']; ?><br />
                      India<br />
                      <?php  echo $proposer_details['permnt_pincode']; ?></li>
                  </ul>
                </aside>
              </div>
              <div class="details last">
                <aside>
                  <ul>
                    <li><?php  echo $proposer_details['mobile']; ?></li>
                    <li><?php  echo $proposer_details['email']; ?></li>
                  </ul>
                </aside>
              </div>
            </article>
          </div>
          <div class="listd se3">
            <article class="se3">
            <div class="details">
              <aside>
                <h2>MEMBERS BEING INSURED (<?php echo $member_count; ?>)</h2>
                <ul>
                  <li>1. <?php echo $proposer_details['fname']; ?>&nbsp;<?php echo $proposer_details['lname'];  ?><br>
                  </li>
                  <li><span>Proposer<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $age;  ?>  years</span>&nbsp;&nbsp;<?php echo  $proposer_details['gender']==0  ? 'Male': 'Female'; ?></li>
                </ul>
                <?php $inc=2;  ?>
                <?php if(isset($member) && !empty($member) ) {
                    
                              foreach($member as $insured){
                                    $year=$insured->year;
                                    $month=$insured->month;
                                    $day=$insured->day;
                                    $insured_age=age_from_dob($day,$month,$year);
                                    $insured_dob='('.$day.'-'.$month.'-'.$year.')';
                                    
                    ?>
                    <ul>
                        <li><?php echo $inc;$inc++; ?>. <?php echo $insured->first_name; ?>&nbsp;<?php echo $insured->last_name;  ?><br /></li>
                        <li><span><?php echo $insured->relationship;?> of Proposer<br />
                                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $insured_age;  ?>  years</span>&nbsp;&nbsp;<?php  echo  $insured->gender==0  ? 'Male': 'Female'; ?></li>
                    </ul>
                    
                    <?php }} ?>
              </aside>
            </div>
          </div>
        </blockquote>
        <div class="paradetails">
          <section>
            <h2>MEDICAL RECORDS</h2>
            <p>The proposer, Mr. Ramesh ((you) does not suffer from any ailment at present and have not visited a medical practioner any time recently or in the past 4 years. You also state that you have not suffered from any of the ailments listed in the schedule.</p>
            <p>The second member, Mrs. Rajini Malhotra does not suffer from any ailment at present and have not visited a medical practioner any time recently or in the past 4 years. This member has not suffered from any of the ailments listed in the schedule.</p>
            <p>The third member , Mstr. Rahul Ramesh Malhotra does not suffer from any ailment at present and have not visited a medical practioner any time recently or in the past 4 years. This member has not suffered from any of the ailments listed in the schedule.</p>
            <h2>FINAL DECLARATION</h2>
            <p>I/we have read and understood the terms of the policy and confirm to abide by the same</p>
            <p>I agree that insurance coverage ...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac diam
              non purus ornare malesuada vel at orci. Morbi quis dui diam. Integer sit amet velit massa. Vestibulum dolornisi, mattis sed egestas in, malesuada nec metus. Nam tempus vehicula rutrum. In vitae velit at turpis auctor porta. Nulla facilisi. Nunc justo odio, rutrum non pretium non, posuere nec nisi. Sed odio neque, gravida ut elementum ac, tempor vel mauris. Integer feugiat condimentum purus, nec auctor eros aliquet elementum.</p>
            <div class="checkthis">
              <input type="checkbox" id="c1" name="cc"  class="paid" />
              <label for="c1"><span></span>I ACCEPT THE DECLARATION AND AGREE TO ABIDE BY THE TERMS AND CONDITIONS</label>
              
              <?php  foreach($constent_declaration as $dec){ ?>
              
                    <input type="checkbox"  class="paid" id="<?php echo $dec->code; ?>" name="<?php  echo $dec->code; ?>" />
                    <label for="<?php echo $dec->code; ?>"><span></span><?php  echo $dec->question; ?></label>  
              <?php } ?>
            </div>
          </section>
        </div>
        <input  type="hidden" class="appid" value="<?php echo $arg[1]; ?>"/>
        <input  type="hidden" class="qid" value="<?php echo $qid; ?>"/>
        <div class="conf_error"></div>     
        <div class="footerproceedlink conf">
        
          <div class="proceedleftlink">
            <ul>
              <li class="first"><a href="<?php echo $back; ?>">< Back</a></li>
              <li class="last"><a href="#">Continue Later</a></li>
            </ul>
          </div>
          <div class="proceedrightlink">
           <form action="<?php echo $base_url; ?>/application/payment/<?php  echo $app_id;  ?>" method="post" id="billdesk-payment-form" accept-charset="UTF-8">
                <input type="submit" id="edit-submit" name="op" value="Proceed to Payment" class="form-submit"/>
          </form>
          
          </div>
        </div>
      </div>
</div>
   