<?php


namespace App\Utils;


class MessagesInputs
{
    private static $message;

    public static function isValid($error)
    {
        if(!empty($error)){
            self::$message = $error;
            echo "is-valid";
        }
    }

    public static function isInvalid($error)
    {
        if(!empty($error)){
            self::$message = $error;
            echo "is-invalid";
        }
    }

    public static function renderMessage($type)
    {
       if(!empty($type) && $type == 'invalid'){
           echo "<div class='invalid-feedback'>".self::$message."</div>";
       } elseif(!empty($type) && $type == 'valid'){
           echo "<div class='invalid-feedback'>".self::$message."</div>";
       }
    }
}
