<table>
    <tbody>
        <?php foreach($categories as $category):?>
            <td><a href="<?php echo $category->url_alias?>"><?php echo $category->name;?></a>
                <ol>
                <?php foreach($category->plans as $plan):?>
                    <li><?php echo l($plan->title,'node/'.$plan->nid)?></li>
                <?php endforeach;?>
                </ol>
            </td>
        <?php endforeach;?>
      </tbody>
</table>