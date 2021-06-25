<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Check_session
{
        public function __construct()
        {
                
        }

        public function __get($property)
        {
                if ( ! property_exists(get_instance(), $property))
                {
                        show_error('property: <strong>' .$property . '</strong> not exist.');
                }
                return get_instance()->$property;
        }
        public function validate()
        {   
               if (in_array($this->router->method, array("login","login_user")))//login is a sample login controller
                {
                        return;
                }
                if ( ! $this->session->userdata('is_login'))
               {
                     //redirect in login
                    redirect('login', 'refresh');
               }
               

        }
}