<?php
require("config.php");
$transaction = new AuthorizeNetAIM;
$transaction->setSandbox(AUTHORIZENET_SANDBOX);
$transaction->setFields(
    array(
        'amount' => '1.99',
        'card_num' => '4389610000563816',
        'exp_date' => '05/14',
        'first_name' => 'Robert',
        'last_name' => 'Ortega',
        'address' => '527 Atascadero Road',
        'city' => 'Morro Bay',
        'state' => 'CA',
        'country' => 'US',
        'zip' => '93442',
        'card_code' => '827',
    )
);
//echo (AUTHORIZENET_SANDBOX ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL);
// Authorize Only:
$response  = $transaction->authorizeOnly();

if ($response->approved) {
    $auth_code = $response->transaction_id;
    echo 'auth_code='.$auth_code.'<pre>';
    print_r($response);
    echo '</pre>';

    // thanh toan
    $capture = new AuthorizeNetAIM;
    $capture->setSandbox(AUTHORIZENET_SANDBOX);
    $capture_response = $capture->priorAuthCapture($auth_code);
    //$capture_response->approved = 1 -> ok
    echo '<br>capture response = <pre>';print_r($capture_response);
    echo '</pre>';

    // refund
    $void = new AuthorizeNetAIM;
    $void->setSandbox(AUTHORIZENET_SANDBOX);
    $void_response = $void->void($capture_response->transaction_id);
    echo '<br>void = <pre>';print_r($void_response);
    echo '</pre>';
}
else{
    echo 'not authorize';
}