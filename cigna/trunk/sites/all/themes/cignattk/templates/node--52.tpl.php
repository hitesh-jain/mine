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
?>
<?php global $base_url;  ?>
<?php drupal_add_css(drupal_get_path('theme','cignattk').'/css/royalslider.css'); ?>
<?php drupal_add_css(drupal_get_path('theme','cignattk').'/css/rs-default-inverted.css'); ?>
<?php drupal_add_css(drupal_get_path('theme','cignattk').'/css/reset.css'); ?>
<?php drupal_add_css(drupal_get_path('theme','cignattk').'/css/rs-default-inverted.css'); ?>
<?php drupal_add_js(drupal_get_path('theme','cignattk').'/js/ga.js'); ?>
<?php drupal_add_js(drupal_get_path('theme','cignattk').'/js/jquery-1.js'); ?>
<?php drupal_add_js(drupal_get_path('theme','cignattk').'/js/jquery.js'); ?>


<style>
#homeSlider {
	font-weight:normal;
	width: 100%;
	font-family: Arial;
	font-size:12px;
}
#homeSlider .rsThumbsHor {
	height: 145px;
	padding: 0;
	position:absolute;
	background:#ededed;
}
.rsOverflow {
	float:left;
	margin-top:165px;
	height:280px !important;
}
.rsDefaultInv, .rsDefaultInv .rsOverflow, .rsDefaultInv .rsSlide, .rsDefaultInv .rsVideoFrameHolder, .rsDefaultInv .rsThumbs {
	background: #FFF;
}
.rsDefaultInv .rsThumb.rsNavSelected {
	background: #fff;
	color: #000;
}
#homeSlider .example-link {
	padding: 5px 12px 6px;
	color: #FFF;
	background: #FFF;
	position: absolute;
	color: #BB0202;
	right: 12px;
	bottom: 12px;
	text-decoration: none;
	font-weight: normal;
}
#homeSlider > .rsContent {
	height: auto;
}
.royalSlider > .rsContent h1, .royalSlider > .rsContent h2, .royalSlider > .rsContent img, .royalSlider > .rsContent .example-link {
	display: none;
}
#homeSlider .example-link:hover {
	text-decoration: none;
	background: #C00;
	color: #FFF;
}
.rsWebkit3d .example-link {
	-webkit-backface-visibility: hidden;
	-webkit-transform: translateZ(0);
}
#homeSlider .rsThumb {
	width: 163px;
	height: 134px;
	cursor: pointer;
	margin-top:12px;
}
#homeSlider .rsTmb {
	text-align: center;
	margin-top: 11px;
	font-weight: bold;
}
#homeSlider .rsThumb i {
	font-style: normal;
	font-weight: normal;
	font-family:Arial;
	font-size:12px;
}
.rsSlideTitle {
	font-size: 24px;
	padding: 11px 13px 14px;
	background: #c00;
	background: rgba(220, 0, 0, 0.6);
	color: #FFF;
	font-weight: normal;
	margin: 0;
	line-height: 21px;
}
.rsFirstSlideTitle {
	left: 12%;
	top: 74px;
}
.rsSecondSlideTitle {
	left: 12%;
	top: 124px;
}
@media screen and (min-width: 0px) and (max-width: 960px) {
 .rsSlideTitle {
 font-size: 18px;
 padding: 10px 12px 12px;
}
 .rsFirstSlideTitle {
 left: 8%;
 top: 54px;
}
 .rsSecondSlideTitle {
 left: 8%;
 top: 99px;
}
 #homeSlider .rsThumb {
 font-size: 12px;
 width: 115px;
 height: 134px;
 cursor: pointer;
}
 #homeSlider .rsTmb {
 margin-top: 12px;
}
}
 @media screen and (min-width: 0px) and (max-width: 500px) {
 .royalSlider {
 height: 300px !important;
}
 .rsSlideTitle {
 font-size: 14px;
 padding: 8px 10px 8px;
}
 .rsFirstSlideTitle {
 left: 24px;
 top: 24px;
}
 .rsSecondSlideTitle {
 left: 24px;
 top: 63px;
}
}
</style>

            <h2 class="entry-title">Management Team</h2>
            <div class="datagride" style="padding-right:15px; padding-top:30px;">
              <div class="full-width-wrap clearfix">
                <div class="row wrapper">
                  <div class=" col fwImage">
                    <div id="homeSlider" class="royalSlider rsDefaultInv">
                      <div class="rsContent" data-rsDelay="2500" style="background: #FFF;">
                        <p><strong>Lorem ipsum</strong><br/>
                          President and CEO</p>
                        <p><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/paul.jpg" width="72" height="58" alt="" style="float:left; padding-right:10px;" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu neque nulla. In ante
                          erat, iaculis at fringilla vitae, vestibu vel neque. Nulla facilisi. Etiam sem ligula,
                          imperdiet in. In ante erat, iaculis at fringilla vitae, vestibu. ensure the future well-being
                          and security of the customers the company serves.</p>
                        <p>Before he was named Cigna CEO, Cordani served as president of Cigna HealthCare (since July 2005); prior to that
                          he was responsible for distribution, marketing, and underwriting for all customer segments as president of Health
                          Segments for Cigna HealthCare. Cordani has held numerous other executive Cigna positions, and prior to Cigna ,
                          was with Coopers & Lybrand.</p>
                        <p>Cordani joined the Cigna Board of Directors in October 2009. He also serves on the boards of the National
                          Association of Manufacturers and the Cigna Foundation.</p>
                        <p>He received a bachelor's degree from Texas A&M, and an M.B.A. from the University of Hartford. Mr. Cordani is a
                          Chartered Financial Consultant.</p>
                        <i class="rsTmb"><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/paul.jpg" width="72" height="58" alt=""><br>
                        <strong>Lorem ipsum</strong><br>
                        President and CEO</i> </div>
                      <div class="rsContent">   <p><strong>Lorem ipsum</strong><br/>
                          President and CEO</p>
                        <p><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/tahira.jpg" width="72" height="58" alt="" style="float:left; padding-right:10px;" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu neque nulla. In ante
                          erat, iaculis at fringilla vitae, vestibu vel neque. Nulla facilisi. Etiam sem ligula,
                          imperdiet in. In ante erat, iaculis at fringilla vitae, vestibu. ensure the future well-being
                          and security of the customers the company serves.</p>
                        <p>Before he was named Cigna CEO, Cordani served as president of Cigna HealthCare (since July 2005); prior to that
                          he was responsible for distribution, marketing, and underwriting for all customer segments as president of Health
                          Segments for Cigna HealthCare. Cordani has held numerous other executive Cigna positions, and prior to Cigna ,
                          was with Coopers & Lybrand.</p>
                        <p>Cordani joined the Cigna Board of Directors in October 2009. He also serves on the boards of the National
                          Association of Manufacturers and the Cigna Foundation.</p>
                        <p>He received a bachelor's degree from Texas A&M, and an M.B.A. from the University of Hartford. Mr. Cordani is a
                          Chartered Financial Consultant.</p> <a class="example-link" href="/plugins/royal-slider/content-slider/"><i class="rsTmb"><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/tahira.jpg" width="83" height="58" alt=""><br>
                        <strong>Lorem ipsum</strong><br>
                        Chief Medical Officer</i></a> </div>
                      <div class="rsContent">  <p><strong>Lorem ipsum</strong><br/>
                          President and CEO</p>
                        <p><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/amit.jpg" width="72" height="58" alt="" style="float:left; padding-right:10px;" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu neque nulla. In ante
                          erat, iaculis at fringilla vitae, vestibu vel neque. Nulla facilisi. Etiam sem ligula,
                          imperdiet in. In ante erat, iaculis at fringilla vitae, vestibu. ensure the future well-being
                          and security of the customers the company serves.</p>
                        <p>Before he was named Cigna CEO, Cordani served as president of Cigna HealthCare (since July 2005); prior to that
                          he was responsible for distribution, marketing, and underwriting for all customer segments as president of Health
                          Segments for Cigna HealthCare. Cordani has held numerous other executive Cigna positions, and prior to Cigna ,
                          was with Coopers & Lybrand.</p>
                        <p>Cordani joined the Cigna Board of Directors in October 2009. He also serves on the boards of the National
                          Association of Manufacturers and the Cigna Foundation.</p>
                        <p>He received a bachelor's degree from Texas A&M, and an M.B.A. from the University of Hartford. Mr. Cordani is a
                          Chartered Financial Consultant.</p> <a class="example-link" href="/plugins/royal-slider/video-gallery/"><i class="rsTmb"><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/amit.jpg" width="72" height="58" alt=""><br>
                        <strong>Lorem ipsum</strong><br>
                        Executive President</i></a> </div>
                      <div class="rsContent">   <p><strong>Lorem ipsum</strong><br/>
                          President and CEO</p>
                        <p><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/aniruddha.jpg" width="72" height="58" alt="" style="float:left; padding-right:10px;" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu neque nulla. In ante
                          erat, iaculis at fringilla vitae, vestibu vel neque. Nulla facilisi. Etiam sem ligula,
                          imperdiet in. In ante erat, iaculis at fringilla vitae, vestibu. ensure the future well-being
                          and security of the customers the company serves.</p>
                        <p>Before he was named Cigna CEO, Cordani served as president of Cigna HealthCare (since July 2005); prior to that
                          he was responsible for distribution, marketing, and underwriting for all customer segments as president of Health
                          Segments for Cigna HealthCare. Cordani has held numerous other executive Cigna positions, and prior to Cigna ,
                          was with Coopers & Lybrand.</p>
                        <p>Cordani joined the Cigna Board of Directors in October 2009. He also serves on the boards of the National
                          Association of Manufacturers and the Cigna Foundation.</p>
                        <p>He received a bachelor's degree from Texas A&M, and an M.B.A. from the University of Hartford. Mr. Cordani is a
                          Chartered Financial Consultant.</p><a class="example-link" href="/plugins/royal-slider/gallery/"><i class="rsTmb"><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/aniruddha.jpg" width="72" height="58" alt=""><br>
                        <strong>Lorem ipsum</strong><br>
                        Vice President</i></a> </div>
                      <div class="rsContent">   <p><strong>Lorem ipsum</strong><br/>
                          President and CEO</p>
                        <p><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/aniruddha.jpg" width="72" height="58" alt="" style="float:left; padding-right:10px;" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu neque nulla. In ante
                          erat, iaculis at fringilla vitae, vestibu vel neque. Nulla facilisi. Etiam sem ligula,
                          imperdiet in. In ante erat, iaculis at fringilla vitae, vestibu. ensure the future well-being
                          and security of the customers the company serves.</p>
                        <p>Before he was named Cigna CEO, Cordani served as president of Cigna HealthCare (since July 2005); prior to that
                          he was responsible for distribution, marketing, and underwriting for all customer segments as president of Health
                          Segments for Cigna HealthCare. Cordani has held numerous other executive Cigna positions, and prior to Cigna ,
                          was with Coopers & Lybrand.</p>
                        <p>Cordani joined the Cigna Board of Directors in October 2009. He also serves on the boards of the National
                          Association of Manufacturers and the Cigna Foundation.</p>
                        <p>He received a bachelor's degree from Texas A&M, and an M.B.A. from the University of Hartford. Mr. Cordani is a
                          Chartered Financial Consultant.</p> <a class="example-link" href="/plugins/royal-slider/visible-nearby/"><i class="rsTmb"><img src="<?php echo drupal_get_path('theme','cignattk');?>/images/aniruddha.jpg" width="72" height="58" alt=""><br>
                        <strong>Lorem ipsum</strong><br>
                        President and CEO</i></a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <script>
      jQuery(document).ready(function($) {
  var opts = {
    controlNavigation:'thumbnails',
    imageScaleMode: 'fill',
    arrowsNav: false,
    arrowsNavHideOnTouch: true,
    fullscreen: false,
    loop: false,
    thumbs: {
      firstMargin: false,
      paddingBottom: 0
    },
    numImagesToPreload: 3,
    thumbsFirstMargin: false,
    autoScaleSlider: true, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 600,
    keyboardNavEnabled: true,
    navigateByClick: true,
    fadeinLoadedSlide: true,
    imgWidth: 707,
    imgHeight: 397
  };
  ///* if(!$.browser.webkit) {
    opts.imgWidth = 707;
    opts.imgHeight = 397;
  //} */
  var sliderJQ = jQuery('#homeSlider').royalSlider(opts);

});
    </script> 
            </div>

