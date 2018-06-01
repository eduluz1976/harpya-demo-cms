<?php

namespace cms\model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    
    public function createNewUser($email, $password) {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->status = 1;
        $this->save();
        return $this->id;
    }
    
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setPassword($pass) {
        $hash = hash('sha256', $pass);
        $this->hash = $hash;
    }
    
}