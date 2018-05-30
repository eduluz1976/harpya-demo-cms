<?php

namespace cms\helper;


class Authenticated {
    
    
    public static function isLogged() : bool {
        if (is_array($_SESSION) && array_key_exists('user', $_SESSION)) {
            return true;
        } else {
            return false;
        }
    }
    
    
}