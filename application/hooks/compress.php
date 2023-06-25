<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function compress()
{
    ini_set("pcre.recursion_limit", "16777");
    $CI =& get_instance();
    $s1= $CI->uri->segment(1);
    $s2= $CI->uri->segment(2);
    $buffer = $CI->output->get_output();

    if ($s1=='admin'){
        $CI->output->set_output($buffer);
    }else{
        // $buffer = preg_replace('~<!-(?!<!)[^\[].*?-~s','',$buffer);
        if ($s1=='blog'&&!empty ($s2)){
            '';
            $script = '|script';
        }else{
            // $buffer_ = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/','',$buffer);
            // $buffer = preg_replace('/<img\s+[^>]*\bsrc="[^"]*\/signature\.gif[^\>]*\>/', '', $buffer);
            $script = '';
        }
        $re = '%([^\S ]\s*|\s{2,})(?=[^<]*+(?:<(?! /?(?:textarea|pre|ins|blockquote'.$script.')\b)[^<]*+)*+(?:<(
        textarea|pre|ins|blockquote'.$script.')\b|\z))%Six';
        $new_buffer = preg_replace($re, " ", $buffer);

        if ($new_buffer === null)
        {
        $new_buffer = $buffer;
        }

        $CI->output->set_output($new_buffer);
    }

    $CI->output->_display();
}