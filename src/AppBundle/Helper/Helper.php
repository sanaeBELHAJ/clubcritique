<?php

namespace AppBundle\Helper;

/**
 * Description of Helper
 *
 * @author Sanae BELHAJ
 */
class Helper {
    //put your code here
    
    public function sendConfirmation($to){
     $subject = 'Confirmation d\'inscription sur le club des critiques';
     $message = 'Bonjour !';
     $headers = 'From: noreply@support.com' . "\r\n" ;

     mail($to, $subject, $message, $headers);
    }
    public static function createPassword($nbCaractere)
    {
        $password = "";
        for($i = 0; $i <= $nbCaractere; $i++)
        {
            $random = rand(97,122);
            $password .= chr($random);
        }
 
        return $password;
    }
}