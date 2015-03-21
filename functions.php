<?php


function log_github_postdata(){
	$gh_log_file = 'logs/github.log';
	
	if(isset($_POST))
	{
		$data = serialize($_POST);
		file_put_contents($gh_log_file, $data, FILE_APPEND | LOCK_EX);

	}
}