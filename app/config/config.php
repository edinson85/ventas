<?php

$val = dirname(dirname(__FILE__));
define('APP', dirname(dirname(__FILE__)));

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
else  
        $url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   
    
  
define('URL', $url);