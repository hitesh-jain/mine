<?php

if(php_sapi_name() === 'cli') {
$_SERVER['REMOTE_ADDR'] = '192.0.0.0'; // mask IP
}

define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

include_once '/sites/all/libraries/webservice/plan.php';
include_once '/sites/all/libraries/webservice/subplan.php';
include_once '/sites/all/libraries/webservice/associationDOList.php';
include_once '/sites/all/libraries/webservice/planOptionDOList.php';
include_once '/sites/all/libraries/webservice/mappingto.php';
include_once '/sites/all/libraries/webservice/rider.php';
include_once '/sites/all/libraries/webservice/productConfigurator.php';


$obj = new productConfigurator();
$planObj = new plan();
$subPlanObj = new subPlan();
$associationDOListObj = new associationDOList();
$planOptionDOListObj = new planOptionDOList();
$mappingtoObj = new mappingto();
$riderObj = new rider();

//$date = date("/06/2013");
$date = date("14/06/2013");

//$date = date("d/m/Y");
$logString=null;


try
{
    
    // Collecting data from web service
    $response = $obj->getProduct($date);
    
    dpr($response);exit;
    //Throw Exception as exception is returned as string
    if(is_string($response))
        throw new Exception($response);

    //print '<pre>';
   //print_r($response);die;
    //Creating Response directory if it doesn't exist
    if (!file_exists('Response'))
        mkdir('Response');

    // writing data from webservice to file.
    $fileName =(String)"Response".date("Ymd_His").".html";
    $fp = fopen('Response/'."$fileName","w");
    $data = "<pre>".print_r($response,true)."</pre>";
    fwrite($fp,date("Y-m-d H:i:s"));
    fwrite($fp, $data);
    fwrite($fp,"<----End--->");
    fclose($fp);

    $cronStartTime = (String)date("Y-m-d H:i:s");
    //Iterating for Plan
    foreach($response->return->listofproductTO as $list)
    {
        if(($list->productTypeCd=='PLAN' ||$list->productTypeCd=='plan') && !empty($list->productId))
        {
             $logString.="\r\n For PLAN getting  productTypeCd='PLAN' status=TRUE";
             $planId = db_query("select field_plan_id_value from field_data_field_plan_id
                               where field_plan_id_value='".$list->productId."'" )->fetchField();
            if(!empty($planId))
            {
                $logString.="\r\n \t Getting planId status=TRUE";
                 $entityId=(int)db_query("select entity_id from field_data_field_plan_id
                       					inner join node on  node.nid=field_data_field_plan_id.entity_id and node.status=1
                       					where field_plan_id_value='".$list->productId."'")->fetchField() ;
                if(!empty($entityId)){

                    $logString.=" \r\n \t Getting entityId status=TRUE";
                    $object = node_load($entityId );
                    $logString.="\r\n \t Getting Object from Node status=TRUE";
                    if($object->field_version['und'][0]['value']!=$list->productVersion){

                        $logString.=" \r\n \t Getting productVersion match status=FALSE";
                        $status = $planObj->disablePlan($object);
                        $logString.=" \r\n \t Execute disablePlan status=$status.";
                        $status = $planObj->insertPlan($list);
                        $logString.=" \r\n \t Execute insertPlan status=$status.";
                    }
                    if($object->field_version['und'][0]['value'] == $list->productVersion){

                        $logString.=" \r\n \t Getting productVersion match status=TRUE";
                        $status = $planObj->updatePlan($object,$list);
                        $logString.=" \r\n \t Execute updatePlan status=$status.";
                    }
                }
            }
            if(empty($planId))
            {
                $logString.="\r\n \t Getting planId status=FALSE";
                 $status = $planObj->insertPlan($list);
                 $logString.=" \r\n \t Execute insertPlan status=$status.";
            }

        }

    }


    //Iterating for  planOptionDOList
    foreach($response->return->listofproductTO as $list)
    {
         if(($list->productTypeCd=='SUBPLAN' ||$list->productTypeCd=='subplan') || ($list->productTypeCd == 'RIDER' || $list->productTypeCd == 'rider')){

             $logString.="\r\n For planOptionDOList Get productTypeCd='SUBPLAN' status=TRUE";
             foreach($list->planOptionDOList as $optList){
                 if(!empty($optList->optionCd))
                     $entity_id=db_query("Select entity_id from field_data_field_plan_option_cd
                     where field_plan_option_cd_value='".$optList->optionCd."'")->fetchField();
                 if(!empty($entity_id)){

                     $logString.="\r\n \t Getting entity_id Status=TRUE";
                     $status = $planOptionDOListObj->updateSubPlanOptions($entity_id,$optList);
                     $logString.="\r\n \t Executing updateSubPlanOptions status=$status";
                 }
                 if(empty($entity_id)){

                     $logString.="\r\n \t Getting entity_id Status=FALSE";
                     $status = $planOptionDOListObj->insertSubPlanOptions($optList);
                     $logString.="\r\n \t Executing insertSubPlanOptions status=$status";
                 }

             }
         }
         if(($list->productTypeCd=='ADDON' ||$list->productTypeCd=='addon'))
         {
             $logString.="\r\n For planOptionDOList Get productTypeCd='ADDON' status=TRUE";
             $productId=db_query("select productId from uc_attribute_options where
             						productId='".$list->productId."'")->fetchField();
             if(empty($productId)){
                 $logString.="\r\n \t Getting productId Status=FALSE";
                 $status = $planOptionDOListObj->insertAddonOptions($list);
                 $logString.="\r\n \t Executing insertAddonOptions status=$status";
             }
             if(!empty($productId)){
                 $logString.="\r\n \t Getting productId Status=TRUE";
                 $status = $planOptionDOListObj->updateAddonOptions($list,$productId);
                 $logString.="\r\n \t Executing updateAddonOptions status=$status";
             }
         }

     }

     //Iterating for  subPlan
    foreach($response->return->listofproductTO as $list)
    {
        if(($list->productTypeCd=='SUBPLAN' ||$list->productTypeCd=='subplan') && !empty($list->productId))
        {
            $logString.="\r\n For SubPlan Getting productTypeCd=='SUBPLAN' status=TRUE";
             $productId = db_query("select field_sub_plan_id_value from field_data_field_sub_plan_id
                                    where field_sub_plan_id_value='".$list->productId."'" )->fetchField();
              $query=db_select("field_data_field_plan_id",'p');
                             $query->innerJoin('node','n','n.nid=p.entity_id');
                             $query->fields('p',array('entity_id'))
                                       ->condition('p.field_plan_id_value',$list->planId)
                                       ->condition('n.status',1);
              $target_id=$query->execute()->fetchField();
             if(!empty($productId))
             {
                 $logString.="\r\n \t Getting status for productId status=TRUE";
                 $entityId=db_query("select entity_id from field_data_field_sub_plan_id
                        			inner join node on node.nid=field_data_field_sub_plan_id.entity_id and node.status=1
                        			where field_sub_plan_id_value='".$list->productId."'" )->fetchField();


                 if(!empty($entityId)){

                     $logString.="\r\n \t Getting status for entityId status=TRUE";
                     $subPlan = node_load($entityId );
                     if($subPlan->field_version['und'][0]['value']!=$list->productVersion){

                             $logString.="\r\n \t Getting status for productVersion match status=TRUE";
                             $status = $subPlanObj->disableSubPlan($subPlan);
                             $logString.="\r\n \t Executing disableSubPlan status=$status";
                             $status = $subPlanObj->insertSubPlan($list,$target_id);
                             $logString.="\r\n \t Executing insertSubPlan status=$status";

                    }
                    if($subPlan->field_version['und'][0]['value']==$list->productVersion){

                        $logString.="\r\n \t Getting status for productVersion match status=FALSE";
                        $status = $subPlanObj->updateSubPlan($subPlan,$list,$target_id);
                        $logString.="\r\n \t Executing updateSubPlan status=$status";
                    }
                 }

             }
             if(empty($productId))
             {
                 $logString.="\r\n \t Getting status for productId status=FALSE";
                 $status = $subPlanObj->insertSubPlan($list,$target_id);
                 $logString.="\r\n \t Executing insertSubPlan status=$status";
             }

         }
     }

    // Iterating for  RIDER
    foreach($response->return->listofproductTO as $result)
    {
        if(($result->productTypeCd == 'RIDER' || $result->productTypeCd == 'rider') && !empty($result->productId))
        {
           $logString.="\r\n Getting status for productTypeCd == 'RIDER' status=TRUE";
           $sql= "select entity_id from field_data_field_ridder_id where field_ridder_id_value='".$result->productId."'" ;
           $entityId = (int)db_query($sql)->fetchField();
               if(!empty($entityId))
               {
                   $logString.="\r\n \t Getting status for entityId status=TRUE";
                   $riderObj->updateRider($entityId,$result);
                   $logString.="\r\n \t Executing updateRider status=$status";
               }
               else{
                   $logString.="\r\n \t Getting status for entityId status=TRUE";
                   $riderObj->insertRider($result);
                   $logString.="\r\n \t Executing insertRider status=$status";
               }
        }
    }


    // Iterating for  listOfProductMappingTO when Object
    if(isset($response->return->listOfProductMappingTO) && is_object($response->return->listOfProductMappingTO))
    {
        $logString.="\r\n Getting listOfProductMappingTO as one object  status=TRUE";
        $entity_id= db_query("select entity_id from field_data_field_sub_plan_id
                			where field_sub_plan_id_value='".$response->return->listOfProductMappingTO->productId."'")->fetchField();
        if(!empty($entity_id)){
            
            $productId= db_query("select entity_id from mappingto where entity_id=".$entity_id)->fetchField();
        }
        if( isset($productId) && empty($productId) ){
    
                $logString.="\r\n \t Getting productId  status=FALSE";
                $status = $mappingtoObj->insertMappingTo($entity_id,$response->return->listOfProductMappingTO);
                $logString.="\r\n \t Executing insertMappingTo status=$status";
        }
        if(isset($productId) && !empty($productId)){

            $logString.="\r\n \t Getting productId  status=TRUE";
            $status = $mappingtoObj->updateMappingTo($response->return->listOfProductMappingTO,$productId);
            $logString.="\r\n \t Executing updateMappingTo status=$status";
        }
    }
    // Iterating for  listOfProductMappingTO when array()
    if(is_array($response->return->listOfProductMappingTO))
    {
        $logString.="\r\nGetting listOfProductMappingTO as array  status=TRUE";
        foreach($response->return->listOfProductMappingTO as $mappingTo)
        {
            $entity_id= db_query("select entity_id from field_data_field_sub_plan_id
                    			where field_sub_plan_id_value='".$mappingTo->productId."'")->fetchField();
            if(!empty($entity_id)){

                $logString.="\r\n \t Getting entity_id  status=TRUE";
                $productId= db_query("select entity_id from mappingto where entity_id=".$entity_id)->fetchField();
                if(empty($productId)){

                    $logString.="\r\n \t Getting productId  status=FALSE";
                    $status = $mappingtoObj->insertMappingTo($entity_id,$mappingTo);
                    $logString.="\r\n \t Executing insertMappingTo status=$status";
                }
                if(!empty($productId)){

                    $logString.="\r\n \t Getting productId  status=TRUE";
                    $status = $mappingtoObj->updateMappingTo($mappingTo,$productId);
                    $logString.="\r\n \t Executing updateMappingTo status=$status";
                }
            }
        }
    }

    // Iterating for  associationDOList
    foreach($response->return->listofproductTO as $list)
    {
        if($list->productTypeCd=='SUBPLAN' || $list->productTypeCd=='subplan')
        {
            foreach($list->associationDOList as $assoc)
            {
                $logString.="\r\nGetting associationDOList for productTypeCd=='SUBPLAN'  status=TRUE";
                $entity_id=db_query("select entity_id from field_data_field_plan_option_cd where
                					Field_plan_option_cd_value='".$assoc->basePlanOptionCd."'")->fetchField();
                if(($assoc->productTypeCd=='ADDON'|| $assoc->productTypeCd=='addon') && !empty($entity_id))
                {
                    $logString.="\r\n \t Getting status for productTypeCd=='ADDON' and entity_id  status=TRUE";
                    $nid=db_query("select nid from uc_product_attributes where nid=".$entity_id)->fetchField();
                    if(empty($nid)){

                        $logString.="\r\n \t Getting status for nid  status=FALSE";
                        $status = $associationDOListObj->insertAttributesAssociationDOList($entity_id);
                        $logString.="\r\n \t Executing insertAttributesAssociationDOList status=$status";
                    }
                    $oid=db_query("select oid from uc_attribute_options where productId='".$assoc->productId."'")->fetchField();
                    if(!empty($oid)){

                        $logString.="\r\n \t Getting status for oid  status=TRUE";
                        $nid=db_query("select nid  from uc_product_options where nid='".$entity_id."' and oid='".$oid."'" )->fetchField();
                        if(empty($nid)){

                            $logString.="\r\n \t Getting status for nid  status=FALSE";
                            $status = $associationDOListObj->insertOptionsAssociationDOList($assoc,$oid,$entity_id);
                            $logString.="\r\n \t Executing insertOptionsAssociationDOList status=$status";
                        }
                        if(!empty($nid)){

                            $logString.="\r\n \t Getting status for nid  status=TRUE";
                            $status = $associationDOListObj->updateOptionsAssociationDOList($assoc,$oid);
                            $logString.="\r\n \t Executing updateOptionsAssociationDOList status=$status";
                        }
                     }

                }

            }

        }

    }
    // Iterating for Benefit Object
    /*
    foreach($response->return->listofproductTO as $list)
    {
      
      if($list->productBenefitDOList)
      {
            foreach($list->productBenefitDOList as $benifitList)
            {  
                 $logString.="\r\n Getting status for productBenefitDOList status=TRUE";      
                $inserted=db_insert('productbenefitdolist')
                            ->fields(array(
                                'benefitId'=>$benifitList->benefitId,
                                'benefitTypeCd'=>$benifitList->benefitTypeCd,
                                'description'=>$benifitList->description,
                            ))
                            ->execute();
               $logString.="\r\n \t Inserted productBenefitDOList status=TRUE";
           }             
        }
    }

    //creating LOG directory if it doesn't exist.
    if (!file_exists('LOG'))
        mkdir('LOG');
     // Writing Log to File
    $fp = fopen('LOG/'."log".date("Ymd_His").".txt","a");
    $log = print_r($logString,true);
    fwrite($fp, "<---Cron Execution Start Time ".$cronStartTime."---->");
    fwrite($fp, $log);
    fwrite($fp,"\r\n<-----Cron Execution End Time".(String)date("Y-m-d H:i:s")."----->" );
    fclose($fp);*/


}

catch (Exception $e)
{
    print_r($e);

    //creating LOG directory if it doesn't exist.
    if (!file_exists('LOG'))
        mkdir('LOG');

     // Writing Log and exception to File
    $fp = fopen('LOG/'."log".date("Ymd_His").".txt","a");
    $log = print_r($logString,true);
    fwrite($fp, "<---Cron Execution Started at ".$cronStartTime."---->");
    fwrite($fp, $log);
    fwrite($fp,"<----EXCEPTION--->");
    fwrite($fp, $e);
    fwrite($fp,"\r\n<-----Cron Execution End Time".(String)date("Y-m-d H:i:s")."----->");
    fclose($fp);

}

?>