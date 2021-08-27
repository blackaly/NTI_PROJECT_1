<?php 

    session_start(); 

    function clearUserInput($user_value){
        return trim(stripslashes(htmlspecialchars($user_value))); 
    }

    function userValidation($user_value, $flag){

        $valid_status = true; 
        switch ($flag) {
            case 'e':
                if(empty($user_value)){
                    $valid_status = false;  
                }
                break;

            case 'n': 
                if(!filter_var($user_value,FILTER_VALIDATE_INT)){
                    $valid_status = false;
                }
                break;    


            case 'm': 
                    if(!filter_var($user_value,FILTER_VALIDATE_EMAIL)){
                        $valid_status = false;
                    }
                    break;    

            case 'p': 
                    if(strlen($user_value) < 6){
                            $valid_status = false;
                       }
                        break;   

            case 't': 
                $allowed_extention = array('png','jpg','jpeg','pdf'); 
                if(!in_array($input,$allowed_extention)){
                    $valid_status = false;
                }
                break;
                
            
        }

        return $valid_status;

    }



    function Sanitize($input,$flag){

      
        switch ($flag) {
            case 's':
                return  filter_var($input,FILTER_SANITIZE_NUMBER_INT);
                break;
        
            case 'e': 
                return filter_var($input, FILTER_SANITIZE_EMAIL);    
        }



    }





?>