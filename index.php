<?php

/**
* Accept POST from Github Repository
* https://developer.github.com/v3/activity/events/types/#pushevent
* bumper 9
*/
 
require_once "config.php";
require_once "functions.php";

if(isset($_POST))
{
	log_github_postdata();
	post_to_newrelic($app_id, $apikey);
}

/*
#initialize curl 
$ch = curl_init();
 
curl_setopt ($ch, CURLOPT_VERBOSE, 1);
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_HTTPHEADER, $header );
curl_setopt ($ch, CURLOPT_POSTFIELDS, $dep_dat );
 
# Make the curl call for deployment
$http_result = curl_exec ($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
#close curl 
curl_close ($ch);
 
#output status 
vprintf ("Code  %s\n", $http_code);
vprintf ("Results %s\n", $http_result);
if ($error) {
   vprintf ("Error %s\n",$error);
}
*/