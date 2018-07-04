<?php

// ONTRAPORT SDK & Keys
require_once('XXXXXXXXXX');
use OntraportAPI\CurlClient;
use OntraportAPI\Ontraport;
use OntraportAPI\ObjectType;

define("ONTRAPORT_API_ID", "XXXXXXXXXX");
define("ONTRAPORT_API_KEY", "XXXXXXXXXX");
$header = "XXXXXXXXXX";

$file = "saveDataToThisFile.txt";

$client = new CurlClient();
$client->setRequestHeader("X-op-env", $header);

$ontraport = new Ontraport(ONTRAPORT_API_ID, ONTRAPORT_API_KEY, $client);

// Retrieve meta data of ALL objects in the account
$response = $ontraport->object()->retrieveMeta();

$response = json_decode($response, true);

// Create an array to hold the objectIDs returned by the retrieveMeta call
$objectIDs = array();

// Loop through and save the array keys
foreach (array_keys($response["data"]) as $objectID)
{
  $objectIDs[] = $objectID;
}

// Check if the returned data is correct
var_dump($objectIDs);

// Loop through and save the data to the $file
foreach ($objectIDs as $objectID) {
  $requestParams = array(
    "objectID" => $objectID
  );

  $response = $ontraport->object()->retrieveMultiple($requestParams);

  $current = file_get_contents($file);
  $current .= "**************************************************************\n";
  $current .= "#################### " . "ObjectID: " . $objectID . " ####################" . "\n";
  $current .= $response;
  $current .= "\n\n";

  file_put_contents($file, $current);
}

echo "********** SCRIPT COMPLETE **********";
