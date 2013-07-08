<?php
/*This is the main class which will be called from drupal custom module i.e product_configurator.
*/

class productConfigurator{
	public  $_client;
	private $_classObj;
	private $_classObjArray;
	private $_result;

	//Initialize class object.
	public function __construct(){
	//	$this->createObject();
	}


public function getQuote($functionName, $params)
    {
        $options =   array('trace' => 1,
                            'exceptions' => true,
                            'cache_wsdl' => WSDL_CACHE_NONE,
                            'features' => SOAP_USE_XSI_ARRAY_TYPE,

                            // Auth credentials for the SOAP request.
                            // 'login' => 'username',
                            //  'password' => 'password',

                            // Proxy url.
                            // 'proxy_host' => 'localhost', // Do not add the schema here (http or https). It won't work.
                            // 'proxy_port' => 8080,

                            // Auth credentials for the proxy.
                            //  'proxy_login' => NULL,
                            //  'proxy_password' => NULL,
                            );

        $wsdlUrl ="http://122.170.116.174:8090/systemcommon/services/ComputeQuotationListPremium?wsdl";
        try{
            
            $client = new SoapClient($wsdlUrl, $options);
            $response = $client->$functionName($params);
            
            return $response; 
        }
        catch (SoapFault $exception){
            
            return($exception->getMessage());
        }

    }
 public function getProduct($date=NULL)
     {
         $options =   array('trace' => 1,
                            'exceptions' => true,
                            'cache_wsdl' => WSDL_CACHE_NONE,
                            'features' => SOAP_USE_XSI_ARRAY_TYPE,

                            // Auth credentials for the SOAP request.
                            // 'login' => 'username',
                            //  'password' => 'password',

                            // Proxy url.
                            // 'proxy_host' => 'localhost', // Do not add the schema here (http or https).
                            // 'proxy_port' => 8080,

                            // Auth credentials for the proxy.
                            //  'proxy_login' => NULL,
                            //  'proxy_password' => NULL,
                            );
                            

  $wsdlUrl ='http://122.170.116.174:8090/systemcommon/services/GetProductDetails?wsdl';
  try{
      $client = new SoapClient($wsdlUrl,$options);
      $response=$client->getproductdetails(array('WSProductListIO'=>array('listofproductTO'=>array('launchDt'=>$date))));
      
      return $response;
      }
  catch(Exception $exception){
    
        return 'No Service Available';
    //   return($exception->getMessage());
       }

    }
}


?>

