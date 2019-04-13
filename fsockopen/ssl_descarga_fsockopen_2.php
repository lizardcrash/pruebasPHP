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
$getstring = $path . "?" . $poststring;


$fp = fsockopen("ssl://".$host, $port, $errno, $errstr, $timeout = 5);
if(!$fp){
	echo "$errstr ($errno)\n";
}else{
  echo "GET https://$host$getstring HTTP/1.1\r\n";
  echo "Host: $host\r\n";
  echo "Content-type: application/x-www-form-urlencoded\r\n";
  echo "Connection: close\r\n\r\n";
  echo "\r\n";

  fputs($fp, "GET https://$host$getstring HTTP/1.1\r\n");
  fputs($fp, "Host: $host\r\n");
  fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
  fputs($fp, "Connection: close\r\n\r\n");
  fputs($fp, "\r\n");

  //loop through the response from the server
  while(!feof($fp)) {
    echo fgets($fp, 4096);
  }
  //close fp - we are done with it
  fclose($fp);
} 



?>
