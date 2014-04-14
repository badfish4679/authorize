<?php
require_once('curl.class.php');
$curl = new curl;
$curl->cookiefile(createtxt());
$url = 'https://heidelpay.hpcgw.net/sgw/gtw';
$data = array(
    "stoken"=>"D2AD9B3C",
    "lang"=>"1",
"actcontrol"=>"payment",
"cl"=>"payment",
"userform"=>"",
"fnc"=>"validatepayment",
"bltsprotection"=>"0",
"stsprotection"=>"",
"paymentid"=>"0a2f3a9929234061b75f92a0af9537e0",
"FRONTEND.MODE"=>"ASYNC",
"FRONTEND.RESPONSE_URL"=>"https://www.bergzeit.co.uk/modules/efiheidelpay/public/hp_response.php",
"FRONTEND.SESSION_ID"=>"gq5pg59i951nsodo2d97cpfd21__@@step3__@@1__@@b78af5c9__@@D2AD9B3C",
"FRONTEND.RETURN_ACCOUNT"=>"true",
"REQUEST.VERSION"=>"1.0",
"SECURITY.SENDER"=>"31HA07BC811C9B7C5F3B2B2F8743C909",
"USER.LOGIN"=>"31ha07bc811c9b7c5f3b5a78a9d5c099",
"USER.PWD"=>"60F74F0C",
"TRANSACTION.MODE"=>"LIVE",
"TRANSACTION.RESPONSE"=>"SYNC",
"TRANSACTION.CHANNEL"=>"31HA07BC8100EF4AC4E90F44E824C541",
"IDENTIFICATION.TRANSACTIONID"=>"0a2f3a9929234061b75f92a0af9537e0__@@20140414-171107",
"PAYMENT.CODE"=>"CC.RG",
"NAME.GIVEN"=>"Rookie",
"NAME.FAMILY"=>"vn",
"ADDRESS.STREET"=>"street 123",
"ADDRESS.ZIP"=>"93442",
"ADDRESS.CITY"=>"Morro Bay",
"ADDRESS.STATE"=>"",
"ADDRESS.COUNTRY"=>"US",
"CONTACT.EMAIL"=>"rookievn102@gmail.com",
"CONTACT.IP"=>"58.186.53.232",
"RISKMANAGEMENT.PROCESS"=>"AUTO",
"ACCOUNT.BRAND"=>"VISA",
"ACCOUNT.NUMBER"=>"4221510001911331",
"ACCOUNT.HOLDER"=>"Rookie vn",
"ACCOUNT.MONTH"=>"07",
"ACCOUNT.YEAR"=>"2016",
"ACCOUNT.VERIFICATION"=>"590",
);
$post = $curl->post($url, $data);
$curl->close();
var_dump($post);
