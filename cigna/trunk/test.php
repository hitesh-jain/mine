<?php
    include 'soapclient/SforcePartnerClient.php';
	define('ABSPATH', 'soapclient/partner.wsdl.xml');  
	$Wsdl = ABSPATH;
	$sforceUsername = 'saasadmin@saasforce.in';
	$sforcePassword = 'saasforce123';
	$sforceSecurityToken = 'JWTIU0rtJeeUqcZWv6kuYezu';
	
	$sforceClient = new SforcePartnerClient();
	$soapClient = $sforceClient->createConnection($Wsdl);
	$sforceLogin = $sforceClient->login($sforceUsername, $sforcePassword.$sforceSecurityToken);
	
	$DataInsert = new SObject();
	$DataInsert->type = 'Lead';
	$DataInsert->Id = $sfdc;
	$DataInsert->fields=array(
		'LastName' => 'testasdasdasd',
		'FirstName' => 'testdbdbdb'		
	);

	try
	{
		$result2 = $sforceClient->create(array ($DataInsert));
        print_r($result2);die;
	} 
	catch(Exception $e)
	{ 
		echo $e->getMessage(); 
			
	}
?>