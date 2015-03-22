<?php


# specificy api key in here, read https://docs.newrelic.com/docs/apm/apis/requirements/api-key
# on how to get an api key
$apikey = "{INSERT YOUR API KEY HERE}";
 
#Specify an existing New Relic app ID to Github Repos Mapping in here
$app_ids[] = array( 'https://github.com/vendor/repo' 
						=> "{INSERT YOUR APPLICATION ID HERE}");
 
$dep_description = "This is your app id deployment";