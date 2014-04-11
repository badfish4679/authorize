<?php
include("config.php");
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

    // Now capture:
    $capture = new AuthorizeNetAIM;
    $capture->setSandbox(AUTHORIZENET_SANDBOX);
    $capture_response = $capture->priorAuthCapture($auth_code);
    echo '<br>capture response = <pre>';print_r($capture_response);
    echo '</pre>';

    // Now void:
    $void = new AuthorizeNetAIM;
    $void->setSandbox(AUTHORIZENET_SANDBOX);
    $void_response = $void->void($capture_response->transaction_id);
    echo '<br>void = <pre>';print_r($void_response);
    echo '</pre>';
}
else{
    echo 'not authorize';
}

/*
 *  248750|4231907246438344|1|2017|303| |Jennifer N Gillman|Nicole N Tim|Gillman|158 McGougin Rd|Brewton|36426|Alabama (AL)|US|2512305146
248047|5517390003577707|8|2016|841| |Mary E Popovich|Mary|Popovich|119 N. Third Street|West Newton|15089|Pennsylvania (PA)|US|7249723779
247919|5517390003577707|8|2016|841| |Mary E Popovich|Mary|Popovich|119 N. Third Street|West Newton|15089|Pennsylvania (PA)|US|7249723779
247761|4355480300312474|12|2014|841| |Roger A Kirschenbaum|Roger|Kirschenbaum|6745 Ridge Mill Lane|Atlanta|30328|Georgia (GA)|US|4042192664
 * 4494653283889716 | 04 | 2015 | 550 | Robert Ortega | 527 Atascadero Road | Morro Bay | CA | 93442 |8059344212 |
4465400073970875 | 07 | 2014 | 126 | Kelly Weber | 423 Cuesta Dr | Slo | CA | 93405 | | 5104684716||
 */

