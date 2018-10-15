<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function controller_verification_code()
{
    $CI =& get_instance();

    // allow user to continue?
    if ( empty($_SESSION['verification']) || !$CI->input->post('code') ||
            ( !empty($_SESSION['verification']) && $CI->input->post('code') &&
                $_SESSION['verification']['hash'] != md5($CI->input->post('code')) )
        )
    {
        $output = json_encode(array('status' => 'PENDING', 'message' => 'VERIFY'));
        $CI->output
                    ->set_content_type('application/json')
                    ->set_output( json_encode($output) );

        return false;
    }
}