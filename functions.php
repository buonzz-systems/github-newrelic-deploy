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

	$gh_data = parse_gh_data();

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

	$log = "\r". date("Y-m-d H:i:s - ") . $app_id . ' - ' . $gh_data['user'] . ' - ' . $gh_data['rev'];
		file_put_contents($nr_log_file, $log , FILE_APPEND | LOCK_EX);


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
	file_put_contents($nr_log_file, $http_code . ' - '. $http_result , FILE_APPEND | LOCK_EX);

	if ($error) {
	   vprintf ("Error %s\n",$error);
		file_put_contents($nr_log_file, $error , FILE_APPEND | LOCK_EX);
	}
}