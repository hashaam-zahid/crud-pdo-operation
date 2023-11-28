<?php
class country
{
	public $CountryId;
	public $arrField;
	public $arrValue;
	private $objDb;
	
	function __construct()
	{
		 // Load dbconnect Object
		 
		require_once("../dbconnect/db_connect.php");
		$this->objDb=new db_connect();
	}
	// Get Country
	
	function GetAllCountry()
	{
	     $this->arrField=array("*");
		 return $this->objDb->SelectRecord($this->arrField,"countries","");
	}
	
	// Get city with Country Id 
	
	function GetCityByCountryId()
	{    
		$this->arrField=array("Id","Name");
		$sCondition="where CountryId=$this->CountryId order by Name desc";
		return $this->objDb->SelectRecord($this->arrField,"city",$sCondition);
	}
     
	 // Insert Country
	
	function InsertCountry()
	{
	return $this->objDb->InsertRecord("countries",$this->arrField,$this->arrValue);
	}
	
	// Update  Country
	
	function UpdateCountry()
	{
	   $sCondition="where CountryId=$this->CountryId";

		return $this->objDb->UpdateRecord("countries",$this->arrField,$this->arrValue,$sCondition);
	}
  
  // Delete 
   
   function DeleteCountry()
	{
		$sCondition="where Id=$this->CountryId";
		return $this->objDb->DeleteRecord("countries",$sCondition);
	}

}
?>