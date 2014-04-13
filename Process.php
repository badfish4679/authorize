<?php
require("config.php");
$transaction = new AuthorizeNetAIM;
$transaction->setSandbox(AUTHORIZENET_SANDBOX);
$transaction->setFields(
    array(
        'amount' => '1.00',
        'card_num' => $_POST['card_num'],
        'exp_date' => $_POST['exp_date'],
        'first_name' => $_POST['first_name'],
//        'last_name' => 'Ortega',
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'country' => $_POST['country'],
        'zip' => $_POST['zip'],
        'card_code' => $_POST['card_code'],
    )
//    array(
//        'amount' => '1.00',
//        'card_num' => $_POST['card_num'],
//        'exp_date' => $_POST['exp_date'],
//        'first_name' => $_POST['first_name'],
////        'last_name' => 'Ortega',
//        'address' => $_POST['address'],
//        'city' => $_POST['city'],
//        'state' => $_POST['state'],
//        'country' => $_POST['country'],
//        'zip' => $_POST['zip'],
//        'card_code' => $_POST['card_code'],
//    )
);
//echo (AUTHORIZENET_SANDBOX ? AuthorizeNetDPM::SANDBOX_URL : AuthorizeNetDPM::LIVE_URL);
// Authorize Only:
$response  = $transaction->authorizeOnly();
$result = array();
$result['authorize'] = $response->approved;
if ($response->approved) {

    $auth_code = $response->transaction_id;
//    echo 'auth_code='.$auth_code.'<pre>';
//    print_r($response);
//    echo '</pre>';

    // thanh toan
    $capture = new AuthorizeNetAIM;
    $capture->setSandbox(AUTHORIZENET_SANDBOX);
    $capture_response = $capture->priorAuthCapture($auth_code);
    $result['capture'] = $capture_response->approved;
    //$capture_response->approved = 1 -> ok
//    echo '<br>capture response = <pre>';print_r($capture_response);
//    echo '</pre>';

    // refund
    $void = new AuthorizeNetAIM;
    $void->setSandbox(AUTHORIZENET_SANDBOX);
    $void_response = $void->void($capture_response->transaction_id);
//    echo '<br>void = <pre>';print_r($void_response);
//    echo '</pre>';
    $result['refurn'] = $void_response->approved;
}
header('Content-Type: application/json');
echo json_encode($result);