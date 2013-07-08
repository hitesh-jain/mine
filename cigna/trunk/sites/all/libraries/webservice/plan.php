<?php

class plan
{
    public $planLog;

    public function insertPlan($list)
    { try{
        
       	    if(isset($list->fixedTermValues))
			{
				$arrFixedTermValues=explode(",",$list->fixedTermValues);
			}
			$arrFixedTermValues = array_filter($arrFixedTermValues);
			$fixedTermIndex=0;

            $newObject = new stdClass();
            $newObject->type ='plan';
            $newObject->language = 'und';
            $newObject->uid =1;
            $newObject->title =$list->productId;
            if($list->productFamilyId=='IPMI')
                $taxonomy_id=13;
             elseif ($list->productFamilyId=='FB')
                $taxonomy_id=14;
            $newObject->field_plan_id['und'][0]['value'] = (String)$list->productId;
            $newObject->field_version['und'][0]['value']=(String)$list->productVersion;
            $newObject->field_version_name['und'][0]['value']=(String)$list->versionName;
            $newObject->field_long_name['und'][0]['value']=(String)$list->longName;
            $newObject->field_short_name['und'][0]['value']=(String)$list->shortName;
            $newObject->body['und'][0]['value']=$list->description;
            $newObject->taxonomy_catalog['und'][0]['tid']=$taxonomy_id;
            $newObject->field_plan_status['und'][0]['value']=(String)$list->productStatusCd;
            $newObject->field_launch_date['und'][0]['value']=(String)$list->launchDt;
            $newObject->field_withdraw_date ['und'][0]['value']=(String)$list->withdrawDt;
            $newObject->field_plan_parent_product_id ['und'][0]['value']=(String)$list->parentProductId;
            $newObject->field_product_id ['und'][0]['value']=(String)$list->productId;
           // $newObject->field_plan_policy_term ['und'][0]['value']=(int)$list->fixedTermValues;
            $newObject->field_ws_plan_long_name ['und'][0]['value']=(String)$list->longName;
			$newObject->field_ws_plan_short_name ['und'][0]['value']=(String)$list->shortName;
            foreach($arrFixedTermValues as $values)
			{	
				$newObject->field_plan_policy_term ['und'][$fixedTermIndex]['value']=(int)$values;
				$fixedTermIndex++;
			}
            if(isset($taxonomy_id) && !empty($taxonomy_id))
            {
                node_save($newObject);
                return 'TRUE';
            }
            return 'FALSE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }
    public function updatePlan($object,$list)
    {
        try{
            if(isset($list->fixedTermValues))
			{
				$arrFixedTermValues=explode(",",$list->fixedTermValues);
			}
			$arrFixedTermValues = array_filter($arrFixedTermValues);
            $responseIndex=0;
            $object->title =$list->productId;
            $object->field_plan_id['und'][0]['value'] = (String)$list->productId;
            $object->field_version['und'][0]['value']=(String)$list->productVersion;
            $object->field_version_name['und'][0]['value']=(String)$list->versionName;
            $object->field_long_name['und'][0]['value']=(String)$list->longName;
            $object->field_short_name['und'][0]['value']=(String)$list->shortName;
            $object->body['und'][0]['value']=(String)$list->description;
            $object->field_plan_status['und'][0]['value']=(String)$list->productStatusCd;
            $object->field_launch_date['und'][0]['value']=$list->launchDt;
            $object->field_withdraw_date ['und'][0]['value']=$list->withdrawDt;
            $object->field_plan_parent_product_id ['und'][0]['value']=(String)$list->parentProductId;
            $object->field_product_id ['und'][0]['value']=(String)$list->productId;
            //$object->field_plan_policy_term ['und'][0]['value']=(int)$list->fixedTermValues;
            $object->field_ws_plan_long_name ['und'][0]['value']=(String)$list->longName;
			$object->field_ws_plan_short_name ['und'][0]['value']=(String)$list->shortName;
            $objectMaxIndex = count($object->field_plan_policy_term ['und']);
            foreach($arrFixedTermValues as $values)
			{	
				$flag="notset";
				foreach($object->field_plan_policy_term ['und'] as $index)
				{
					if($index['value']==$values)
						$flag="set";
				}
				if($flag=="notset")
				{
					$object->field_plan_policy_term ['und'][$objectMaxIndex+$responseIndex]['value']=(int)$values;
					$responseIndex++;
				}
			}
            node_save($object);
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }
    public function disablePlan($object)
    {
        try{
            $object->status=0;
            node_save($object);
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }

}