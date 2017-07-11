<?php
include_once 'functions.php';
session_start();
$client_id = '5756045';
$client_key = 'saHYgH3ZummJg377MKyB';
$redirect_uri = 'http://localhost/api/home.php';
$auth_uri = "https://oauth.vk.com/authorize?";
$scope = 'friends,groups,status,email';
$display = 'page';
$response_type = 'code';
if (!isset($_GET['code'])){
    echo 'EROOR';
}

$params = array (
   'client_id' => $client_id,
   '&client_secret' => $client_key,
   '&code=' => $_GET['code'],
   '&redirect_uri=' => $redirect_uri
   );

$url_token = "https://oauth.vk.com/access_token?client_id=".$client_id.'&client_secret='.$client_key.'&code='.$_GET['code'].'&redirect_uri='.$redirect_uri; 

$userInfo = json_decode(curl_get($url_token));

if ($userInfo){
$params = array('access_token' => $userInfo->access_token);
$token= $userInfo->access_token;
$userID= $userInfo->user_id;}


//groups
$groups = json_decode(curl_get('https://api.vk.com/method/groups.get?uid='.$userID.'&'.urldecode(http_build_query($params))));
echo 'groups - '.count($groups->response);


//$request_params = array(
//'user_id' => $userID,
//'fields' => 'first_name',
//'v' => '5.52'
//);
//$get_params = http_build_query($request_params);
//$result = json_decode(file_get_contents('https://api.vk.com/method/friends.get?'. $get_params));
//var_dump($result->response->items);


//friends
//$friends = json_decode(curl_get('https://api.vk.com/method/friends.get?fields=first_name, last_name, nickname&uid='.$userID.'&'.urldecode(http_build_query($params))));
//var_dump($friends);
?>


