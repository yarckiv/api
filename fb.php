<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Аутентифікація через Facebook</title>
</head>
<body>

<?php
//fb
include_once 'functions.php';
$client_id = '1223734504390648'; // Client ID
$client_secret = '6cf410ca1a57c742130c4932ee5300d6'; // Client secret
$redirect_uri = 'http://localhost/api/fb.php'; // Redirect URIs

$url = 'https://www.facebook.com/dialog/oauth';

$params = array(
    'client_id'     => $client_id,
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code',
    'scope'         => 'public_profile,email,user_birthday,user_friends, user_likes'
);

echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентифікація через Facebook</a></p>';

if (isset($_GET['code'])) {
        $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'client_secret' => $client_secret,
        'code'          => $_GET['code']
    );
 
    $url_token = 'https://graph.facebook.com/v2.8/oauth/access_token?';

    $url = $url_token.urldecode(http_build_query($params));
    $tokenInfo = curl_get($url);
   
        
    $token = json_decode($tokenInfo);
    

   if (count($tokenInfo) > 0 && isset($token->access_token)) {
        $params = array('access_token' => $token->access_token);
        $url = 'https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params));
        
        $info = curl_get($url);
        $userInfo = json_decode($info);
        

        if ($userInfo) {
        
        echo "Wellcome " . $userInfo->name. "  you ID is:  ".$userInfo->id. '<br />';
        $userID = $userInfo->id;
        
    }
        
        $a = curl_get('https://graph.facebook.com/v2.8/me/friends?'.urldecode(http_build_query($params))); //find friends
//        $a = curl_get('https://graph.facebook.com/v2.8/me/likes'.'?'.urldecode(http_build_query($params))); //find likes
        
       
        
        $i = json_decode($a);
        if (isset($i->error)) {
        echo $i->error->message;
   } 
   else {
        echo "It's wish friends:  ". $i->summary->total_count;
        
   }
}}
?>
    
    
</body>
</html>