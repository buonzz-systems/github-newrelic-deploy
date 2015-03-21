<?php


function log_github_postdata(){
	$gh_log_file = 'logs/github.log';
	
	if(isset($_POST))
	{
		$gh_data = parse_gh_data();
		$log = "\r". date("Y-m-d H:i:s - ") . serialize($gh_data);
		file_put_contents($gh_log_file, $log , FILE_APPEND | LOCK_EX);

	}
}

function parse_gh_data(){
	$raw_data = json_decode($_POST['payload']);
	$new_data = $raw_data;
	return $new_data;
}