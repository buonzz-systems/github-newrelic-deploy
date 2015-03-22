<?php

/**
* Accept POST from Github Repository
* https://developer.github.com/v3/activity/events/types/#pushevent
* bumper 3
*/
 
require_once "config.php";
require_once "functions.php";

if(isset($_POST))
{
	log_github_postdata();

	$gh_data = parse_gh_data();

	if(array_key_exists( md5($gh_data['repo']) , $app_ids))
	{
		#detect the app id
		$app_id = $app_ids[md5($gh_data['repo'])];
		post_to_newrelic($app_id, $apikey);	
	}
	else
	{
		$gh_log_file = 'logs/github.log';
		$log = "\r". date("Y-m-d H:i:s - ") . 'app_id for '. $gh_data['repo'] . ' was not found in config.php';
		file_put_contents($gh_log_file, $log , FILE_APPEND | LOCK_EX);
	}
}
