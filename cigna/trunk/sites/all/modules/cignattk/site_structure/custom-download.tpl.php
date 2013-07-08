<article>
  <div span12">
	<h2 class="entry-title"><strong><?php print ucfirst($downloadType);?></strong></h2>
		<?php 
		if($downloadType=="claims"){
			$viewName = 'claims';
		}else if($downloadType=="brochures"){
			$viewName = 'document';
		}
		echo views_embed_view($viewName);
		
		?>
  </div>
  <!-- .entry-content --> 
 
</article>

  





		
