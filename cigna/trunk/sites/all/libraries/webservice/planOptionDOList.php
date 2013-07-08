<?php

class planOptionDOList
{
    public $planOptionDOListLog;

    public function insertSubPlanOptions($optList)
    {
        try
        {
            $newOption = new stdClass();
            $newOption->type = 'planoption';
            $newOption->language = 'und';
            $newOption->uid =1;
            $newOption->title = $optList->optionCd;
            $newOption->field_plan_option_cd ['und'][0]['value'] = $optList->optionCd;
            $newOption->body['und'][0]['value']= $optList->description;
            $newOption->field_plan_option_cover_type['und'][0]['value']= $optList->coverTypeCd;
            $newOption->field_si_value['und'][0]['value']= $optList->saValue;
            node_save($newOption);
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }

    public function updateSubPlanOptions($entity_id,$optList)
    {
        try
        {
            $option = node_load($entity_id);
            $option->body['und'][0]['value']= $optList->description;
            $option->field_plan_option_cover_type['und'][0]['value']= $optList->coverTypeCd;
            $option->field_si_value['und'][0]['value']= $optList->saValue;
            node_save($option);
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }

    }

    public function insertAddonOptions($list)
    {
        try
        {
            db_insert("uc_attribute_options")
                 ->fields(array(
                                'aid'=>3,
                                'name'=>$list->productId,
                                'description'=>$list->description,
                                'launchDt'=>$list->launchDt,
                                'longName'=>$list->longName,
                                'planId'=>$list->planId,
                                'productFamilyId'=>$list->productFamilyId,
                     			'productId'=>$list->productId,
                     			'productStatusCd'=>$list->productStatusCd,
                     			'productVersion'=>$list->productVersion,
                                'shortName'=>$list->shortName,
                                'versionName'=>$list->versionName,
                                'withdrawDt'=>$list->withdrawDt,
                                )
                         )
                 ->execute();
             return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }

    public function updateAddonOptions($list,$productId)
    {
        try
        {
            db_update("uc_attribute_options")
                 ->fields(array(
                     			'name'=>$list->productId,
                               	'description'=>$list->description,
                                'launchDt'=>$list->launchDt,
                                'longName'=>$list->longName,
                                'planId'=>$list->planId,
                                'productFamilyId'=>$list->productFamilyId,
                     			'productId'=>$list->productId,
                     			'productStatusCd'=>$list->productStatusCd,
                     			'productVersion'=>$list->productVersion,
                                'shortName'=>$list->shortName,
                                'versionName'=>$list->versionName,
                                'withdrawDt'=>$list->withdrawDt,
                                 )
                         )
                 ->condition("productId","'".$productId."'")
                 ->execute();
           return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }

}