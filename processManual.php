<?php

require_once('XXXXXXXXXX');

use OntraportAPI\Ontraport;

/* Supply the API credentials through command line arguments... and the Contact ID you want charged:
e.g. php -f filename.php -- 2_XXXXX_XXXXXXX XXXXXXXXXX 12345
*/
$api_id = $argv[1];
$api_key = $argv[2];

// testing@example.com CID 785070
$contact_id = $argv[3];

$client = new Ontraport($api_id, $api_key);
$requestParams = array(
  "contact_id"       => $contact_id,
  "chargeNow"        => "chargeNow",
  "trans_date"       => time(),
  "invoice_template" => 1,
  "gateway_id"       => 1,
  "offer"            => array(
    "products"         => array(
      array(
        "quantity" => 1,
        "shipping" => false,
        "tax" => false,
        "price" => array(
          array(
            "price" => 40,
            "payment_count" => 0,
            "id"            => 1
          )
       ),
       "type" => "single",
       "owner" => 1,
       "id" => 1
      )
    )
  )
);
$response = $client->transaction()->processManual($requestParams);
