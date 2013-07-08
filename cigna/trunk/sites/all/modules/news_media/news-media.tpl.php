
<div id="news-media" style="padding-right:15px;">
        <h2 class="entry-title">News & Media</h2>
        <?php
        $flag=true;
        $class="";
        $outer_class='';
        if(isset($news_media)){ ?>
                <ul id="acc1" class="accordion">
         <?php  foreach($news_media as $year_key=>$year){ ?>
                <li>
                <?php if($flag){ 
                    
                        $class="open";
                        $outer_class="shown";             
                     }else {  
                            $class=""; 
                            $outer_class="";
                     } 
                ?>
            <h4 class="h"><a class="trigger <?php print $class; ?> " href="#"><?php print $year_key; ?></a></h4>
                <div class="outer <?php print $outer_class; ?>" style="display: block;">
                <div class="inner <?php print $outer_class;  ?>" style="">
                    <ul>
             <?php foreach($year as $month_key=>$month){ ?>
             
                    <li>
                    <?php  if($flag){ 
                             $class="open";
                            $outer_class="shown"; 
                            
                            } else { $class=""; 
                                $outer_class="";
                             }?>
                    
                    <h5 class="h"><a class="trigger <?php print $class; ?>" href="#"><?php echo $month_key_str=get_month_str($month_key);  ?></a></h5>
                           <div class="outer  <?php print $outer_class; ?>" style="display: block;">
                <?php  foreach($month as $node){ ?>
                
                            <div class="inner" style="">      
                                <p>
                                    <div>
                                    <?php echo l($node->title,'node/'.$node->nid);  ?><br/>
                                    <?php
                                        
                                         if(isset($node->news_author[LANGUAGE_NONE][0]['value'])){   
                                            $author=$node->news_author[LANGUAGE_NONE][0]['value'];
                                        }else{
                                            $author='CIGNATTK';    
                                        }
                                       echo  $author.","; echo date('d F Y',$node->created);                        
                                    ?><br/>
                                    <?php
echo strip_tags($node->body[LANGUAGE_NONE][0]['summary'],''). l(t(' Read more&nbsp;&nbsp;&nbsp;<img src="sites/all/themes/cigna_ttk_2/images/arrow1.png" />'),'node/'.$node->nid,array('attributes'=>array('class'=>array('read_more_link')),'html' => TRUE));                                          
                                    ?>
                                    </div>
                                </p>
                            </div>
                        
               <?php
                $flag=false;
                } ?>
                        </div>
                    </li>
                
            <?php 
            $flag=false;  
             } ?> </ul>
             </div></div></li>
             
        <?php       $flag=false;
          }
          ?> </ul>
          <?php  }else{
                echo 'No Content Available.Content will be updated soon.';
          }
        ?>
</div>