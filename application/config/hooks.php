<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = array(
    "class"    => "Check_session",// any name of class that you want
    "function" => "validate",// a method of class
    "filename" => "Check_session.php",// where the class declared
    "filepath" => "hooks"// this is location inside application folder
);
