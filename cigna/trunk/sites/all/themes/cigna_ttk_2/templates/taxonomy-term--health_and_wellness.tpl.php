<div class="healthwellness">
<div class="healthwellnessdetails">
      <div class="rightdata">
        <article>
            <?php  foreach($hwnodes as $value):?>
              <div class="sectionarea bottomdetails">
                <section class="bottomdetails">
                  <h1><?php print l($value->title,'node/'.$value->nid);  ?></h1>
                  <ul>
                    <?php $term = taxonomy_term_load($value->field_hwcategory['und']['0']['tid']);?>
                    <li class="first"><a href="#"><?php print l($term->name, 'taxonomy/term/' . $value->field_hwcategory['und']['0']['tid']); ?></a></li>
                    <li class="last"><a href="#"><?php print date('j F Y',$value->created)?></a></li>
                  </ul>
                  <p><?php print substr(strip_tags($value->body['und']['0']['value']),0,300);?></p>
                  <p><?php print l(t('Read More&nbsp;<img src="/sites/all/themes/cigna_ttk_2/images/arrow1.png" width="14" height="14" alt="">'),'node/'.$value->nid,array('attributes'=>array('class'=>array('')),'html' => TRUE));?></p>
                </section>
              </div>
        <?php endforeach;?>
        <div class="bottomdetailslist" id="news-pagination"><?php print $hwpager; ?></div>
        </article>
        </div>
</div>