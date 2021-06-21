<?php

/**
 * /application/core/MY_Loader.php
 *
 */
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return==1):
        $this->view('include/header', $vars, $return);
        $this->view($template_name, $vars, $return);
        $this->view('include/footer', $vars, $return);

        
    else:
        
        $this->view('include/header', $vars);
        $this->view('include/menu', $vars);
        $this->view($template_name, $vars);
        $this->view('include/footer', $vars);
    endif;
    }
}