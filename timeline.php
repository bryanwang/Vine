<?php
$key = $_GET['apiKey'];
$userId = strtok($key,'-');

$url = 'https://api.vineapp.com/timelines/users/'.$userId;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "com.vine.iphone/1.0.3 (unknown, iPhone OS 6.1.0, iPhone, Scale/2.000000)");
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