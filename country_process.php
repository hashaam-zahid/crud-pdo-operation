<?php

// Load Country object

require_once("classes/country.php");
$objCountry=new country();

// Get All Countries

$resultGetAllCountry=$objCountry->GetAllCountry();

// check countries exist 
if($resultGetAllCountry->num_rows > 0) :
while($rowGetAllCountry=$resultGetAllCountry->fetch_array(MYSQLI_BOTH))
{
  
  echo   $rowGetAllCountry->name;
  echo    '<br>';
  echo  $rowGetAllCountry->id;
}
else :
	echo ('Something went wrong while fetching country, Try Later');
endif;

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
