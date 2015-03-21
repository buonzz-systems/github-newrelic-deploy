<?php


function log_github_postdata(){
	$gh_log_file = 'logs/github.log';
	
	if(isset($_POST))
	{
		$gh_data = parse_gh_data($_POST);

		file_put_contents($gh_log_file, $data['repo_url'], FILE_APPEND | LOCK_EX);

	}
}

function parse_gh_data($data){
	$raw_data = json_decode($data);
	$new_data['repo_url'] = $raw_data['repository']['url'];
	return $new_data;
}