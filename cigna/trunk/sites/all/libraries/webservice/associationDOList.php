<?php

define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

class associationDOList
{
    public $associationDOListLog;

    public function insertAttributesAssociationDOList($entity_id)
    {
        try
        {
            db_insert("uc_product_attributes")
                      ->fields(array( 'nid'=>$entity_id,'aid'=>3,'label'=>'ADD-ONS'))
                      ->execute();
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
     }
    public function updateOptionsAssociationDOList($assoc,$oid,$nid)
    {
        try
        {
            db_update("uc_product_options")
                            ->fields(array(
                                   'oid'=>$oid,
                                   'planOptionCd'=>$assoc->planOptionCd,
                                   'productVersion'=>$assoc->productVersion,
                                   'productTypeCd'=>$assoc->productTypeCd,
                                   'associationRelationCd'=>$assoc->associationRelationCd ))
                            ->condition("nid",$nid)
                            ->execute();
            return 'TRUE';
        }
        catch(Exception $e){
            return "Exception Occured";
        }
    }
    public function insertOptionsAssociationDOList($assoc,$oid,$entity_id)
    {
        try
        {
            db_insert("uc_product_options")
                      ->fields(array(
                                   'nid'=>$entity_id,
                                   'oid'=>$oid,
                                   'planOptionCd'=>$assoc->planOptionCd,
                                   'productVersion'=>$assoc->productVersion,
                                   'productTypeCd'=>$assoc->productTypeCd,
                                   'associationRelationCd'=>$assoc->associationRelationCd ))
                      ->execute();
           return 'TRUE';
        }

        catch(Exception $e){
            return "Exception Occured";
        }
    }

}





