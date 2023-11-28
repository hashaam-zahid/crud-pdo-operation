<?php

// Load Country object

require_once("classes/country.php");
$objCountry=new country();

// Get All Countries

$resultGetAllCountry=$objCountry->GetAllCountry();

while($rowGetAllCountry=$resultGetAllCountry->fetch_array(MYSQLI_BOTH))
{
  
  echo   $rowGetAllCountry->name;
  echo    '<br>';
  echo  $rowGetAllCountry->id;
}


// Get City By Country Id

$objCountry->CountryId=$_GET['country_id']; 

$resultCityByCountryId=$objCountry->GetCityByCountryId();

$rowCityByCountryId=$resultCityByCountryId->fetch_array(MYSQLI_BOTH);  
 
 echo   $rowCityByCountryId->name;
 echo  '<br>';
 echo  $rowCityByCountryId->id;

   
   // Inserting Country 

    $objCountry->arrFields=array("Name");
	$objCountry->arrValues=array($_POST['txtCountryName']); // Get from Form
	$record_id=$objCountry->InsertCountry();	
	if($record_id > 0)
	{
	 // successful
	
	}
	else
	{
		echo ("Something Went Wrong While Inserting Country, Try Later");
	}
	
	// Update Country 

    $objCountry->arrFields=array("Name");
	$objCountry->arrValues=array($_POST['txtCountryName']); // Get from Form
	$objCountry->CountryId=$_GET['country_id'];
	$record_id=$objCountry->UpdateCountry();	
	if($record_id > 0)
	{
	 // successful Updated
	
	}
	else
	{
		echo ("Something Went Wrong While Update Country, Try Later");
	}
	
	
	// Delete Country
	
	$objCountry->CountryId=$_GET['country_id'];
	$objcountry->DeleteCountry();


?>
please make my code as composer package and readme file for github , i have created package CRUD OOP with PDO  first i have configration.php file with configuration class where const variable declear <?php
class configuration
{
	const sDbServerName="localhost";
	const sDbUserName="root";
	const sDbPassword="";
	const sDbName="evs";
}
//echo(Configuration::sDbServerName);
?>, second i have db_connect.php where all curd operations perform with PDO Process <?php
class db_connect
{
	private $sServerName;
	private $sDbUserName;
	private $sDbPassword;
	private $sDbName;
	private $dbConnect;

	function __construct()
	{
		require_once('../configuration.php');
		
		$this->sServerName = configuration::sDbServerName;
		$this->sDbUserName = configuration::sDbUserName;
		$this->sDbPassword = configuration::sDbPassword;
		$this->sDbName = configuration::sDbName;

		try {
			$this->dbConnect = new PDO("mysql:host=$this->sServerName;dbname=$this->sDbName", $this->sDbUserName, $this->sDbPassword);
			$this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
	}

	function InsertRecord($pStrTableName, $pArrField, $pArrValue)
	{
		$fieldString = implode(',', $pArrField);
		$valuePlaceholder = implode(',', array_fill(0, count($pArrValue), '?'));

		$strSql = "INSERT INTO $pStrTableName ($fieldString) VALUES ($valuePlaceholder)";

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute($pArrValue);

			return $this->dbConnect->lastInsertId();
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	function SelectRecord($pArrayField, $pStrTableName, $pStrCondition = "")
	{
		$fieldString = implode(',', $pArrayField);
		$strSql = "SELECT $fieldString FROM $pStrTableName $pStrCondition";
		

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute();

			return $stmt;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	function DeleteRecord($pStrTableName, $pStrCondition)
	{
		$strSql = "DELETE FROM $pStrTableName $pStrCondition";

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	function UpdateRecord($pStrTable, $pArrField, $pArrValue, $pStrCondition)
	{
		$setValues = array();
		foreach ($pArrField as $field) {
			$setValues[] = "$field=?";
		}
		$setString = implode(',', $setValues);

		$strSql = "UPDATE $pStrTable SET $setString $pStrCondition";

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute($pArrValue);

			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
}
?>
, thirdly i have class country.php where all Objects of country are set create, read, update , delete <?php
class country
{
	public $CountryId;
	public $arrField;
	public $arrValue;
	private $objDb;
	
	function __construct()
	{
		require_once("db_connect.php");
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
?>, fourth finnally i have country_process.php page where all country object intialize from country class <?php

// Load Country object

require_once("classes/country.php");
$objCountry=new country();

// Get All Countries

$resultGetAllCountry=$objCountry->GetAllCountry();

while($rowGetAllCountry=$resultGetAllCountry->fetch_array(MYSQLI_BOTH))
{
  
  echo   $rowGetAllCountry->name;
  echo    '<br>';
  echo  $rowGetAllCountry->id;
}


// Get City By Country Id

$objCountry->CountryId=$_GET['country_id']; 

$resultCityByCountryId=$objCountry->GetCityByCountryId();

$rowCityByCountryId=$resultCityByCountryId->fetch_array(MYSQLI_BOTH);  
 
 echo   $rowCityByCountryId->name;
 echo  '<br>';
 echo  $rowCityByCountryId->id;

   
   // Inserting Country 

    $objCountry->arrFields=array("Name");
	$objCountry->arrValues=array($_POST['txtCountryName']); // Get from Form
	$record_id=$objCountry->InsertCountry();	
	if($record_id > 0)
	{
	 // successful
	
	}
	else
	{
		echo ("Something Went Wrong While Inserting Country, Try Later");
	}
	
	// Update Country 

    $objCountry->arrFields=array("Name");
	$objCountry->arrValues=array($_POST['txtCountryName']); // Get from Form
	$objCountry->CountryId=$_GET['country_id'];
	$record_id=$objCountry->UpdateCountry();	
	if($record_id > 0)
	{
	 // successful Updated
	
	}
	else
	{
		echo ("Something Went Wrong While Update Country, Try Later");
	}
	
	
	// Delete Country
	
	$objCountry->CountryId=$_GET['country_id'];
	$objcountry->DeleteCountry();


?>