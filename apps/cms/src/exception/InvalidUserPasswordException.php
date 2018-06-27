<?php

namespace cms\exception;



class InvalidUserPasswordException extends \Exception {

    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        if (!$code) {
            $code = \cms\Constants::INCORRECT_EMAIL_PASSWORD;
        }
        parent::__construct($message, $code, $previous);
    }    
}