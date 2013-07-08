<?php

/**
 * Add body classes if certain regions have content.
 */
function cigna_ttk_2_preprocess_html(&$variables) {

}

/**
 * Override or insert variables into the page template for HTML output.
 */
function cigna_ttk_2_process_html(&$variables) {
 
}

/**
 * Override or insert variables into the page template.
 */
function cigna_ttk_2_preprocess_page(&$variables) {
    
    global $base_url, $theme;
    //validate proposer as a adult.
    $arg = arg();
/* for the title of login page customize */ 
    
    if( isset($arg[0]) && $arg[0]=='user' && isset($arg[1]) && $arg[1]=='password'){        
        drupal_set_title('CignaTTK Password Regenerate');        
    }    
    elseif( isset($arg[0]) && $arg[0]=='user' && isset($arg[1]) && $arg[1]=='register'){        
        drupal_set_title('Register to create CignaTTK account');        
    }
    else if( isset($arg[0]) && $arg[0]=='user'){
        drupal_set_title('Login to your CignaTTK account');
    }

    if(!empty($variables['page']['content']['system_main']['nodes'])){
        
        $variables['plans'] = $variables['page']['content']['system_main']['nodes'];
    }
    
    if(!empty($arg['2'])){
        $term = taxonomy_term_load($arg['2']);
        if(!empty($term)){
           $vocab_name = $term->vocabulary_machine_name; 
        }
        
    }
    if($arg[0] == "taxonomy" && $arg[1] == "term") {
        drupal_set_title('');
        if($vocab_name == 'health_and_wellness'){
            $variables['hwnodes'] = $variables['page']['content']['system_main']['nodes'];
            $variables['hwpager'] = $variables['page']['content']['system_main']['pager'];
        }
        $variables['page']['content']['system_main']['nodes'] = null;
        $variables['page']['content']['system_main']['pager'] = null;
      }
      /*$node = menu_get_object('node');
      if(!empty($node)){
        if($node->type = 'plan'){
        $node_title = _plan_ws_short_name($node->nid);
        drupal_set_title($node_title);
        }
      }*/
      
      
      
      
      /*
      ctools_include('ajax');
      ctools_include('modal');
      ctools_modal_add_js();*/
        
      /*  
      $sample_style = array(
        'happy-modal-style' => array(
          'modalSize' => array(
            'type' => 'fixed',
            'width' => 600,
            'height' => 240,
            'addWidth' => 10,
            'addHeight' => 10,
            'contentRight' => 0,
            'contentBottom' => 0,
          ),
          'modalOptions' => array(
            'opacity' => .6,
            'background-color' => '#684C31',
          ),
          'animation' => 'fadeIn',
          'modalTheme' => 'happy_modal',
          // Customize the AJAX throbber like so:
          // This function assumes the images are inside the module directory's "images"
          // directory:
          // ctools_image_path($image, $module = 'ctools', $dir = 'images')
          'throbber' => theme('image', array('path' => ctools_image_path('ajax-loader.gif', 'happy'), 'alt' => t('Loading...'), 'title' => t('Loading'))),
          'closeImage' => theme('image', array('path' => ctools_image_path('modal-close.png', 'happy'), 'alt' => t('Close window'), 'title' => t('Close window'))),
        ),
      );  
        
        drupal_add_js($sample_style, 'setting');
        ctools_add_js('quick-quote', 'quick_quotation');
        ctools_add_css('quick-quote', 'quick_quotation');*/
        

   // $variables['ctools_links'] = ctools_modal_text_button(t('Quick Quote'), 'quick_quotation/nojs/page', t(' I am looking.'),'ctools-use-modal');      
     $variables['path']= drupal_get_path_alias($_GET['q']);
      
}
 


/**
 * Override or insert variables into the node template.
 */
function cigna_ttk_2_preprocess_node(&$variables) {
    $arg = arg();
    if($variables['type'] == 'health_wellness' && $arg['0'] == 'node'){
        $nid = $variables['nid'];
        // to manage most read article 
        most_read_article($nid);
    }
}


function cigna_ttk_2_preprocess_taxonomy_term(&$variables) {
    // render most recent post
    $variables['hwnodes'] = array();
	$variables['hwpager'] = '';
    $tid = $variables['tid'];
    
    $query=db_select('node','n')->extend('PagerDefault')->limit(2);
    $query->join('taxonomy_index','ti','ti.nid = n.nid');
    $query->fields('n',array('nid'))
          ->condition('n.type','health_wellness')
          ->condition('ti.tid',$tid)
          ->condition('n.status',1);
          
    $results=$query->execute();
    foreach($results as $node_value){
        
            $node=node_load($node_value->nid);
        
    $variables['hwnodes'][$node_value->nid]=$node;
    }
    $variables['hwpager'] = theme('pager');
    //dpr($variables['hwpager']);die;
    
}
/**
 * Override or insert variables into the block template.
 */
function cigna_ttk_2_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function cigna_ttk_2_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function cigna_ttk_2_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}

/**
 * 
 * Render categories and plans for menus. 
 */
 
 function cigna_ttk_2_get_plan_menu_old(){
        $plan_categories=taxonomy_vocabulary_machine_name_load('plans');
        $categories=taxonomy_get_tree($plan_categories->vid);
        foreach($categories as $category){
            $term = taxonomy_term_load($category->tid);
            $plan_nids = taxonomy_select_nodes($category->tid);
            $term->plans = node_load_multiple($plan_nids);
            $plans_categories[] = $term;
        }
        foreach($plans_categories as $category){
        $output .='<li><ul>';
        $output .='<div class="leftdata">'.l($category->name,'taxonomy/term/'.$category->tid).'<br />
                    ('.$category->field_short_note[und][0][value].')<img src="'.drupal_get_path("theme","cigna_ttk_2").'/images/sound.png" width="31" height="20" alt="" style="float:right">
                        <p style="padding-top:8px;">'.cigna_ttk_2_truncate($category->description,'200').'</p>';
                    foreach($category->plans as $plan){
                            if($plan->type == 'product_kit')
                            $output .='<p class="listname">'.l($plan->title,'node/'.$plan->nid).'</p>';
                      }
        $output .='</div>';
        $output .='</ul></li>';
        } // endforeach
        return $output;
 }
 
 function cigna_ttk_2_get_plan_menu(){
        $plan_categories=taxonomy_vocabulary_machine_name_load('plans');
        $categories=taxonomy_get_tree($plan_categories->vid);
        foreach($categories as $category){
            $term = taxonomy_term_load($category->tid);
            $plan_nids = taxonomy_select_nodes($category->tid);
            $term->plans = node_load_multiple($plan_nids);
            $plans_categories[] = $term;
        }
				                  		
        $output ="<li><ul>";  

		$total_sub_cat = count($plans_categories);
		$i = 0;
		
        foreach($plans_categories as $category)
		{		
            //dpr($category);die;
			if (++$i === $total_sub_cat)
			{
				$output .='<li class="last">'.l($category->field_short_note['und']['0']['value'],'taxonomy/term/'.$category->tid).'</li>';
			}
			else
			{
				$output .='<li>'.l($category->field_short_note['und']['0']['value'],'taxonomy/term/'.$category->tid).'</li>';
			}			
        } // endforeach
        
        $output .='</ul></li>';       
        return $output;
}
 
 /**
  * To chop the string after specific charaters.
  */
  function cigna_ttk_2_truncate($str, $len) {
    $tail = max(0, $len-10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len-$tail))));
    return $trunk;
}
 function cigna_ttk_2_get_top_menu(){
    global $base_url;
    $class = '';
    $output ='';
    $tree = menu_tree_output(menu_tree_all_data('menu-top-menu',NULL,2));
    foreach($tree as $menu){
        if(isset($menu['#title'])){
            if($menu['#title']=='HOME'){
                $output .='<li><a href="'.$base_url.'" class="first"><span>'.$menu['#title'].'</span></a></li>';
            }else{
                $output .='<li><a href="'.$base_url.'/'.drupal_get_path_alias($menu['#href']).'" class="'.$class.'"><span>'.$menu['#title'].'</span></a></li>';
            }
        }
    }
    return $output;
 }
 
function object_to_array($data) 
 {
    if ((! is_array($data)) and (! is_object($data))) return 'none'; //$data;
    
    $result = array();
    
    $data = (array) $data;
    foreach ($data as $key => $value) {
        if (is_object($value)) $value = (array) $value;
        if (is_array($value)) 
        $result[$key] = object_to_array($value);
        else
            $result[$key] = $value;
    }
    
    return $result;
}
 
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}

function array_unique_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_unique($sort_col, $dir, $arr);
    
}



function render_video($uri,$width,$height){
    $height = $height? $height:'480';
    $width = $width ? $width:'630';
    if($uri){
        $video_url = file_create_url($uri);
        $config = array(
            'clip' => array(
              'url' => $video_url,
              'autoPlay' => FALSE,
            ),
            'onLoad' => 'flowplayerAdminInit',
          );
        $video = theme('flowplayer', array('config' => $config, 'id' => 'flowplayer', 'attributes' => array('style' => 'width:'.$width.'px;height:'.$height.'px;')));
        return $video;    
    }
}

// for search button -- waseem
function cigna_ttk_2_form_alter(&$form, &$form_state, $form_id) {
    
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = '';  // define size of the textfield
    $form['search_block_form']['#default_value'] = t(''); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t(''); // Change the text on the submit button
//    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search.png');
//    $form['actions']['submit'] = array('#type' => 'button', );
    $form['actions']['submit']['#attributes']['class'][] = 'searchbxt';
    $form['actions']['submit']['#attributes']['id'][] = t('searchbtn');    

    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = 'if (this.value == "") {this.value = "Search";}';
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    // Prevent user from searching the default text
    $form['#attributes']['onsubmit'] = "if(this.search_block_form.value==''){ alert('Please enter a keyword to search'); return false; }";

    // Alternative (HTML5) placeholder attribute instead of using the javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');        
    $form['search_block_form']['#attributes']['class'][] = t('searchbx');
    $form['search_block_form']['#attributes']['id'][] = t('search');
    //$form['search_block_form']['#attributes']['value'][] = t('Search');         
  }  
    
  if ($form_id == "user_login") 
  {
    global $base_url;
   
//    unset($form['links']); // Remove Request New Password and other links from Block form
//    $form['#prefix'] = '<div class="loginpage">';
//    $form['#suffix'] = '</div>';
    $form['name']['#title'] = t("Username"); // Change text on form
    
    $form['new_user']=array(
        '#markup'=>'<div class="formdetails">
            <div class="newuser"><a href="'.$base_url.'/user/register">New User? Click here to register</a></div>
            <div class="agent"><a href="'.$base_url.'/agents">Agent Login</a></div>
          </div>',  
        '#weight'=>8,   
    );
    
    $form['userlogin_fb_title'] =array(
        '#markup'=>'<div class="rightconnect"><p>CONNECT USING FACEBOOK</p></div>',
        '#weight' => 10,        
    );
    
    $form['goThroughSteps'] =array(
        '#markup'=>'<div class="goThroughSteps"><a href="#">Why do I need to go through these steps?</a></div>',  
        '#weight'=>11,
    );
    
    //dpr($form);exit;
    
    //place forgotten password link after the password field  
    //$form['password']['#suffix'][] = l(t('New User? Click here to register'), 'user/register', array('attributes' => array('class' => 'newuser', 'title' => t('New User? Click here to register'))));
    //$form['password']['#suffix'][] = l(t('Agent Login'), 'agents', array('attributes' => array('class' => 'agent', 'title' => t('Agent Login'))));        
    
  }       
                   
  if ($form_id == "user_register_form") 
  {
    //dpr($form); exit; 
    
    $form['goThroughSteps'] =array(
        '#markup'=>'<div class="goThroughSteps"><a href="#">Why do I need to go through these steps?</a></div>',  
        '#weight'=>11,        
    );
    
    $form['userregister_fb_title'] =array(
        '#markup'=>'<div class="rightconnect"><p>CONNECT USING FACEBOOK</p></div>',
       // '#weight' => 10,        
    );
  
  } 

}

function get_topRight_menu(){
    
        global $user, $base_url, $theme;
        //validate proposer as a adult.
        $arg = arg();
        
        $output ="<ul>";
        
        $rightmenu = array( 'ABOUT CIGNA-TTK' => 'overview',
                            'AGENTS' => 'agents',
                            'CLAIMS PROCESS' => 'claims-process',
                            'SERVICE REQUEST' => '#',
                           );
        
        $total_rmenu = count($rightmenu);
		$i = 0;
        
        foreach ( $rightmenu as $k => $v){ 
            
                if (++$i === $total_rmenu)
    			{
    				$output .='<li class="last">';
    			}
    			else
    			{
    				$output .='<li>';
    			}
        if(isset($arg[0]) && isset($arg[1]))
            {
                $val = drupal_get_path_alias($arg[0].'/'.$arg[1]);
                if ( $val == $v){                    
                    $output.= '<a href="'.$base_url.'/'.drupal_get_path_alias($v).'" class="active">'.$k.'</a></li>';
                }
                else{                    
                    $output.= '<a href="'.$base_url.'/'.drupal_get_path_alias($v).'">'.$k.'</a></li>';
                }
            }
            else{                    
                    $output.= '<a href="'.$base_url.'/'.drupal_get_path_alias($v).'">'.$k.'</a></li>';
                }
                
            /*                
            if(isset($arg[0]) && isset($arg[1]))
            {
                $val = drupal_get_path_alias($arg[0].'/'.$arg[1]);
                
//                dpr($val); exit;               
                
                if ( $val == $v)
                {   
                    if ($k == 'SERVICE REQUEST')
                    {
                        if ($user->uid) {
                            $output .= '<a href="" data-reveal-id="myModal778" data-animation="none" class="active">'.$k.'</a></li>';
                        }
                        else{
                            $output .= '<a href="'.$base_url.'/user">'.$k.'</a></li>';
                        }
                    }
                    else
                    {
                        $output.= '<a href="'.$base_url.'/'.drupal_get_path_alias($v).'" class="active">'.$k.'</a></li>';
                    }
                }
                else
                {   
                    if ($k == 'SERVICE REQUEST')
                    {
                        if ($user->uid) {
                            $output .= '<a href="" data-reveal-id="myModal778" data-animation="none" >'.$k.'</a></li>';
                        }
                        else{
                            $output .= '<a href="'.$base_url.'/user">'.$k.'</a></li>';
                        }
                    }
                    else
                    {
                        $output.= '<a href="'.$base_url.'/'.drupal_get_path_alias($v).'">'.$k.'</a></li>';
                    }
                }
            }
            else{  
                    if ($k == 'SERVICE REQUEST')
                    {
                        if ($user->uid) {
                            $output .= '<a href="" data-reveal-id="myModal778" data-animation="none" >'.$k.'</a></li>';
                        }
                        else{
                            $output .= '<a href="'.$base_url.'/user">'.$k.'</a></li>';
                        }
                    }
                    else
                    {
                        $output.= '<a href="'.$base_url.'/'.drupal_get_path_alias($v).'">'.$k.'</a></li>';
                    }
                }*/
                
        }
        
        $output .='</ul>';       
        return $output;
}

//function for pop for call back facility
function pop_callback(){ 
    $block = module_invoke('site_structure', 'block_view', 'callback_facility');
    return render($block['content']);        
}

//function for service request pop
function pop_servicerequest(){
    $block = module_invoke('site_structure', 'block_view', 'service_request');
    return render($block['content']);
}

/*login banner*/
function login_banner(){
    $block = module_invoke('site_structure', 'block_view', 'user_login_banner');
    return render($block['content']);
}

function render_sharethis(){
    return sharethis_block_contents();
}

function render_custom_sharethis($mpath,$mtitle){
    return sharethis_block_custom_contents($mpath,$mtitle);
}
function most_read_article($nid){
    
    $result = db_select('most_read_article', 'rb')
            ->fields('rb')
            ->condition('rb.nid',$nid)
            ->execute()
            ->fetchAssoc();
    if($result){
        $count = $result['count']+1;
        $rid = db_update('most_read_article')
            ->fields(array(
                'count' => $count
            ))
            ->condition('nid',$nid)
            ->execute();
            
    }else{
        $rid = db_insert('most_read_article')
            ->fields(array(
                'nid' => $nid,
                'count' => 1
            ))
            ->execute();
    }          
}

/*
function login_banner(){
    
    global $user;
    
    $get_form_val = drupal_get_form('user_login');
    $login_banner = render($get_form_val);
    
    if (!user_is_logged_in())
    {            
            return $login_banner;
    }
    else
    {
        return '<div></div>';
    }
}
*/
