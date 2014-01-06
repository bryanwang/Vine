<?php
$key = $_GET['apiKey'];
$userId = strtok($key,'-');

$url = 'https://api.vineapp.com/timelines/users/'.$userId;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "iphone/110 (iPhone; iOS 7.0.4; Scale/2.00)");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('vine-session-id: '.$key));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);

if (!$result)
{
	echo curl_error($ch);
}
else
{
	echo $result;
}

curl_close($ch);