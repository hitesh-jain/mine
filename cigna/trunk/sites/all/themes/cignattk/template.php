<?php

/**
 * Add body classes if certain regions have content.
 */
function cignattk_preprocess_html(&$variables) {
 

}

/**
 * Override or insert variables into the page template for HTML output.
 */
function cignattk_process_html(&$variables) {
 
}

/**
 * Override or insert variables into the page template.
 */
function cignattk_preprocess_page(&$variables) {
    global $base_url, $theme;
    
    //validate proposer as a adult.
    $arg = arg();
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
        
        if($vocab_name != 'health_and_wellness'){
            $variables['page']['content']['system_main']['nodes'] = null;
            $variables['page']['content']['system_main']['pager'] = null;
        }
        
      }
      /*
      ctools_include('ajax');
      ctools_include('modal');
      ctools_modal_add_js();
        
        
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
function cignattk_preprocess_node(&$variables) {
    $arg = arg();
    if($variables['type'] == 'health_wellness' && $arg['0'] == 'node'){
        $nid = $variables['nid'];
        // to manage most read article 
        most_read_article($nid);
    }
    
}

/**
 * Override or insert variables into the block template.
 */
function cignattk_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function cignattk_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function cignattk_field__taxonomy_term_reference($variables) {
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
 
 function cignattk_get_plan_menu_old(){
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
                    ('.$category->field_short_note[und][0][value].')<img src="'.drupal_get_path("theme","cignattk").'/images/sound.png" width="31" height="20" alt="" style="float:right">
                        <p style="padding-top:8px;">'.cignattk_truncate($category->description,'200').'</p>';
                    foreach($category->plans as $plan){
                            if($plan->type == 'product_kit')
                            $output .='<p class="listname">'.l($plan->title,'node/'.$plan->nid).'</p>';
                      }
        $output .='</div>';
        $output .='</ul></li>';
        } // endforeach
        return $output;
 }
 
 function cignattk_get_plan_menu(){
        $plan_categories=taxonomy_vocabulary_machine_name_load('plans');
        $categories=taxonomy_get_tree($plan_categories->vid);
        foreach($categories as $category){
            $term = taxonomy_term_load($category->tid);
            $plan_nids = taxonomy_select_nodes($category->tid);
            $term->plans = node_load_multiple($plan_nids);
            $plans_categories[] = $term;
        }
        $output ='<li><ul>';
        $output .='<div class="leftdata">';
        foreach($plans_categories as $category){
            $output .='<p class="listname">'.l($category->name,'taxonomy/term/'.$category->tid).'</p>';
        } // endforeach
        $output .='</div>';
        $output .='</ul></li>';
       
        return $output;
}
 
 /**
  * To chop the string after specific charaters.
  */
  function cignattk_truncate($str, $len) {
    $tail = max(0, $len-10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len-$tail))));
    return $trunk;
}
/**
 * Get string into two parts.
 */
 function cignattk_split_string($string,$noOfCharacters){
    $data = array();
    $str1 = substr($string,0,$noOfCharacters);
    $str2 = substr($string, $noOfCharacters);
    return $data = array($str1,$str2);
 }
 function cignattk_get_top_menu(){
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
function render_video($uri,$width,$height){
    $height = $height? $height:'480';
    $width = $width ? $width:'630';
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
    //dpr($result);die;           
}

/**
 * Get string into two parts.
 */
 function cigna_ttk_2_split_string($string,$noOfCharacters){
    $data = array();
    $str1 = substr($string,0,$noOfCharacters);
    $str2 = substr($string, $noOfCharacters);
    return $data = array($str1,$str2);
 }
 