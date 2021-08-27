<?php 
   
   session_start();


   function CleanInputs($input)
   {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    
    return $input;
    }
    
   

    function validate($input,$flag){

        $status = true;

        switch ($flag) {
            case 1:
                if(empty($input)){
                    $status = false;  
                }
                break;

            case 2: 
                if(!filter_var($input,FILTER_VALIDATE_INT)){
                    $status = false;
                }
                break;    


            case 3: 
                    if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                        $status = false;
                    }
                    break;    

            case 4: 
                    if(strlen($input) < 6){
                            $status = false;
                       }
                        break;   

            case 5: 
                $allowedExt = array('png','jpg','jpeg','pdf'); 
                if(!in_array($input,$allowedExt)){
                    $status = false;
                }
                break;
                
            
        }

        return $status;

    }




    # Sanitization 

    function Sanitize($input,$flag){

      
        switch ($flag) {
            case 1:
                # code...
                return  filter_var($input,FILTER_SANITIZE_NUMBER_INT);
                
                break;
          
        }


    }



    # URL ... 
    function url($input){

        return "http://".$_SERVER['HTTP_HOST'].'/LUG2/Blog/Admins/'.$input;

    }

?>