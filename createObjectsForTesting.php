<?php

/*
 * Script created for creating new Objects in an ONTRAPORT account
 * The IDs of the Objects are stored in specific variables: e.g. $objectName_id
 * Useful for brand new test accounts with no data or Objects.
 */

// ONTRAPORT SDK
require_once('PATH_TO/Ontraport.php');

use OntraportAPI\Ontraport as Client;
use OntraportAPI\ObjectType;

$app_id = "2_XXXXX_XXXXX";
$api_key = "XXXXXXXXXX";

$test_id = uniqid("apiTest_");
echo "All Objects created will have the name of: ".$test_id."\n\n";

// Create a new Tag
echo "********** CREATING NEW TAG **********\n";
$client = new Client($app_id, $api_key);
$tag_params = array(
    "objectID" => ObjectType::TAG,
    "tag_name" => $test_id,
    "object_type_id" => ObjectType::CONTACT
);

var_dump($tag = json_decode($client->object()->create($tag_params), true));

$tag_id = $tag["data"]["tag_id"];

// Create a new Task
echo "********** CREATING NEW TASK **********\n";
$task_params = array(
  "alias" => "Task" . $test_id,
  "type" => "Task",
  "object_type_id" => ObjectType::CONTACT,
  "subject" => $test_id,
  "from" => "owner",
  "task_data" => "[First Name], please complete this task.",
  "due_date" => 3, // Days after assignment
  "task_owner" => 1,
);

var_dump($task = json_decode($client->message()->create($task_params), true));
$task_id = $task["data"]["id"];

// Create a new Legacy Message
echo "********** CREATING NEW EMAIL **********\n";
$email_params = array(
  "alias" => "LegacyMessage" . $test_id,
  "type" => "e-mail",
  "object_type_id" => ObjectType::CONTACT,
  "subject" => "LegacyMessage" . $test_id,
  "from" => "owner",
  "plaintext" => "Hi [First Name]! This message was created via the PHP SDK!",
  "message_body" => "<p>Hi [First Name]! This message was created via the PHP SDK!</p>"
);

var_dump($email = json_decode($client->message()->create($email_params), true));
$email_id = $email["data"]["id"];

// Create a new Tax
echo "********** CREATING NEW TAX **********\n";
$tax_params = array(
  "objectID" => ObjectType::TAX,
  "name" => $test_id,
  "rate" => "9.99"
);

var_dump($tax = json_decode($client->object()->create($tax_params), true));
$tax_data = $tax["data"];

// Create a new Product
echo "********** CREATING NEW PRODUCT **********\n";
$product_params = array(
  "objectID" => ObjectType::PRODUCT,
  "name" => $test_id,
  "price" => "300"
);

var_dump($product = json_decode($client->object()->create($product_params), true));
$product_data = $product["data"];

// Create a new Contact
echo "********** CREATING NEW CONTACT **********\n";
$contact_params = array(
  "objectID" => ObjectType::CONTACT,
  "firstname" => "API",
  "lastname" => "Test",
  "email" => $test_id . "@example.com"
);

var_dump($contact = json_decode($client->object()->create($contact_params), true));

$contact_id = $contact["data"]["id"];

// Echo the URL for the Contact's Record
echo "https://app.ontraport.com/#!/contact/edit&id=".$contact_id."\n\n";
