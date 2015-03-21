<?php


function log_github_postdata(){

	$gh_log_file = 'logs/github.log';
	
	if(isset($_POST))
	{
		$gh_data = parse_gh_data();
		$log = "\r". date("Y-m-d H:i:s - ") . $gh_data['repo'] . ' - ' . $gh_data['user'] . ' - ' . $gh_data['rev'];
		file_put_contents($gh_log_file, $log , FILE_APPEND | LOCK_EX);

	}
}

function parse_gh_data(){
	$raw_data = json_decode($_POST['payload']);
	$new_data['repo'] = $raw_data->repository->url;
	$new_data['user'] = $raw_data->pusher->name;
	$new_data['rev'] = $raw_data->after;
	return $new_data;
}

function post_to_newrelic($app_id, $apikey){

	$data = parse_gh_data();

	$dep_change = "This is a change log entry";
	$dep_user = "This is the user entry";
	$dep_rev = "This is a version number";

	#compose the data string for curl

	$dep_dat = "deployment[app_id]=".$app_id;
	$dep_dat = $dep_dat."&deployment[description]=".$data['repo'];
	$dep_dat = $dep_dat."&deployment[changelog]=".'changes pushed in github';
	$dep_dat = $dep_dat."&deployment[user]=".$data['user'];
	$dep_dat = $dep_dat."&deployment[revision]=".$data['rev'];

	#There should be no changes necessary beyond this point

	#deployment url at New Relic
	$url = "https://api.newrelic.com/deployments.xml";
	 
	#Create header info
	$header = array("x-api-key:".$apikey);
	
	$nr_log_file = 'logs/newrelic.log';

	$log = "\r". date("Y-m-d H:i:s - ") . $appid . ' - ' . $gh_data['user'] . ' - ' . $gh_data['rev'];
		file_put_contents($nr_log_file, $log , FILE_APPEND | LOCK_EX);
}