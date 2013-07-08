<?php
class rider
{
    public $riderLog;

    public function updateRider($entityId,$result)
    {
        try
        {
           $rider = node_load($entityId );
           $rider->field_launch_date['und'][0]['value']= strtotime($result->launchDt);
           $rider->field_long_name['und'][0]['value'] = (String)$result->longName;
           $rider->field_product_family_id['und'][0]['value'] = (String)$result->productFamilyId;
           $rider->field_ridder_id['und'][0]['value'] = (String)$result->productId;
           $rider->field_status_cd['und'][0]['value'] = (bool)$result->productStatusCd;
           $rider->field_product_type_cd['und'][0]['value'] = (String)$result->productTypeCd;
           $rider->field_version['und'][0]['value'] = (String)$result->productVersion;
           $rider->field_product_version['und'][0]['value'] = (String)$result->productVersion;
           $rider->field_short_name['und'][0]['value'] = (String)$result->shortName;
           $rider->field_version_name['und'][0]['value'] = (String)$result->versionName;
           $rider->field_ws_plan_long_name ['und'][0]['value']=(String)$result->longName;
		   $rider->field_ws_plan_short_name ['und'][0]['value']=(String)$result->shortName;
           $rider->field_withdraw_date['und'][0]['value'] = strtotime($result->withdrawDt)? strtotime($result->withdrawDt):$rider->field_withdraw_dt['und'][0]['value'];
           foreach($result->planOptionDOList as $key=>$planoption_association){

                 $planoption_id=db_select("field_data_field_plan_option_cd",'c')
                                  ->fields('c',array('entity_id'))
                                  ->condition("field_plan_option_cd_value",$planoption_association->optionCd)
                                  ->execute()->fetchField();
                 $rider->field_sub_plan_riders['und'][$key]['target_id']=$planoption_id;
            }
           node_save($rider);
           return TRUE;
        }
        catch(Exception $e)
        {
            return "Exception Occured";
        }
    }

    public function insertRider($result)
    {
        global $user;
        try
        {
           $newObject = new stdClass();
           $newObject->type = 'rider';
           $newObject->language = 'und';
           $newObject->uid = $user->uid;
           $newObject->title = (String)$result->longName;
           $newObject->field_launchdt['und'][0]['value']= (String)$result->launchDt;
           $newObject->field_long_name['und'][0]['value'] = (String)$result->longName;
           $newObject->field_product_family_id['und'][0]['value'] = (String)$result->productFamilyId;
           $newObject->field_ridder_id['und'][0]['value'] = (String)$result->productId;
           $newObject->field_status_cd['und'][0]['value'] = (bool)$result->productStatusCd;
           $newObject->field_product_type_cd['und'][0]['value'] = (String)$result->productTypeCd;
           $newObject->field_product_version['und'][0]['value'] = (String)$result->productVersion;
           $newObject->field_short_name['und'][0]['value'] = (String)$result->shortName;
           $newObject->field_version_name['und'][0]['value'] = (String)$result->versionName;
           $newObject->field_withdraw_dt['und'][0]['value'] = (String)$result->withdrawDt;
           $newObject->field_ws_plan_long_name ['und'][0]['value']=(String)$result->longName;
		   $newObject->field_ws_plan_short_name ['und'][0]['value']=(String)$result->shortName;
           
           foreach($result->planOptionDOList as $key=>$planoption_association){
                     $planoption_id=db_select("field_data_field_plan_option_cd",'c')
                                      ->fields('c',array('entity_id'))
                                      ->condition("field_plan_option_cd_value",$planoption_association->optionCd)
                                      ->execute()->fetchField();
                     $newObject->field_sub_plan_riders['und'][$key]['target_id']=$planoption_id;
            }
           node_save($newObject);
           return TRUE;
        }
        catch (Exception $e)
        {
           return "Exception Occured";
        }
    }

}
?>