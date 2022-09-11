<?php
session_start();
require "config.php";
?>
<?php
if(isset($_SESSION['access_token'])){
    ?>
    <a href="index.php?action=logout">log out</a>
    <?php
}else{
    ?>
    <a href="index.php?action=login">login to github</a>
    <?php
}
?>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'login'){
    unset($_SESSION['access_token']);

      // Generate a random hash and store in the session
  $_SESSION['state'] = bin2hex(random_bytes(16));

  $params = array(
    'response_type' => 'code',
    'client_id' => CLIENTID,
    'redirect_uri' => BASEURL,
    'scope' => 'reposinit',
    'state' => $_SESSION['state']
  );

    // Redirect the user to Github's authorization page
    header('Location: '.AUTHORIZEURL.'?'.http_build_query($params));
    die();
}
?>
<?php
if(isset($_SESSION['access_token'])){
    $token = $_SESSION['access_token'];
    ?>
    <?php echo $token; ?>
    <?php
}
?>