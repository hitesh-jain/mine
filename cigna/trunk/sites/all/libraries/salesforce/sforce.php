<?php
/**
 * 
 * Custom fields mapping for Drupal to SFDC
 * 
 */
 class Sforce{
    
    public $sforceUsername = 'saasadmin@saasforce.in';
	public $sforcePassword = 'saasforce123';
	public $sforceSecurityToken = 'JWTIU0rtJeeUqcZWv6kuYezu';
    
    public function mapSforceLead($leadArray,$sfobject){
        
        require_once 'soapclient/SforcePartnerClient.php';
    	define('ABSPATH', 'soapclient/partner.wsdl.xml');  
    	$Wsdl = ABSPATH;
    	
        try
    	{
            $sforceClient = new SforcePartnerClient();
            $soapClient = $sforceClient->createConnection($Wsdl);
            $sforceLogin = $sforceClient->login($this->sforceUsername, $this->sforcePassword.$this->sforceSecurityToken);
    	} 
    	catch(Exception $e)
    	{ 
    		return $e->getMessage(); 
    			
    	}
    	
    	
    	$DataInsert = new SObject();
    	$DataInsert->type = $sfobject;
        $DataInsert->fields = $leadArray;
    
    	try
    	{
    		$result2 = $sforceClient->create(array ($DataInsert));
            return $result2;
    	} 
    	catch(Exception $e)
    	{ 
    		return $e->getMessage(); 
    			
    	}
     }
     
     public function updateSforcelead($leadArray,$sfobject,$sf_id){
        
        
        //dpr($sf_id);
        require_once 'soapclient/SforcePartnerClient.php';
    	define('ABSPATH', 'soapclient/partner.wsdl.xml'); 
    	$Wsdl = ABSPATH;
        
        try
    	{
            $sforceClient = new SforcePartnerClient();
            $soapClient = $sforceClient->createConnection($Wsdl);
            $sforceLogin = $sforceClient->login($this->sforceUsername, $this->sforcePassword.$this->sforceSecurityToken);
    	} 
    	catch(Exception $e)
    	{ 
    		return $e->getMessage(); 
    			
    	}
    	
    	
    	$DataInsert = new SObject();
    	$DataInsert->type = $sfobject;
        $DataInsert->Id = $sf_id;
        $DataInsert->fields = $leadArray;
    
        //dpr($DataInsert);
    	try
    	{
    		$result2 = $sforceClient->update(array ($DataInsert));
            return $result2;
    	} 
    	catch(Exception $e)
    	{ 
    		return $e->getMessage(); 
    			
    	}
     }
     
     /*function mapSforceOpportunity($DataInsert){
        include 'soapclient/SforceEnterpriseClient.php';
    	define('ABSPATH', 'soapclient/enterprise.wsdl.xml'); 
    	$Wsdl = ABSPATH;
        
    	$sforceClient = new SforceEnterpriseClient();
    	$soapClient = $sforceClient->createConnection($Wsdl);
        
    	$sforceLogin = $sforceClient->login($this->sforceUsername, $this->sforcePassword.$this->sforceSecurityToken);
        
        //$DataInsert = new stdClass();
        //$DataInsert->Name  = 'njfdgjdjfgb';
        //$DataInsert->StageName   = 'dfsdfsdfsf';
        //$DataInsert->CloseDate   = '2013-05-28';
        
    	try
    	{
            $result2 = $sforceClient->create(array($DataInsert),'Opportunity');
            //dpr($result2);die;
            return $result2->success;
    	} 
    	catch(Exception $e)
    	{ 
    		return $e->getMessage(); 
    			
    	}
     }*/
    
 }
 
 
?>