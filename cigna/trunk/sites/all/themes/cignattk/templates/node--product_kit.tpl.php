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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
    $( "#accordion3,#accordion4,#accordion" ).accordion({
      collapsible: true,
      heightStyle: "content"
    });
  });
  </script> 
<?php $sub_plan_ids=array();?>
<?php foreach($node->subplans as $key=>$value):?>
    <?php $sub_plan_ids[] = $key;?>
<?php endforeach;?>
<?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
<?php endif; ?>
<?php $attributes = get_plans_attributes($sub_plan_ids,$node->nid);?>
<div style="border: 1px #000 solid;height:400px;padding: 38px;">
    <div class="left" style="float: left;width: 506px;">
        <img src="<?php echo file_create_url($node->uc_product_image[und][0][uri]);?>"/>
        <?php if($_SESSION['quick_quote'][$node->nid]):?>
        <div style="float: right;margin-top: 12px;">
            <ul><li>ADULTS <b><?php echo $_SESSION['quick_quote']['no_adults']?></b> CHILD <b><?php echo $_SESSION['quick_quote']['no_child']?></b></li>
            <li>TERM: <b><?php echo $_SESSION['quick_quote'][$node->nid]['tenure']?></b> YEARS</li>
            <li>SUM INSURED: Rs. <b><?php echo $_SESSION['quick_quote'][$node->nid]['sumInsured']?></b></li></ul>
        </div>
        <?php endif;?>
        <hr />
        <?php foreach($attributes as $attribs):?>
            <h3><?php echo $attribs['label']?></h3>
                <?php $opts = get_plans_attributes_options($sub_plan_ids,$node->nid,$attribs['aid']);?>
                <?php echo count($opts);?>
        <?php endforeach;?>
    </div>
    <div class="right" style="float: right;">
            <span>Medical tests are compulsory if<br />
                    above 60 years and opted<br />
                    above 4 lakhs</span>
            <div class="viewd" style="height:200px"><a href="#" class="big-link" data-reveal-id="myModal13" data-animation="none">EXPERT'S VIEW</a></div>
            <?php if($_SESSION['quick_quote'][$node->nid]['basePremium']):?>
                <div id="premium">PREMIUM: <b><?php echo $_SESSION['quick_quote'][$node->nid]['basePremium']?></b></div>
            <?php endif;?>
            <img src="<?php echo drupal_get_path("theme","cignattk");?>/images/buynow.png"/>
    </div>
</div>
<div style="clear: both;"></div>
<?php foreach($attributes as $attribs):?>
<div id="accordion">
    <h3><?php echo $attribs['label']?></h3>
        <?php $options = get_plans_attributes_options($sub_plan_ids,$node->nid,$attribs['aid']);?>
            <div id="accordion<?php echo $attribs['aid'] ?>">
                <?php foreach($options as $option):?>
                  <h3><?php echo $option['name'] ?></h3>
                  <div>
                    <p>
                        <?php echo $option['description'];?>
                    </p>
                  </div>
                <?php endforeach;?>
            </div>
</div>
<?php endforeach;?>
<div id="myModal13" class="reveal-video-modal"><?php //print render_video($node->field_plan_video[und][0]['uri'],960,400);?><a class="close-reveal-modal"><img src="sites/all/themes/cigna_ttk_2/images/closed.png" /></a></div>



    


