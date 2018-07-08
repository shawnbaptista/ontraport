<?php

// ONTRAPORT SDK
require_once('../../3.0/api/sdks/php/src/Ontraport.php');

use OntraportAPI\Ontraport as Client;
use OntraportAPI\Models\Rules\RuleBuilder as Builder;
use OntraportAPI\Models\Rules\Events;
use OntraportAPI\Models\Rules\Conditions;
use OntraportAPI\Models\Rules\Actions;
use OntraportAPI\ObjectType;

$app_id = "2_179937_ayFpnzada";
$api_key = "34izO5mzTM72ln8";

$test_id = uniqid("apiTest_");
echo "All Objects created will have the name of: ".$test_id."\n\n";

// Create a new tag for new contacts
echo "********** CREATING NEW TAG **********\n";
$client = new Client($app_id, $api_key);
$tag_params = array(
    "objectID" => ObjectType::TAG,
    "tag_name" => $test_id,
    "object_type_id" => ObjectType::CONTACT
);

var_dump($tag = json_decode($client->object()->create($tag_params), true));

$tag_id = $tag["data"]["tag_id"];
