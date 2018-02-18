<?php

class MY_Loader extends CI_Loader {
    public function gotoPage($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
        $content  = $this->view('templates/v_header', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('templates/v_footer', $vars, $return);

        return $content;
    else:
        $this->view('templates/v_header', $vars);
        $this->view($template_name, $vars);
        $this->view('templates/v_footer', $vars);
    endif;
    }
}

?>