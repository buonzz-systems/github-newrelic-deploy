<?php


function log_github_postdata(){
	$gh_log_file = 'logs/github.log';
	
	if(isset($_POST))
	{
		$gh_data = parse_gh_data($_POST);
		$log = date("\rY-m-d H:i:s -". serialize($gh_data['repo_url']));
		file_put_contents($gh_log_file, $log , FILE_APPEND | LOCK_EX);

	}
}

function parse_gh_data($data){
	$raw_data = json_decode($data);
	$new_data = $raw_data;
	return $new_data;
}