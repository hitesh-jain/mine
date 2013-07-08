<?php global $user,$theme;?>
<?php print pop_callback(); ?>
<div class="thankyoupay">
      <div class="toptitle">
        <div class="lefttitle">
          <h2>Congrats <?php print ucfirst($user->data['first_name']);?> Your health insurance is dolor set amet.</h2>
          <h1>We have received your payment of Rs. <?php echo $amount;?></h1>
        </div>
        <div class="rightdownload">
          <ul>
            <li>DOWNLOAD RECEIPT</li>
            <li class="last">DOWNLOAD POLICY</li>
          </ul>
        </div>
      </div>
      <div class="pathyou">
        <article>
          <h3>What Next?</h3>
          <p>You will also receive periodic notifications via SMS and emails.</p>
          <p>You will receive all the following within the next 15 working days<br/>
            (i.e on or before 10 Mar 2013):</p>
          <ol>
            <li>Policy document</li>
            <li>Premium Paid Receipt</li>
            <li>Health Cards for You, Rajini and Rahul (A sample is shown below)</li>
          </ol>
          <div class="mainpath">
            <section class="main">
              <div class="leftareadate">
                <section class="leftarea">
                  <div class="topd">
                    <div class="leftlogo"> <img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/plan_logo.png" width="53" height="17" alt=""></div>
                    <div class="rightlogo"><span>Gold Health Plus</span><img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/plan_name.png" width="39" height="17" alt=""></div>
                  </div>
                  <div>
                    <div class="detal">
                      <p><span>NAME</span>&nbsp;<?php print $user->data['first_name'].' '.$user->data['last_name']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>DATE</span>&nbsp;12 Aug 2013</p>
                      <p><span>POLICY NUMBER</span>&nbsp;091276821NP</p>
                      <p><span>LOREM IPSUM</span>&nbsp;XXX-XXXX</p>
                    </div>
                    <div class="linkfooter"> www.cignattkhealthcare.com </div>
                  </div>
                  <div class="frontbb">FRONT</div>
                </section>
              </div>
              <div class="rightareadata">
                <section class="rightarea">
                  <div>
                    <div class="detal">
                      <p>Customer Support<br/>
                        <span>1800 2355 6711</span></p>
                      <p>Network Hospitals<br/>
                        <span>www.cignattkinsurance.com/networkhospitals</span></p>
                      <p>Cigna TTK Office<br/>
                        <span>#234 Campus 4, Barton Center, MG Road,<br />
                        Bangalore 560023</span></p>
                    </div>
                  </div>
                  <div class="backbb">BACK</div>
                </section>
              </div>
            </section>
          </div>
        </article>
      </div>
      <div class="sideada">
        <aside>
          <div class="top1">
            <h3>MANAGE YOUR POLICY</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc.</p>
            <!-- <input type="button" name="log" id="log" value="Log in"> -->
            <a href="/user" class="big-link">Log in</a>
          </div>
          <div class="top1 last">
            <h3>NEED CLARIFICATIONS</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc.</p>
            <a href="#" class="big-link" data-reveal-id="myModal777" data-animation="none">Call me back</a>
            <!-- <input type="button" name="log" id="log" value="Call me back"> -->
          </div>
        </aside>
      </div>
      <div class="bottondata">
        <article class="botton">
          <h3>Other plans you might be interested in</h3>
          <div class="datalist">
            <data>
              <h4 class="frst">PERSONAL ACCIDENT<br />
                <span>A FIXED BENEFIT PLAN</span></h4>
              <p>Ideal plan for lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique etiam ac lacus massa wivamus varius.</p>
              <img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/arrow_1.png" width="21" height="21" alt=""> </data>
          </div>
          <div class="datalist">
            <data>
              <h4 class="sec">CRITICAL ILLNESS<br />
                <span>A FIXED BENEFIT PLAN</span></h4>
              <p>Ideal plan for lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur congue quam et nunc interdum tristique etiam ac lacus massa wivamus varius.</p>
              <img src="<?php echo url(drupal_get_path('theme',$theme)); ?>/images/arrow_1.png" width="21" height="21" alt=""> </data>
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
    </div>