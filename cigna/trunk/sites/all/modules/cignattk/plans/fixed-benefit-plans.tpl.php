<input type="submit" value="COMPARE PLANS"/>
<input type="submit" value="CALCULATE PREMIUM"/>
<table>
    <tbody>
        <?php foreach($categories as $category):?>
            <?php if($category->tid == 14):?>
                <?php foreach($category->plans as $plan):?>
                    <?php if($plan->type == 'product_kit' && $plan->status == 1):?>
                    <tr>
                        <td width="12%">
                            <img src="<?php echo check_plain(file_create_url($plan->uc_product_image[und][0]['uri']));?>" width="200px"/><br />
                            <b><h1><?php echo l($plan->title,'node/'.$plan->nid)?></h1></b><br />
                            <div class="plan_links"><span>EXPERT'S VIEW</span></div><br />
                            <div class="plan_links"><span><?php echo l('VIEW PLAN DETAILS','node/'.$plan->nid)?></span></div><br />
                            <div class="plan_links"><span>BUY NOW</span></div>
                        </td>
                        <td width="30%">
                            <?php echo $plan->body[$plan->language][0][value]?><br />
                            <span><input type="checkbox" name="product_ids[]" value="<?php echo $plan->nid?>"/> Compare this plan</span>
                        </td>
                        <td width="20%"><h2>28,847 people have bought this plan Lorem ipsum dolorsit amet</h2>
                            <?php //echo $plan->field_sold_count[$plan->language][0][value]?></h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Modify the details below to view impact on the premium</td></tr>
                                        <tr><td><b>2 ADULTS, 1 CHILD</b></td></tr>
                                        <tr>
                                            <td><b>TERM:</b>
                                                <select id="tenure<?php echo $plan->nid?>"><?php foreach($plan->field_policy_term[und] as $term):?>
                                                            <option value="<?php echo $term[value];?>"><?php echo $term[value];?> YEAR</option>
                                                        <?php endforeach;?>
                                                </select></td></tr>
                                        <tr><td><b>SUM INSURED:</b>
                                            <select id="sumInsured<?php echo $plan->nid?>"><?php foreach($plan->products as $product):?>
                                                            <option value="<?php echo round($product->cost);?>"><?php echo number_format($product->cost, 0);?></option>
                                                        <?php endforeach;?>
                                                </select>
                                        </td></tr>
                                        <tr><td><div id="premium<?php echo $plan->nid?>"></div></td></tr>
                                        <tr>
                                            <td>
                                                <button id="<?php echo $plan->nid;?>" class="getQuote" style="background-color: #000; color:#FFF; padding:5px">Get Quote</button>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endif;?>
        <?php endforeach;?>
      </tbody>
</table>