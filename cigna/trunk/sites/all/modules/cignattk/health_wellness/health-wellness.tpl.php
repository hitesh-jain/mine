<div class="healthwellness">
      <div class="rightdata">
        <article>
            <?php if(isset($recent_post)):?>
                  <div class="topdata">
                  <?php global $base_url;?>
                    <?php $mpath1 = $base_url.'/'.drupal_lookup_path('alias','node/'.$recent_post->nid);?>
                    <h3><?php print l(t($recent_post->title), 'node/'.$recent_post->nid);?></h3>
                    <ul>
                      <li class="first"><?php print l($recent_post->tname, 'taxonomy/term/' . $recent_post->field_hwcategory['und']['0']['tid']); ?></li>
                      <li><?php print date('j F Y',$recent_post->created)?></li>
                      <!-- <li class="last"><a href="#">COMMENTS <span>(5)</span></a></li> -->
                      <li class="last"><a href="<?php echo $mpath1;?>#disqus_thread">count</a></li>
                    </ul>
                    <div class="socilalist"><?php print render_custom_sharethis($mpath1,$recent_post->title);?></div>
                  </div>
                  <div class="sectionarea">
                    <section>
                      <dd>
                        <p class="big"><?php print substr(strip_tags($recent_post->body['und']['0']['summary']),0,270);?></p>
                        <p><?php print substr(strip_tags($recent_post->body['und']['0']['value']),0,150);?></p>
                        <p><?php print l(t('Read More&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$recent_post->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></p>
                      </dd>
                      <dt><img src="<?php echo file_create_url($recent_post->field_image['und']['0']['uri']);?>" width="244" height="216" alt=""></dt>
                    </section>
                  </div>
            <?php endif;?>
          <div class="sectionarea">
            <section>
              <div class="leftdatadetails">
                <?php if(isset($posts['0'])):?>
                    <aside class="leftdata">
                      <div class="tophead">
                        <header>
                        <?php $mpath2 = $base_url.'/'.drupal_lookup_path('alias','node/'.$posts['0']->nid);?>
                          <h5><?php print l(t($posts['0']->title), 'node/'.$posts['0']->nid);?></h5>
                          <img src="<?php echo file_create_url($posts['0']->field_image['und']['0']['uri']);?>" width="57" height="36" alt="">
                          <ul>
                            <?php $term = taxonomy_term_load($posts['0']->field_hwcategory['und']['0']['tid']);?>
                            <li class="first"><?php print l($term->name, 'taxonomy/term/' . $posts['0']->field_hwcategory['und']['0']['tid']); ?></li>
                            <li><?php print date('j F Y',$posts['0']->created)?></li>
                            <li class="last"><a href="<?php echo $mpath2;?>#disqus_thread">count</a></li>
                          </ul>
                        </header>
                      </div>
                      <p><?php print substr(strip_tags($posts['0']->body['und']['0']['value']),0,150);?></p>
                      <div class="readmore"><?php print l(t('Read More&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$posts['0']->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></div>
                      
                      <div class="sociallist"><?php print render_custom_sharethis($mpath2,$posts['0']->title);?></div>
                    </aside>
                <?php endif;?>
              </div>
              <div class="leftdatadetails">
                <?php if(isset($posts['1'])):?>
                    <aside class="rightdata">
                      <div class="tophead">
                        <header>
                        <?php $mpath3 = $base_url.'/'.drupal_lookup_path('alias','node/'.$posts['1']->nid);?>
                          <h5><?php print l(t($posts['1']->title), 'node/'.$posts['1']->nid);?></h5>
                          <img  src="<?php echo file_create_url($posts['1']->field_image['und']['0']['uri']);?>" width="77" height="56" alt="">
                          <ul>
                            <?php $term = taxonomy_term_load($posts['1']->field_hwcategory['und']['0']['tid']);?>
                            <li class="first"><?php print l($term->name, 'taxonomy/term/' . $posts['1']->field_hwcategory['und']['0']['tid']); ?></li>
                            <li><?php print date('j F Y',$posts['1']->created)?></li>
                            <li class="last"><a href="<?php echo $mpath3;?>#disqus_thread">count</a></li>
                          </ul>
                        </header>
                      </div>
                      <p><?php print substr(strip_tags($posts['1']->body['und']['0']['value']),0,150);?></p>
                      <div class="readmore"><?php print l(t('Read More&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$posts['1']->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></div>
                      
                      <div class="sociallist"><?php print render_custom_sharethis($mpath3,$posts['1']->title);?></div>
                    </aside>
                <?php endif;?>
              </div>
              <div class="leftdatadetails last">
                <?php if(isset($posts['2'])):?>
                        <aside class="leftdata lastdata">
                          <div class="tophead">
                            <header>
                            <?php $mpath4 = $base_url.'/'.drupal_lookup_path('alias','node/'.$posts['2']->nid);?>
                              <h5><?php print l(t($posts['2']->title), 'node/'.$posts['2']->nid);?></h5>
                              <ul>
                                <?php $term = taxonomy_term_load($posts['2']->field_hwcategory['und']['0']['tid']);?>
                                <li class="first"><?php print l($term->name, 'taxonomy/term/' . $posts['2']->field_hwcategory['und']['0']['tid']); ?></li>
                                <li><?php print date('j F Y',$posts['2']->created)?></li>
                                <li class="last"><a href="<?php echo $mpath4;?>#disqus_thread">count</a></li>
                              </ul>
                            </header>
                          </div>
                          <p class="lasppara"><?php print substr(strip_tags($posts['2']->body['und']['0']['value']),0,150);?></p>
                          <p><img  src="<?php echo file_create_url($posts['2']->field_image['und']['0']['uri']);?>" width="77" height="56" alt=""></p>
                          <div class="readmore"><?php print l(t('Read More&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$posts['1']->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></div>
                          
                          <div class="sociallist"><?php print render_custom_sharethis($mpath4,$posts['2']->title);?></div>
                        </aside>
                <?php endif;?>
              </div>
              <div class="rightdatadetails last">
                <?php if(isset($posts['3'])):?>
                    <aside class="rightdata lastdata">
                      <div class="tophead">
                        <header>
                        <?php $mpath5 = $base_url.'/'.drupal_lookup_path('alias','node/'.$posts['3']->nid);?>
                          <h5><?php print l(t($posts['3']->title), 'node/'.$posts['3']->nid);?></h5>
                          <ul>
                            <?php $term = taxonomy_term_load($posts['3']->field_hwcategory['und']['0']['tid']);?>
                            <li class="first"><a href="#"><?php print l($term->name, 'taxonomy/term/' . $posts['3']->field_hwcategory['und']['0']['tid']); ?></a></li>
                            <li><?php print date('j F Y',$posts['3']->created)?></li>
                            <li class="last"><a href="<?php echo $mpath5;?>#disqus_thread">count</a></li>
                          </ul>
                        </header>
                      </div>
                      <p class="lasppara"><?php print substr(strip_tags($posts['3']->body['und']['0']['value']),0,150);?></p>
                      <p><img  src="<?php echo file_create_url($posts['3']->field_image['und']['0']['uri']);?>" width="77" height="56" alt=""></p>
                      <div class="readmore"><?php print l(t('Read More&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$posts['3']->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></div>
                      <div class="sociallist"><?php print render_custom_sharethis($mpath5,$posts['3']->title);?></div>
                    </aside>
                <?php endif;?>
              </div>
            </section>
          </div>
          
        <?php  foreach($health_wellness as $value):?>
            <?php //dpr($value);?>
          <div class="sectionarea bottomdetails">
            <section class="bottomdetails">
              <h1><?php print l($value->title,'node/'.$value->nid);  ?></h1>
              <ul>
                <?php $term = taxonomy_term_load($value->field_hwcategory['und']['0']['tid']);?>
                <li class="first"><a href="#"><?php print l($term->name, 'taxonomy/term/' . $value->field_hwcategory['und']['0']['tid']); ?></a></li>
                <li class="last"><?php print date('j F Y',$value->created)?></li>
              </ul>
              <p><?php print substr(strip_tags($value->body['und']['0']['value']),0,300);?></p>
              <p><?php print l(t('Read More&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$value->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></p>
              <?php  //print strip_tags($value->body[LANGUAGE_NONE][0]['summary'],''). l(t('&laquo &nbsp;&nbsp;&nbsp; Read more'),'node/'.$value->nid,array('attributes'=>array('class'=>array('read_more_link')),'html' => TRUE)); ?>
            </section>
          </div>
        <?php endforeach;?>
        <div class="bottomdetailslist" id="news-pagination"><?php print $health_wellness_pager; ?></div>
        </article>
      </div>