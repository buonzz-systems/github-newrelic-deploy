<?php

/**
* Accept POST from Github Repository
* https://developer.github.com/v3/activity/events/types/#pushevent
* bumper 1
*/
 
require_once "config.php";
require_once "functions.php";

if(isset($_POST))
{
	log_github_postdata();

	#detect the app id
	$gh_data = parse_gh_data();
	$app_id = $app_ids[$gh_data['repo']];

	post_to_newrelic($app_id, $apikey);
}
