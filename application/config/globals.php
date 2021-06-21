<?php

// Create customized config variables
if ( isset($_SESSION['user_profile'][0]['first_name'])){
$config['web_Address']= 'https://www.formget.com/blog';
$config['full_name']= $_SESSION['user_profile'][0]['first_name'].' '.$_SESSION['user_profile'][0]['last_name'];
}

?>