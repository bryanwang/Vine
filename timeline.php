<?php
$username = 'Your Vine email here';
$password = 'Your Vine password here';

$key = vineAuth($username,$password);
$userId = strtok($key,'-');

$records = vineTimeline($userId,$key);

foreach($records as $record)
	echo "$record->videoUrl\n";

function vineAuth($username,$password)
{
	$loginUrl =	"https://api.vineapp.com/users/authenticate";
	$username = urlencode($username);
	$password = urlencode($password);
	$token = sha1($username); // I believe this field is currently optional, but always sent via the app
	
	$postFields = "deviceToken=$token&password=$password&username=$username"; 

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $loginUrl);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	curl_setopt($ch, CURLOPT_USERAGENT, "iphone/110 (iPhone; iOS 7.0.4; Scale/2.00)");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$result = json_decode(curl_exec($ch));

	if (!$result)
	{
		curl_error($ch);
	}
	else
	{
		// Key aLso contains numeric userId as the portion of the string preceding the first dash
		return $result->data->key; 
	}

	curl_close($ch);
}

function vineTimeline($userId,$key)
{
	// Additional endpoints available from https://github.com/starlock/vino/wiki/API-Reference
	$url = 'https://api.vineapp.com/timelines/users/'.$userId;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "iphone/110 (iPhone; iOS 7.0.4; Scale/2.00)");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('vine-session-id: '.$key));
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$result = json_decode(curl_exec($ch));

	if (!$result)
	{
		echo curl_error($ch);
	}
	else
	{
		return $result->data->records;
	}

	curl_close($ch);
}