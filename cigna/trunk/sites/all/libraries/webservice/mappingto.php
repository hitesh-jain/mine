<?php


class mappingto
{
    public $mappingtoLog;



    
    public function insertMappingTo($entity_id,$mappingTo)
    {
        

        $from_service_dte=explode('/',$mappingTo->effectiveFromDt);
        $from_unixtime=mktime(0,0,0,$from_service_dte[1],$from_service_dte[0],$from_service_dte[2]);
        $eff_from_date=date('Y-m-d',$from_unixtime);        
        
        if(!empty($mappingTo->effectiveToDt)){
            
            $to_service_dte=explode('/',$mappingTo->effectiveToDt);
            $to_unixtime=mktime(0,0,0,$to_service_dte[1],$to_service_dte[0],$to_service_dte[2]);
            $eff_to_date=date('Y-m-d',$to_unixtime);    
            
        }
        
        db_insert("mappingto")
                    ->fields(array(
                                'productId'=>$mappingTo->productId,
                                'entity_id'=>$entity_id,
                                'agencyId'=>(int)$mappingTo->agencyId,
                                'agentId'=>(int)$mappingTo->agentId,
                                'campainId'=>$mappingTo->campainId,
                                'channelId'=>$mappingTo->channelId,
                                'effectiveFromDt'=>$eff_from_date,
                                'effectiveToDt'=>$eff_to_date,
                                'optionCd'=>$mappingTo->optionCd,
        						'productMappingSeq'=>$mappingTo->productMappingSeq,
        						'remarks'=>$mappingTo->remarks
                                )
                            )
        ->execute();
        return 'TRUE';
    }

    public function updateMappingTo($mappingTo,$productId)
    {
        
        
        $from_service_dte=explode('/',$mappingTo->effectiveFromDt);
        $from_unixtime=mktime(0,0,0,$from_service_dte[1],$from_service_dte[0],$from_service_dte[2]);
        $eff_from_date=date('Y-m-d',$from_unixtime);        
        
        if(!empty($mappingTo->effectiveToDt)){
            
            $to_service_dte=explode('/',$mappingTo->effectiveToDt);
            $to_unixtime=mktime(0,0,0,$to_service_dte[1],$to_service_dte[0],$to_service_dte[2]);
            $eff_to_date=date('Y-m-d',$to_unixtime);    
            
        }
        db_update("mappingto")
                    ->fields(array(
                                'productId'=>$mappingTo->productId,
                                'agencyId'=>(int)$mappingTo->agencyId,
                                'agentId'=>(int)$mappingTo->agentId,
                                'campainId'=>$mappingTo->campainId,
                                'channelId'=>$mappingTo->channelId,
                                'effectiveFromDt'=>$eff_from_date,
                                'effectiveToDt'=>$eff_to_date,
                                'optionCd'=>$mappingTo->optionCd,
        						'productMappingSeq'=>$mappingTo->productMappingSeq,
        						'remarks'=>$mappingTo->remarks
                                 )
                            )
        ->condition("entity_id",$productId)
        ->execute();
        return 'TRUE';
    }
}