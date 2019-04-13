<?php
//https://market.osclass.org/oc-content/plugins/market/download.php?code=es_ES
$host = "market.osclass.org";
$port = 443;
$path = "/oc-content/plugins/market/download.php"; //or .dll, etc. for authnet, etc.

//you will need to setup an array of fields to post with
//then create the post string
$formdata = array ( "code" => "es_ES");
//build the post string
$poststring = "";
  foreach($formdata AS $key => $val){
    $poststring .= urlencode($key) . "=" . urlencode($val) . "&";
  }
// strip off trailing ampersand
$poststring = substr($poststring, 0, -1);

$fp = fsockopen("ssl://".$host, $port, $errno, $errstr, $timeout = 30);

if(!$fp){
	echo "$errstr ($errno)\n";
}else{

  $out = "";
  $out .= "POST $path HTTP/1.1\r\n";
  $out .= "Host: $host\r\n";
  $out .= "Content-type: application/x-www-form-urlencoded\r\n";
  $out .= "Content-length: ".strlen($poststring)."\r\n";
  $out .= "Connection: close\r\n\r\n";
  $out .= $poststring . "\r\n\r\n";

/*

$out = <<<EOF
POST /oc-content/plugins/market/download.php HTTP/1.1
Host: market.osclass.org
User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:60.0) Gecko/20100101 Firefox/60.0 Osclass (v.375)
Content-type: application/x-www-form-urlencoded
Content-length: 10
Connection: Close

code=es_ES


EOF;
*/

echo $out;

  fwrite($fp, $out);

  $contents = '';
  while (!feof($fp)) {
      $contents.= fgets($fp, 1024);
  }

  fclose($fp);
  echo $contents;  
} 


?>




