<?php

// Create customized config variables
if ( isset($_SESSION['user_profile'][0]['first_name'])){
    $config['web_Address']      = 'https://www.formget.com/blog';
    $config['full_name']        = $_SESSION['user_profile'][0]['first_name'].'-'.$_SESSION['user_profile'][0]['last_name'];
    $config['full_name_real']   = $_SESSION['user_profile'][0]['first_name_real'].'-'.$_SESSION['user_profile'][0]['last_name_real'];
    $config['role']             = $_SESSION['user_profile'][0]['role'];
    $config['team']             = $_SESSION['user_profile'][0]['team'];
    $config['department']       = $_SESSION['user_profile'][0]['department'];
}
?>