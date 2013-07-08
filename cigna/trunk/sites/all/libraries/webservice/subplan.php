<?php

class subPlan
{
    public $subPlanLog;

    public function insertSubPlan($list,$target_id)
    {
        try
        {
         $newSubPlan = new stdClass();
         $newSubPlan->type ='product';
         $newSubPlan->language = 'und';
         $newSubPlan->uid =1;
         $newSubPlan->title =$list->productId;
         $newSubPlan->field_related_plan_id['und'][0]['target_id']= $target_id;
         $newSubPlan->field_sub_plan_id['und'][0]['value'] = (String)$list->productId;
         $newSubPlan->field_version['und'][0]['value'] = (String)$list->productVersion;
         $newSubPlan->field_version_name['und'][0]['value'] = (String)$list->versionName;
         $newSubPlan->field_long_name['und'][0]['value'] = (String)$list->longName;
         $newSubPlan->field_short_name['und'][0]['value'] = (String)$list->shortName;
         $newSubPlan->body['und'][0]['value'] = (String)$list->description;
         $newSubPlan->field_sub_plan_status['und'][0]['value'] = (String)$list->productStatusCd;
         $newSubPlan->field_launch_date['und'][0]['value'] = (String)$list->launchDt;
         $newSubPlan->field_withdraw_date['und'][0]['value'] = (String)$list->withdrawDt;
         $newSubPlan->field_sub_plan_parent_product_id['und'][0]['value'] = (String)$list->parentProductId;
         $newSubPlan->field_policy_term['und'][0]['value'] = (int)$list->fixedTermValues;
         $newSubPlan->field_ws_plan_long_name ['und'][0]['value']=(String)$list->longName;
		 $newSubPlan->field_ws_plan_short_name ['und'][0]['value']=(String)$list->shortName;
         
            foreach($list->planOptionDOList as $key=>$planoption_association){
             $planoption_id=db_select("field_data_field_plan_option_cd",'c')
                                      ->fields('c',array('entity_id'))
                                      ->condition("field_plan_option_cd_value",$planoption_association->optionCd)
                                      ->execute()->fetchField();
              $newSubPlan->field_sub_plan_option['und'][$key]['target_id']=$planoption_id;
            }

             if(!empty($target_id))
             {
                 node_save($newSubPlan);
                 return 'TRUE';
             }
         return 'FALSE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }

    public function updateSubPlan($subPlan,$list,$target_id)
    {
        try
        {
        $subPlan->title =$list->productId;
        $subPlan->field_related_plan_id['und'][0]['target_id']= $target_id;
        $subPlan->field_sub_plan_id['und'][0]['value'] = (String)$list->productId;
        $subPlan->field_version['und'][0]['value'] = (String)$list->productVersion;
        $subPlan->field_version_name['und'][0]['value'] = (String)$list->versionName;
        $subPlan->field_long_name['und'][0]['value'] = (String)$list->longName;
        $subPlan->field_short_name['und'][0]['value'] = (String)$list->shortName;
        $subPlan->body['und'][0]['value'] = (String)$list->description;
        $subPlan->field_sub_plan_status['und'][0]['value'] = (String)$list->productStatusCd;
        $subPlan->field_launch_date['und'][0]['value'] = (String)$list->launchDt;
        $subPlan->field_withdraw_date['und'][0]['value'] = (String)$list->withdrawDt;
        $subPlan->field_sub_plan_parent_product_id['und'][0]['value'] = (String)$list->parentProductId;
        $subPlan->field_policy_term['und'][0]['value'] = (int)$list->fixedTermValues;
        $subPlan->field_ws_plan_long_name ['und'][0]['value']=(String)$list->longName;
		$subPlan->field_ws_plan_short_name ['und'][0]['value']=(String)$list->shortName;
        
            foreach($list->planOptionDOList as $key=>$planoption_association){
                $planoption_id=db_select("field_data_field_plan_option_cd",'c')
                                         ->fields('c',array('entity_id'))
                                         ->condition("field_plan_option_cd_value",$planoption_association->optionCd)
                                         ->execute()->fetchField();
                $subPlan->field_sub_plan_option['und'][$key]['target_id']=$planoption_id;
            }
            if(!empty($target_id))
             {
                 node_save($subPlan);
                 return 'TRUE';
             }
             return 'FALSE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }
    public function disableSubPlan($subPlan)
    {
        try
        {
            $subPlan->status=0;
            node_save($subPlan);
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }
}



?>