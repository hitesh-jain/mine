<?php
/*This is the main class which will be called from drupal custom module i.e product_configurator.
*/

class Quotation{
	public  $_client;
	private $_classObj;
	private $_classObjArray;
	private $_result;

	/*
		Initialize class object.
	*/
	public function __construct(){
		//$this->createObject();
	}

	public function createObject(){
		//$this->client = new SoapClient("info.wso.xml");
		//$this->client = mysql_connect('192.168.0.8', 'CignaTTK', 'Cigna');
       // $this->client = mysql_connect('localhost', 'root', '');
       // mysql_select_db("pc",$this->client);
		if (!$this->client) {
			die('Not connected : ' . mysql_error());
		}
	}
	public function compute($functionName,$object){
		$this->_classObjArray = Array("calculatePremium");
		if(in_array($functionName,$this->_classObjArray)){
			$this->$functionName($object);
		}else{
			$this->error($functionName ." does not exists.");
		}
		return $this->output();
	}
	
	/*
	 *This function will calculatePremium.
	 *Input will be object having following fields.
	   No of Adults INTEGER, 
	   No of Kids	INTEGER, 
	   Tenure	INTEGER, 
	   Sum Insured Value FLOAT, 
	   Age STRING, 
	   Gender STRING, 
	   City STRING, 
	   Email ID STRING, 
	   Mobile Number INTEGER, 
	*/
	public function calculatePremium($object){
		
		if(!isset($object->sumInsured)){
			$this->error("Sum Insured parameter is missing.");
			return;
		}
		$this->createObject();
		
		$sql = "SELECT q.quoteId, qp.basePremium, qp.productId AS planId, q.ChannelId, q.policyType, qp.sumInsured, q.noOfAdults, q.noOfKids, qp.zoneCd,qp.discount
				FROM quotation q 
				INNER JOIN quotation_product qp ON q.productId = qp.productId
				WHERE 
					1=1 ";

		$cond = "";
		if(	isset($object->noOfAdults)	&& $object->noOfAdults!=""){
			$cond .= " AND q.noOfAdults = ".$object->noOfAdults;
		}
		if(	isset($object->noOfKids)	&& $object->noOfKids!=""){
			$cond .= " AND q.noOfKids = ".$object->noOfKids;
		}
		if(	isset($object->zoneCd)	&& $object->zoneCd!=""){
			$cond .= " AND zoneCd = ".$object->zoneCd;
		}
		if(	isset($object->sumInsured)	&& $object->sumInsured!=""){
			$cond .= " AND qp.sumInsured IN( ".$object->sumInsured.")";
		}

		if(	isset($object->planId)	&& $object->planId!=""){
			$cond .= " AND qp.productId IN( ".$object->planId.")";
		}
		
		if($cond!=""){
			$sql .= $cond;
		}
		//$db_selected = mysql_select_db('pc',$this->client);
        
	//	$result = mysql_query($sql,$this->client);
		
		if(!($result)){
			$this->error(mysql_error($this->client));
			return;
		}
		$this->_result = new stdClass();
		$i=0;
		while($row = mysql_fetch_object($result)){
			$this->_result->$i = $row;
			$i++;
		}
	}

	public function output(){
		return $this->_result;
	}

	public function error($error){
		$this->_result->Error = $error;
	}
}


?>

