
<?php global $base_url; 
    
        $front=$is_front;
        if($front){
            unset($_SESSION['show_all_plans']);
        }

?>

<div class="header">
  <header id="master-header" class="clearfix" role="banner">
    <hgroup>
      <div class="headertop">
        <h1 id="site-title">
          <?php if ($logo): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> </a>
          <?php endif; ?>
          </a></h1>
        <div id="topmenu">
          <div class="topsearch">
            <div class="world"> <img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/world.png" width="19" height="19" alt="">&nbsp;<span class="language">English</span>&nbsp;&nbsp;
              <div class="form-type-select"> 
                <!--<select id="countrySelection" name="countrySelection" onchange="location = this.options[this.selectedIndex].value;"> -->
                <select id="countrySelection" name="countrySelection">
                  <option value="http://www.cigna-cmc.com/sc/html/index.html" label="China">China</option>
                  <option value="http://www.cigna.com.hk/" label="Hong Kong">Hong Kong</option>
                  <option value="http://www.cigna.co.id/id/html/index.html" label="Indonesia">Indonesia</option>
                  <option value="<?php echo $base_url;?>/index.php" label="India" selected>India</option>
                  <option value="http://www.cigna.co.nz/" label="New Zealand">New Zealand</option>
                  <option value="http://www.lina.co.kr/" label="South Korea">South Korea</option>
                  <option value="http://www.cigna.es/" label="Spain">Spain</option>
                  <option value="http://www.cigna.co.th/" label="Thailand">Thailand</option>
                  <option value="http://www.cigna.com.tr/tr/html/index.html" label="Turkey">Turkey</option>
                  <option value="http://www.cigna.co.uk/" label="United Kingdom">United Kingdom</option>
                  <option value="http://www.cigna.com/" label="United States">United States</option>
                </select>
              </div>
            </div>
            <div class="searchbutton"> 
              <!--			
              <input type="text" name="search" id="search" class="searchbx">
              <input type="button" name="searchbtn" id="searchbtn" class="searchbxt">
--> 
              <?php print render($page['header']); ?> </div>
          </div>
          <div class="chatlive"><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/icon.png" width="18" height="16" alt="">&nbsp;<span class="livedata">Live Chat</span>&nbsp;&nbsp;(Mon to Fri&nbsp;<span>|</span>&nbsp;9am to 6pm)&nbsp;&nbsp;&nbsp;<img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/line.png" width="1" height="19" alt="">&nbsp;&nbsp;&nbsp;<img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/call_icon.png" width="14" height="15" alt=""/>&nbsp;Toll Free Helpline &nbsp;<span class="claspage">1800 1234 5678</span> </div>
        </div>
      </div>
    </hgroup>
    <?php global $base_url;?>
    <?php print pop_callback(); ?>
    <?php       
            global $user;
            
            if ($user->uid) {
                print pop_servicerequest();
            } 
    ?>
    <!-- Main navigation -->
    <nav class="main-navigation clearfix span12" role="navigation">
      <div class="leftmainmenu">
        <ul id="nav">
          <li><a href="#s1">Plans</a> <span id="s1"></span>
            <ul class="subs fstsetwidth">
              <?php print cigna_ttk_2_get_plan_menu();?>
            </ul>
          </li>
          <li> <a href="#s2">Assistance</a> <span id="s2"></span>
            <ul class="subs sctsetwidth">
              <li>
                <ul>
                  <!--                  <li><a href="#">Call Back Facility</a></li>   -->
                  <li><a href="#" data-reveal-id="myModal777" data-animation="none">Call Back Facility</a></li>
                  <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('claims-process')?>">Claims Process</a></li>
                  <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('featured')?>">Frequently Asked Questions</a></li>
                  <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('grievance-redressal')?>">Complaints & Grievance Redressal</a></li>
                  <li><a href="<?php print $base_url.'/'.drupal_get_path_alias('hospital-locator')?>">Hospital Locator</a></li>
                  <li class="last"><a href="<?php print $base_url.'/'.drupal_get_path_alias('branch-locator')?>">CignaTTK Branches</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="<?php print url(drupal_get_path_alias('health-wellness')); ?>">Health & Wellness</a></li>
          <li class="last"><a href="#s3">My Account</a> <span id="s3"></span>
            <ul class="subs thtsetwidth">
              <li>
                <ul>
                  <li><?php print render($page['user_login']); ?></li>
                  <li><a href="#">Renew Policy</a></li>
                  <?php
                    if ($user->uid) { 
                  ?>
                  <li class="last"><a href="#">Get Tax Receipts</a></li>            
                  <?php
                    }
                    else
                    {
                  ?>
                  <li><a href="#">Get Tax Receipts</a></li>
                  <li class="last"><a href="<?php print $base_url.'/'.drupal_get_path_alias('user/register')?>">Register Now</a></li>
                  <?php      
                    }                        
                  ?>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="rightmainmenu"> <?php print get_topRight_menu(); ?> </div>
    </nav>
    <!-- #main-navigation --> 
    
  </header>
</div>
<!-- #master-header -->
<?php if ($messages): ?>
<div id="messages">
  <div class="section clearfix"> <?php print $messages; ?> </div>
</div>
<!-- /.section, /#messages -->
<?php endif; ?>
<!-- #banner -->

<?php if($is_front): ?>
<hgroup>
  <div class="headerbannerslider">
    <div id="r-slider-wrapper">
      <div id="r-slider-contents-wrapper">
        <div id="r-slider-content-left">
          <div id="first-cat">
            <div class="r-img-wrapa"> <img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/banner.png" />
              <div class="topaddtext">
                <h1><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/need_a_simple.png" /></h1>
                <div class="optionpanel">
                  <ul>
                    <li><span><a href="<?php print $base_url ;?>/quote/suggestion/details?clicked=1">Plans with lower premium</span></a></li>
                    <li><span><a href="<?php print $base_url ;?>/quote/suggestion/details?clicked=2"><span>Plans with comprehensive features</span></a></li>
                    <li><span><a href="<?php print $base_url ;?>/quote/suggestion/details?clicked=3"><span>Plans for specific needs</span></a></li>
                    <li><span><a href="<?php print $base_url ;?>/quote/suggestion/details?clicked=4"><span>Already insured? Get additional cover</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="clear"> </div>
          </div>
          <div id="second-cat">
            <div class="r-img-wrapa"> <img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/banner3.png" />
              <div class="topaddtext">
                <h1><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/i_will_decide.png" /></h1>
                <div class="optionpanel">
                  <ul>
                    <li><span>Plans covering hospitalisation costs</span></li>
                    <li><span>Plans designed for specific needs</span></li>
                    <li><span><a href="<?php print $base_url.'/'.drupal_get_path_alias('plans/indemnity-plans')?>">Show me all CignaTTK plans</a></span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="clear"> </div>
          </div>
          <div id="third-cat">
            <div class="r-img-wrapa"> <img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/banner2.png" />
              <div class="topaddtext">
                <h1><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/how_complex.png" /></h1>
                <div class="optionpanel">
                  <p>Intimidated by all the fine print and jargon?<br />
                    Speak with our advisor & get clarity on anything<br />
                    you need.</p>
                  <ul>
                    <li><span>Speak with CignaTTK advisor</span></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="clear"> </div>
          </div>
          <div id="fourth-cat">
            <div class="r-img-wrapa"> <img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/banner1.png" />
              <?php
                    global $user;
            
                    if ($user->uid)
                    {
/*
                        print '<div class="topaddtext">
                                    <h1> Welcome Back<br />
                                        '.$user->name.'</h1></div>';
*/
                    } 
                    else
                    {
                        print login_banner();
                    }
              ?>
            </div>
            <div class="clear"> </div>
          </div>
          <div id="home">
            <div class="r-img-wrapa"> <img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/homebanner.png" /> </div>
            <div class="clear"> </div>
          </div>
        </div>
      </div>
      <div id="r-slider-category-wrapper">
        <div class="bottompanel">
          <ul>
            <li class="home"><a href="#home">&nbsp;</a></li>
            <li class="first"><a href="#first-cat">SUGGEST AN IDEAL<br />
              PLAN FOR ME</a></li>
            <li class="secnd"><a href="#second-cat">I WILL CHOOSE THE<br />
              PLAN THAT I NEED</a></li>
            <li class="thrd"><a href="#third-cat">I WANT TO TALK TO<br />
              AN ADVISOR</a></li>
            <li class="forth"><a href="#fourth-cat">I AM ALREADY<br />
              A CIGNA TTK CUSTOMER</a></li>
          </ul>
          </ul>
        </div>
      </div>
    </div>
  </div>
</hgroup>
<?php endif; ?>
<!-- #banner -->

<div id="main" class="row clearfix"> 
  <!--
  <div id="content" role="main" class="span11">
-->
  <div id="content" role="main" class="<?php if($is_front){ echo "span11";}else{ echo "span12";}?>">
    <?php #print render($page['user_login']); ?>
    <?php if($path != 'overview' && $path != 'management-team' && $path != 'partners' && $path != 'news-and-media' && $path != 'careers' && $path != 'contact-us'):?>
    <?php if ($title): ?>
    <h1 class="entry-title"> <?php print $title; ?> </h1>
    <?php endif; ?>
    <?php endif;?>
    
    <!-- .entry-header -->
    
    <?php if ($page['sidebar_first']): ?>
    <?php print render($page['sidebar_first']); ?>
    <?php endif; ?>
    <?php
      
        global $base_url, $theme;
        //validate proposer as a adult.
        $arg = arg();
        global $val_path;
 
        if(isset($arg[0]) && isset($arg[1]))
        {
                $val_path = drupal_get_path_alias($arg[0].'/'.$arg[1]);
        }
        $path = arg($index=null,request_path());
        if ($val_path == 'claims-process'){
            echo "<article style='width: 100%;'>";
        }
        else
        {             
                if($page['sidebar_first'] || $page['sidebar_second']) {
                    
                    if($path[0]=='health-and-wellness'){
                        echo '';
                    }else{
                        echo "<article>";
                    }
                    
                }
                else
                {
                    echo "<section>";
                }            
        }
         
      ?>
    <div class="entry-content contectdata <?php if($page['sidebar_first']){ echo '';} else {echo '';}?> 
            <?php if($page['sidebar_second']){
                if(isset($arg[0]) && isset($arg[2]) && $arg[0]=='application' && $arg[2]=='confirmation' ){
                    
                   echo ''; 
                }else{
                    if($path[0]=='health-and-wellness'){
                        echo '';
                    }else{
                        echo 'span8';  
                    }
                      
                }
            }?>">
      <?php if ($tabs): ?>
      <!-- <div class="tabs"> <?php print render($tabs); ?> </div> -->
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php  //print $change_location_content ?>
    </div>
    
    <!-- .post.hentry -->
    <div id="sidebar" role="complementary" class="<?php if($path[0]=='health-and-wellness'){echo 'span3';}else{echo 'span4';}?>">
      <aside class="widget">
        <?php if ($page['sidebar_second']): ?>
        <?php print render($page['sidebar_second']); ?>
        <?php endif; ?>
      </aside>
      <!-- .widget --> 
    </div>
    <!-- #sidebar -->
    <?php
      
        if ($val_path == 'claims-process')
        {
            echo "</article>";
        }
        else
        {             
                if($page['sidebar_first'] || $page['sidebar_second']) {
                    
                    if($path[0]=='health-and-wellness'){
                        echo '';
                    }else{
                        echo "<article>";
                    }
                }
                else
                {
                    echo "</section>";
                }            
        }     
         
      ?>
    
    <!-- .entry-content -->    
    <?php if($is_front): ?>
    <!-- .entry-header -->
    
    <div class="entry-content">
      <?php if (isset($page['bottom_data'])): ?>
        <?php print render($page['bottom_data']); ?>
      <?php endif; ?>        
      <div class="topsection">
        <div class="topbolg">
          <section>
            <div class="toptitle"> <span class="iconimg"><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/m_icon.png" width="45" height="61" alt=""></span>
              <h1>QUICK QUOTE</h1>
            </div>
            <p><b>Quick</b> Quote is the fastest way to view and purchase a plan that suits your requirement. Enter a few basic details and get a no obligation quote – instantly.</p>
            <div class="getquot"><a href="<?php print $base_url.'/'.drupal_get_path_alias('quick-quote')?>">Get Quote</a></div>
          </section>
        </div>
        <div class="topbolg">
          <section>
            <div class="toptitle"> <span class="iconimgh"><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/h_icon.png" width="59" height="61" alt=""></span>
              <h1>HOSPITAL LOCATOR</h1>
            </div>
            <p>Hospital Locator is the easiest way to find a CignaTTK network hospital near you. Select a location and we'll help you locate from 3000 hospitals across India.</p>
            <div class="getquot"><a href="<?php print $base_url.'/'.drupal_get_path_alias('hospital-locator')?>">Find Network Hospitals</a></div>
          </section>
        </div>
        <div class="topbolg">
          <section>
            <div class="toptitle"> <span class="iconimgh"><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/W_icon.png" width="61" height="61" alt=""></span>
              <h1>WHY CIGNA-TTK?</h1>
            </div>
            <h3>World wide emergency cover</h3>
            <p>Cigna-TTK products are the only ones that cover you, no matter where you travel. Mauris sodales diam et .</p>
            <div class="getquot"><a href="<?php print $base_url.'/'.drupal_get_path_alias('overview')?>">Learn More</a></div>
          </section>
        </div>
      </div>
    </div>
    <!-- .entry-content --> 
    
    <!-- .post.hentry --> 
    
  </div>
  <?php endif; ?>
  <!-- #content --> 
  
</div>
<!-- #sidebar -->

</div>

<!-- #main -->
<div class="bottomborder"></div>
<footer id="footer" role="contentinfo">
  <div class="footermenu">
    <div class="footerblog">
      <aside> <?php print render($page['footer_firstcolumn']); ?> </aside>
    </div>
    <div class="footerblog">
      <aside> <?php print render($page['footer_secondcolumn']); ?> </aside>
    </div>
    <div class="footerblog">
      <aside> <?php print render($page['footer_thirdcolumn']); ?> </aside>
    </div>
    <div class="footerblog">
      <aside> <?php print render($page['footer_fourthcolumn']); ?> </aside>
    </div>
    <div class="footerblog">
      <aside> <?php print render($page['footer_fifthcolumn']); ?> </aside>
    </div>
    <div class="footerblog">
      <aside> <?php print render($page['footer_sixthcolumn']); ?> </aside>
    </div>
  </div>
</footer>
<div id="bottomfooter">
  <div class="footerlogo"><a href="index.html"><img src="<?php echo $base_url;?>/sites/all/themes/cigna_ttk_2/images/bottom_logo.png" width="131" height="40" alt=""></a></div>
  <div class="footermiddle">Insurance is the subject matter of solicitation</div>
  <div class="rightfooter">
    <p>CignaTTK Insurance  Ltd. IRDA Registration No. 123.
      For more details on terms and conditions, exclusions and waiting period, please read sales brochure before concluding a sale. <br />
      Registered office: The Executive Centre, The Capital, Plot C-70, G
      Block, Bandra Kurla Complex, Mumbai 400051 </p>
  </div>
</div>
<div id="footercopy">
  <p>&copy; 2013 CignaTTK. All rights reserved</p>
</div>
<!-- /.section, /#footer-wrapper --> 
<!-- Script For Disqus --> 
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'cignattkdev'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js?https';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script> 
<!-- --> 
