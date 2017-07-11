<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Аутентифікація через VK</title>
</head>
    <body>

<?php
//VK
include_once 'functions.php';
session_start();
$client_id = '5756045';
$client_key = 'saHYgH3ZummJg377MKyB';
$redirect_uri = 'http://localhost/api/home.php';
$auth_uri = "https://oauth.vk.com/authorize?";
$scope = 'friends,groups,status,email';
$display = 'page';
$response_type = 'code';

echo $link ='<p><a href="'.$auth_uri.
'client_id='.$client_id.'&scope='.$scope.'&redirect_uri='.$redirect_uri.'&response_type='.$response_type.
        '&display='.$display.'">'
        .'Аутентифікація через VK</a></p>';

?>

</body>
</html>