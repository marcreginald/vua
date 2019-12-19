<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# KILL PAGE AFTER RETURNING SOME DATA
if ( ! function_exists('die_r')){
    
    function die_r($Q)
    {
        var_dump($Q);
        echo "<hr> <br>";
        
        if ((is_array($Q)) || (is_object($Q))) {
			echo "<pre>";
			print_r($Q);
			echo "</pre>";
		}
		else{
            echo $Q;
		}
    }
} 


# RETURNING EITHER BOOLEAN OR JSON DATA 
if( ! function_exists ('return_json')){
    
    
    function return_json($data, $boolRetFlag){
        
        // getting the CI superobject 
        $CI =& get_instance();
        $CI->output->set_content_type('application/json');
        
        if ($boolRetFlag) {
			print json_encode(['status' => $data]);
		}
		else{
			print json_encode($data);
		}
    }
}


# CHECKING IF THE SESSION EXIST IN CURRENT USER ALSO A COOKIE
if( ! function_exists ('check_session')){

    function check_session(){
        if (isset($_SESSION['userdata']) && count($_COOKIE) > 0) {
			return TRUE;
		}
		else{
			return FALSE;
		}
    }
}


# ONE BIG FAT SANITIZER FUNCTION :)
if( ! function_exists('sanitize_data')){
    
    function sanitize_data($data){
        return stripslashes(trim(strip_tags(htmlspecialchars($data))));
    }
    
}

# RE ARRAYING THE MULTIPLE FILE  BASURA!!!
/*if( ! function_exists('reArrayFiles')){
    
    function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }
}*/










/*
    REMINDERS!!
     1. USE THE delete_cookie, get_cookie ON THE Cookie Helper but setting cookie use the native PHP setcookie
     2. DISPLOYING IN THE LINUX ENVIRONMENT MUST CHANGE THE FOLLOWING SETTING IN THE APACHE2 CONF. AND RUN SOME COMMAND ALSO THE HELPER METHOD, MUST CHANGE TO LOWER CASE LETTER FIRST LETTER
*/