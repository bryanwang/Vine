<?php
$loginUrl =	"https://api.vineapp.com/users/authenticate";

$username = urlencode($_POST['username']);
$password = urlencode($_POST['password']);
$token = sha1($username);

$postFields = "deviceToken=$token&password=$password&username=$username"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_USERAGENT, "iphone/110 (iPhone; iOS 7.0.4; Scale/2.00)");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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