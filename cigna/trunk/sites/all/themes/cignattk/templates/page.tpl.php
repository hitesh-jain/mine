<?php global $base_url; 
    
        $front=$is_front;
        if($front){
            unset($_SESSION['show_all_plans']);
        }

?>
<div id="master-header">
  <header class="clearfix" role="banner">
    <hgroup>
      <h1 id="site-title">
        <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> </a>
        <?php endif; ?>
        </a></h1>
      <div id='cssmenu'>
        <ul>
          <?php print cignattk_get_top_menu();?>
          
                  </ul>
        <?php print render($page['header']); ?> </div>
    </hgroup>
    <?php global $base_url;?>
    <!-- Main navigation -->
    <nav class="main-navigation clearfix span12" role="navigation">
      <div class="dcjq-mega-menu">
        <ul id="mega-menu-tut" class="menu">
          <li><a href="#">Plans</a>
            <ul>
              <span class="closed" style="float:right; margin-top:-18px; margin-right:-10px; cursor:pointer;"></span> <?php print cignattk_get_plan_menu();?>
            </ul>
          </li>
          <li><a href="#">EMERGENCY</a>
            <ul>
              <li>
                <ul>
                  <div class="leftdata">
                    <p class="listname"><a href="<?php print $base_url.'/'.drupal_get_path_alias('claims-process')?>"><strong>Claims Process</strong></a> Understand the process of initiating a claim and what to do if you have already initiated one. </p>
                    <p class="listname"><a href="<?php print $base_url.'/'.drupal_get_path_alias('hospital-locator')?>"><strong>Hospital Locator</strong></a> Search by location, pin code </p>
                    <span></span>
                    <p class="listname"><strong>Cigna TTK Branches</strong> <br/>
                      Search by location, pin code </p>
                  </div>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">ASSISTANCE</a>
            <ul>
              <li>
                <ul>
                  <div class="leftdata">
                    <p class="listname"><strong>Want us to call you back?</strong> <br/>
                      Give us your phone number and our expert will call you back </p>
                    <p class="listname"><a href="<?php print $base_url.'/'.drupal_get_path_alias('claims-process')?>"><strong>What to do when you need to claim?</strong></a> View the Claims process </p>
                    <p class="listname"><a href="<?php print $base_url.'/'.drupal_get_path_alias('featured')?>"><strong>Frequently Asked Questions</strong></a> See all answers to questions asked by others </p>
                    <p class="listname"><a href="<?php print $base_url.'/'.drupal_get_path_alias('grievance-redressal')?>"><strong>Complaints and Grievance Redressal</strong></a> Contact senior officials for policy or claim related issues not resolved yet </p>
                  </div>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">MY ACCOUNT</a>
            <ul>
              <li>
                <ul>
                  <div class="leftdata"> <?php print render($page['user_login']); ?> 
                    <!--<p class="listname"><strong>Login</strong>
                        <br/>Manage your existing policies and Access additional services
                    </p>
                    <p class="listname"><strong>Renew Policy</strong>
                        <br/>Add your policy number and renew instantly
                    </p>
                    <p class=""><strong>Get Tax Receipts</strong>
                        <br/>Add your policy number and get your premium paid receipt fo rtax filing
                    </p>
                    <p class="listname"><strong>Register Now</strong>
                        <br/>New User? Add a few personal details and register
                    </p> --> 
                  </div>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <?php /*print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => 'main-menu-links',
            'class' => array('links', 'clearfix'),
          ),
          'heading' => array(
            'text' => t('Main menu'),
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        ));*/?>
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
<div id="main" class="row clearfix">
  <?php if ($breadcrumb): ?>
  <div id="breadcrumb"><?php print $breadcrumb; ?></div>
  <?php endif; ?>
  <?php if ($site_name || $site_slogan): ?>
  <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>
    <?php if ($site_name): ?>
    <?php if ($title): ?>
    <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>> <strong> <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a> </strong> </div>
    <?php else: /* Use h1 when the content title is empty */ ?>
    <h1 class="entry-title" id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>> <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a> </h1>
    <?php endif; ?>
    <?php endif; ?>
    <?php if ($site_slogan): ?>
    <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>> <?php print $site_slogan; ?> </div>
    <?php endif; ?>
  </div>
  
  <!-- /#name-and-slogan -->
  <?php endif; ?>
  <div id="content" role="main" class="span12">
    <?php if($path != 'overview' && $path != 'management-team' && $path != 'partners' && $path != 'news-and-media' && $path != 'careers' && $path != 'contact-us'):?>
    <?php if ($title): ?>
    <h1 class="entry-title"> <?php print $title; ?> </h1>
    <?php endif; ?>
    <?php endif;?>
    <article class="post hentry">
      <header class="entry-header"> </header>
      <!-- .entry-header -->
      <?php if ($page['sidebar_first']): ?>
      <?php print render($page['sidebar_first']); ?>
      <?php endif; ?>
      <article>
        
        <div class="entry-content contectdata <?php if($page['sidebar_first']){ echo 'span9';} else {echo 'span12';}?> <?php if($page['sidebar_second']){ echo 'span6';} else {echo 'span12';}?>">
          <?php if ($tabs): ?>
          <div class="tabs"> <?php print render($tabs); ?> </div>
          <?php endif; ?>
          <?php print render($page['content']); ?> <?php  //print $change_location_content ?> </div>
      </article>
      <!-- .entry-content --> 
      
      <!-- .post.hentry -->
      <div id="sidebar" role="complementary" class="span4">
        <aside class="widget">
          <?php if ($page['sidebar_second']): ?>
            <?php print render($page['sidebar_second']); ?>
          <?php endif; ?>
        </aside>
        <!-- .widget --> 
        
      </div>
      <!-- #sidebar --> 
    </article>
  </div>
  <!-- #content --> 
</div>
<!-- #main -->
<div id="footer-wrapper">
  <div class="section">
    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn'] || $page['footer_fifthcolumn'] || $page['footer_sixthcolumn']): ?>
    <div id="footer-columns" class="clearfix"> <?php print render($page['footer_firstcolumn']); ?>
      <div class="change-location"><?php //print $change_location_link; ?> </div>
      <?php print render($page['footer_secondcolumn']); ?> <?php print render($page['footer_thirdcolumn']); ?> <?php print render($page['footer_fourthcolumn']); ?> <?php print render($page['footer_fifthcolumn']); ?> <?php print render($page['footer_sixthcolumn']); ?> </div>
    <!-- /#footer-columns -->
    <?php endif; ?>
    <?php if ($page['footer']): ?>
    <div id="footer" class="clearfix"> <?php print render($page['footer']); ?> </div>
    <!-- /#footer -->
    <?php endif; ?>
  </div>
</div>
<!-- /.section, /#footer-wrapper --> 
