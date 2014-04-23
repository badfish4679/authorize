<?php
class Yahoo
{
    public $cookies = 'cookie.txt';
    private $user = null;
    private $pass = null;

    /*Data generated from cURL*/
    public $content = null;
    public $response = null;

    /* Links */
    private $url = array(
        'login'     => 'https://login.yahoo.com',
        'submitlogin'    => 'https://login.yahoo.com/config/login'
    );

    /* Fields */
    public $data = array();

    public function __construct ($user, $pass)
    {

        $this->user = $user;
        $this->pass = $pass;

    }
    public function login(){
        $this->cURL($this->url['login']);
//        var_dump($this->cookies);

        if($form = $this->getElement($this->content,'form','method',"post"))
        {
            $fields = $this->getInputs($form);
            $fields['login'] = $this->user;
            $fields['passwd'] =$this->pass;
            $this->cURL($this->url['submitlogin'], $fields,'https://login.yahoo.com/');

            echo $this->content;exit;
        }
        echo $this->content;exit;

    }
//
//    public function login(){
//        $this->cURL($this->url['login']);
//        if($fields = $this->getFormFields($this->content,'login_form'))
//        {
//            $fields = $this->getInputs($fields);
//            $fields['login'] = $this->user;
//            $fields['passwd'] =$this->pass;
//            $this->cURL($this->url['submitlogin'], $fields);
//            echo $this->content;exit;
//        }
//        echo $this->content;exit;
//
//    }
    private function getFormFields($data, $id)
    {
        if (preg_match('/(<form.*?name=.?'.$id.'.*?<\/form>)/is', $data, $matches)) {
            $inputs = $this->getInputs($matches[1]);

            return $inputs;
        } else {
            return false;
        }

    }
    public function cURL($url, $post = false, $ref = "")
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookies);
//        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookies);
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        if($post)   //if post is needed
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($ref != ""){
            curl_setopt($ch, CURLOPT_REFERER, $ref);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        $this->content = curl_exec($ch);
        preg_match('/^Set-Cookie:\s*([^;]*)/mi', $this->content, $m);
        $this->cookies = $m[1];
//        parse_str($m[1], $this->cookies);
        $this->response = curl_getinfo( $ch );
        $this->url['last_url'] = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
    }
    function getElement($content,$tag,$code,$attr){
        $queue = 0;
        $count = 0;
        $done = FALSE;
        $begin = 0;
        $end = strlen($content);
        if(($begin = strpos($content,$code.'="'.$attr.'"')) > 0){
            $begin = strpos($content,">",$begin) + 1;
            $queue ++;
        }
        else return "";
        $posK = $begin;

        while(!$done){
            $pos2t = strpos($content,"</".$tag,$posK);
            $pos1t = strpos($content,"<".$tag,$posK);

            if($pos1t < $pos2t){
                $queue++;
                $posK = $pos1t + 1;
            }
            else{
                $queue--;
                $posK = $pos2t + 1;
            }
            if($queue == 0){
                $done= TRUE;
                $end = $pos2t;
            }
            $count++;
            if($count>100) {
                $done = TRUE;
                $end = $pos2t;
            }
        }
        return substr($content,$begin,($end-$begin));
    }

    function getInputs($form)
    {
        $inputs = array();

        $elements = preg_match_all('/(<input[^>]+>)/is', $form, $matches);

        if ($elements > 0) {
            for($i = 0; $i < $elements; $i++) {
                $el = preg_replace('/\s{2,}/', ' ', $matches[1][$i]);

                if (preg_match('/name=(?:["\'])?([^"\'\s]*)/i', $el, $name)) {
                    $name  = $name[1];
                    $value = '';

                    if (preg_match('/value=(?:["\'])?([^"\'\s]*)/i', $el, $value)) {
                        $value = $value[1];
                    }

                    $inputs[$name] = $value;
                }
            }
        }

        return $inputs;
    }
}
$yahoo = new Yahoo('thang002','thangpro238');
$yahoo->login();

/*
 *
function yahoo($mail,$pass)
{
$result = "cardError('".$mail.' | '.$pass."', '".$_sock."', 'Unknown Error');";
$ListFailed[] = 'AUTHENTICATIONFAILED';
$ListFailed[] = 'Invalid';
$ListFailed[] = 'Incorrect';
$ListFailed[] = 'failed';
$mboxconnstr = '{imap.mail.yahoo.com:993/imap/ssl/novalidate-cert}';
$imap = imap_open($mboxconnstr, $mail, $pass, OP_SHORTCACHE, 0);
if($imap)
{
imap_close($imap);
$result = "cardLive('".$mail.' | '.$pass.' | '.$_sock.' | '.$resuft['info']."', '".$_sock."', '".$credit."');";
}
else
{
//echo '3';
$Last_Error = imap_errors();
imap_close($imap);
foreach ($ListFailed as $Failed) if(inStr(strtolower($Last_Error[0]), strtolower($Failed))) $result = "cardDie('".$mail.' | '.$pass."', '".$_sock."', '".$credit."');";
if(inStr($Last_Error[0], 'Host not found')) $result = "cardError('".$mail.' | '.$pass."', '".$_sock."', 'Cant Check');";
}
return $result;
}

function yahoo($mail,$pass)
{
$result = "cardError('".$mail.' | '.$pass."', '".$_sock."', 'Unknown Error');";
$ListFailed[] = 'AUTHENTICATIONFAILED';
$ListFailed[] = 'Invalid';
$ListFailed[] = 'Incorrect';
$ListFailed[] = 'failed';
$mboxconnstr = '{imap.mail.yahoo.com:993/imap/ssl/novalidate-cert}';
$imap = imap_open($mboxconnstr, $mail, $pass, OP_SHORTCACHE, 0);
if($imap)
{
imap_close($imap);
$result = "Login Success";
}
else
{
//echo '3';
$Last_Error = imap_errors();
imap_close($imap);
foreach ($ListFailed as $Failed) if(inStr(strtolower($Last_Error[0]), strtolower($Failed))) $result = "Login Failed";
if(inStr($Last_Error[0], 'Host not found')) $result = "Error iMap";
}
return $result;
}
 */

