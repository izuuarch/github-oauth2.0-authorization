<?php
define('CLIENTID',"xxxxxx");
define('CLIENTSECRET',"xxxxxxx");
define('AUTHORIZEURL',"https://github.com/login/oauth/authorize");
define('TOKENURL',"https://github.com/login/oauth/access_token");
define('APIURL',"https://api.github.com/");
define('BASEURL',"http://localhost/githuboauth/callback.php");


function apiRequest($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   
    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
   
    $headers = [
      'Accept: application/vnd.github.v3+json, application/json',
      'User-Agent: https://example-app.com/'
    ];
   
    if(isset($_SESSION['access_token']))
      $headers[] = 'Authorization: Bearer '.$_SESSION['access_token'];
   
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   
    $response = curl_exec($ch);
    return json_decode($response, true);
  }