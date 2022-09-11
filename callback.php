<?php
session_start();
require "config.php";
?>
<?php
if(isset($_GET['code'])) {
  // Verify the state matches our stored state
  if(!isset($_GET['state']) || $_SESSION['state'] != $_GET['state']) {

    header('Location: ' . $baseURL . '?error=invalid_state');
    die();
  }

    // Exchange the auth code for an access token
   $token = apiRequest(TOKENURL, array(
        'grant_type' => 'authorization_code',
        'client_id' => CLIENTID,
        'client_secret' => CLIENTSECRET,
        'redirect_uri' => BASEURL,
        'code' => $_GET['code']
      ));
      $_SESSION['access_token'] = $token['access_token'];
    
      header('Location: index.php');
      die();
}