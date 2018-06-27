<?php
namespace cms\exception;


class UserAlreadyExistsException extends \Exception {
    
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        if (!$code) {
            $code = \cms\Constants::USER_ALREADY_EXISTS;
        }
        parent::__construct($message, $code, $previous);
    }
    
    
}