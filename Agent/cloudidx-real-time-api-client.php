<?php
    session_start();

/**
 * @abstract Example client code for CloudIDX Real-Time API. 
 *           Tested with PHP 5.4.17 on Mac OS X 10.9 and PHP 5.3.2 on Ubuntu 10.04.4 LTS, and PHP 5.5.9 on Windows 8
 *  
 * @author Glenn Flinchbaugh
 * @since 3/6/14
 * 
 */

// Credentials for demo iHomefinder API account
$clientId = '65912'; //  5-digit iHomefinder demo client ID
$password = 'cloudidx'; // account password

// Provide query parameters
$cityName = 'Cameron Park,El Dorado Hills';
$minListPrice = '540000';
$maxListPrice = '540000';

/* Other search parameters you can additionally use 
$bedrooms = '3';
$fullBaths = '2';*/
//$propertyType = 'SFR'; // Single Family Residence (SFR), Condominium (CND), Lots & Land (LL), Rental (RNT), 
                           // Residential Income (RI), Commercial (COM), Mobile/Manufactured Home (MH), Farm (FRM)
//$newConstructionYn = false;
//$openHomesOnlyYn = false;
//$squareFeet = '3000';
//$lotAcres = '0.1'; // minimum required lot acreage
//$zip = '94705,94707,94708'; // use cities or zips, but not both



// Setup login call
$url = 'https://www.idxhome.com/restServices/cloud-idx/login';
$urlParams = array(
					'clientId'	=> $clientId,
					'password'	=> $password
					);

$responseArray = cloudIDXCall($url, 'post', $urlParams); // Make the login call
//print_r($responseArray);
if (empty($responseArray) or isset($responseArray['failure']) or trim($responseArray['message']) == 'Client authentication failed.') {
	print_r("Login failed!");
	exit;
}

// Extract the resource URLs from the login response
$links = array();
foreach ($responseArray['links'] as $resource) {
	$links[$resource['rel']] = $resource['href'];
}
//print_r($links);


// Get a list of cities that are available for this account
$url = $links['cities'];
$responseArray = cloudIDXCall($url, 'get'); 
//print_r($responseArray);
if (isset($responseArray['failure']) or isset($responseArray['message'])) {
	print_r("cities method call failed!");
	exit;
}


// Find ID for cities set above
$cityNameArray = str_getcsv($cityName); // convert comma-separated list of city names to array
$cityIdArray = array();
foreach ($responseArray['cities'] as $city) {
	if (in_array (trim($city['label']), $cityNameArray)) {
		$cityIdArray[] = $city['fieldValue'];
	}
}
if (empty($cityIdArray)) {
	print_r("specified city not present");
	exit;
}
$cityString = implode(',', $cityIdArray); // convert array of city IDs to comma-separated list


// Get a list of zips that are available for this account
$url = $links['zips'];
$responseArray = cloudIDXCall($url, 'get'); // Make the zips method call
//print_r($responseArray);
if (isset($responseArray['failure']) or isset($responseArray['message'])) {
	print_r("zips method call failed!");
	exit;
}


// Do a search on the city, property type, min/max price, etc.
$searchProfile = array(	'cityId' => $cityString, 
						//'zip' => $zip,
						'propertyType' => $propertyType,
						'minListPrice' => $minListPrice, 
						'maxListPrice' => $maxListPrice,
						'bedrooms' => $bedrooms,
						'fullBaths' => $fullBaths,
						'newConstructionYn' => $newConstructionYn,
						'openHomesOnlyYn' => $openHomesOnlyYn,
						'squareFeet' => $squareFeet,
						'lotAcres' => $lotAcres
					);
$url = $links['search'];
$responseArray = cloudIDXCall($url, 'get', $searchProfile); // Make the search method call
//print_r($responseArray);
if (isset($responseArray['failure']) or isset($responseArray['message'])) {
	print_r("search method call failed!");
	exit;
}
require('../databaseConnection.php');
$dbConn = getConnection();

foreach ($responseArray['listingSummaryDtoList'] as $homes => $home) {
    /*echo $home['address']['street'];
    echo $home['address']['streetNumber'] . " " . $home['address']['street'] . " " . $home['address']['city'] . " " . $home['address']['state'] . " " . $home['address']['postalCode'] . " " . $home['listPrice'] . " " . $home['bedrooms'] . " " . $home['fullBaths'] . " " . $home['halfBaths'] . " " . $home['status'] . "<br>";*/

    $sql = "INSERT INTO HouseInfo
                 (userId, status, address, city, state, zip, bedrooms, bathrooms, price)
                 VALUES (:userId, :status, :address, :city, :state, :zip, :bedrooms, :bathrooms, :price)";
          $namedParameters = array();
          $namedParameters[":userId"] = $_SESSION['userId'];
          $namedParameters[":status"] = strtolower($home['status']);
          $namedParameters[":address"] = $home['address']['streetNumber'] . " " . $home['address']['street'];
          $namedParameters[":city"] = $home['address']['city'];
          $namedParameters[":state"] = $home['address']['state'];     
          $namedParameters[":zip"] = $home['address']['postalCode'];     
          $namedParameters[":bedrooms"] = $home['bedrooms'];     
          $namedParameters[":bathrooms"] = $home['fullBaths'];     
          $namedParameters[":price"] = $home['listPrice'];     
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
}

header("Location: AgentHome.php");


// Get listing details for the first listing from the search results
if (! isset($responseArray['cloudIdxListingSummaryList'][0])) exit;
$listingNumber = $responseArray['cloudIdxListingSummaryList'][0]['listingNumber'];
$boardId = $responseArray['cloudIdxListingSummaryList'][0]['boardId']; // need to retrieve boardId if account has multiple boards
$listingParam = array('listingNumber' => $listingNumber, 'boardId' => $boardId);
$url = $links['detail'];
$responseArray = cloudIDXCall($url, 'get', $listingParam); // Make the search method call
//print_r($responseArray);
if (isset($responseArray['failure']) or isset($responseArray['message'])) {
	print_r("detail method call failed!");
	exit;
}


/**
 * @abstract Execute a CloudIDX Real-Time API method call using POST or GET
 *  
 * @param string $url -- URL of method
 * @param string $method -- 'post' or 'get' request method
 * @param array $urlParams -- parameters to be submitted to method; associative array
 * 
 * @return array method call results or failure message; associative array
 */
function cloudIDXCall($url, $method, $data = array()) {

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // return response as a string
	curl_setopt($curl, CURLOPT_SSLVERSION, 3); // force default SSL version to 3	
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // turn off verification of the remote server's certificate - helps with Windows

	$queryString = http_build_query($data); // pack parameters into a URL query string
	
	if ($method == 'get') {
		// GET is the default request method for cURL
		if (strlen($queryString) > 0) $url = $url . '?' . $queryString; // append parameters for GET
	} elseif ($method == 'post') {
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $queryString); // set parameters for POST
	} else {
		return array('failure' => 'Invalid method');
	}
	
	curl_setopt($curl, CURLOPT_URL, $url);
	$response = curl_exec($curl);
	
	if ( !$response ) {
		$errMsg = "Error: " . curl_error($curl) . " - Code: " . curl_errno($curl);
		curl_close($curl);
		return array('failure' => $errMsg);
	}
	
	$responseArray = json_decode ($response, $assoc = true); // decode JSON into assoc array
	curl_close($curl);
	return $responseArray;

}

header("Location: AgentHome.php");

?>