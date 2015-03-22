<?php

/**
* Accept POST from Github Repository
* https://developer.github.com/v3/activity/events/types/#pushevent
* bumper 4
*/
 
require_once "config.php";
require_once "functions.php";

if(isset($_POST))
{
	log_github_postdata();
	post_to_newrelic($app_id, $apikey);
}
