<?php
function getAllDomainsFromSearch($url, $maxPages)
{
	$maxPages = ($maxPages == 0) ? 999 : $maxPages;
	$allResultPages = array();
	$finishedPages =array();
	$allResultPages[]=$url;
	$allDomains = array();
	$c = 0;
	
	do {
		$c++;

		
		if (!empty($allResultPages))
		{
			//var_dump($allResultPages);
			$results = doResultsPage($allResultPages[0]);	

			foreach ($results['domains'] as $d)
			{
				$allDomains[]=$d;
			}
			
			$finishedPages[]=$allResultPages[0];
			
			$allResultPages = $results['resultPages'];
			$newPages=array();
			foreach($allResultPages as $k=>$v)
			{
				if (!in_array($v, $finishedPages))
				{
					$newPages[]=$v;
				}
			}
			$allResultPages = $newPages;
			//$allResultPages = array_unique($allResultPages);
						
			//echo "Finished parsing $url<br />";
		}	
	} while (!empty($allResultPages) && $c < $maxPages);
	return array_unique($allDomains);
}

function doResultsPage($url)
{
	
	$url = preg_replace("/&amp;/", "&", $url);
	$body = disguise_curl($url);
	
	$subs = array();
	
	preg_match_all("/\/search\?q=ip%3A\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}&amp;first=\d{2,3}/", $body, $subs);
	//var_dump($subs);
	
	foreach ($subs[0] as $k => $v)
	{
		$subs[$k] = "http://www.bing.com" . $v;
	}
	
	$resultPages = array_unique($subs);
	
	$bodyparts = preg_split("/class=\"sb_meta\"><li><cite>/", $body);
	
	$bodyparts = array_reverse($bodyparts);
	array_pop($bodyparts);
	
	foreach ($bodyparts as $k => $v)
	{
		$bodyparts[$k] = substr($v, 0, stripos($v, "</cite>"));
		if (strpos($bodyparts[$k], "/") === false)
		{
			
		} else {
			$bodyparts[$k] = substr($bodyparts[$k], 0, strpos($bodyparts[$k], "/"));
		}
		$bodyparts[$k] = strtolower($bodyparts[$k]);
	}
	
	return Array("resultPages" => $resultPages, "domains" => $bodyparts);
}


	
	function disguise_curl($url)
{
  $curl = curl_init();

  // Setup headers - I used the same headers from Firefox version 2.0.0.6
  // below was split up because php.net said the line was too long. :/
  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: "; // browsers keep this blank.

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com');
  curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 10);

  $html = curl_exec($curl); // execute the curl command
  curl_close($curl); // close the connection

  return $html; // and finally, return $html
}
	

?>