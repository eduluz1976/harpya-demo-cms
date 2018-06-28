<?php

namespace cms\model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    
    
    
    public function createNewUser($email, $password) {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->status = 1;
        
        try {
            $this->save();
        } catch (\Exception $ex) {
            if (strpos($ex->getMessage(), 'Duplicate entry') !== false) {
                throw new \cms\exception\UserAlreadyExistsException("User $email already exists",500);
            } else {
                throw $ex;
            }
        }
        
        
        return $this->id;
    }
    
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setPassword($pass) {
        $hash = hash('sha256', $pass);
        $this->hash = $hash;
    }
    
    public static function login($email, $password) {
        $response= ['success' => false];

        $user = \cms\model\User::where('email','=',$email)->first();
        
        $hash = hash('sha256', $password);
        
//        $response['user'] = $user;
//        $response['email'] = $email;
//        $response['user.password'] = $user->hash;
//        $response['hash'] = $hash;
        
        if (hash_equals($user->hash, $hash)) {
            $response['success'] = true;
        } else {
            throw new \cms\exception\InvalidUserPasswordException("Invalid username and/or password");
        }
        return $response;
    }
    
}