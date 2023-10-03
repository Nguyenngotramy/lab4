<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        if (isset($name) && is_string($name)){
            
        
        // 2. display the name with only the first letter capitalized
        $name = ucfirst($name);
        }

        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
          if (isset($email) && is_string($email)){  
        // 2. make sure the email address has at least one @ sign and one dot character
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $email = 'make sure the email address has at least one @ sign and one dot character';
        }
      }
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        if (isset($phone)){
          if (strlen($phone) < 7){
            $phone = 'at least seven digits, not including ';
          } else {
            function format_phone_number ( $mynum) {
        
              $phone = preg_replace('~.*(\d{3})[^\d]*(\d{3})[^\d]*(\d{4}).*~', 
                      '$1-$2-$3'." \n", $mynum);
              return $phone;
          
          }
        }
        }
       $phonen = format_phone_number ( $phone);
        /*************************************************
         * Display the validation message
         ************************************************/
        // $message = "This page is under construction.\n" .
        //            "Please write the code that processes the data.";
           $message = 
           "Name: $name\n" .
           "Email: $email\n" .
           "Phone:$phonen\n" .
           "\n" 
           ;
        break;
}
include 'string_tester.php';
?>