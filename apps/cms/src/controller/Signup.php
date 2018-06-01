<?php

namespace cms\controller;

class Signup extends Base {

    public function showFormSignup() {
        
        $contents = \harpya\ufw\Application::getInstance()
                    ->getView()->fetch('forms/signup.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();
    }
    
    
    public function performSignup() {
        
        $email = $this->getParm('email');
        $user = new \cms\model\User();
        $user->setPassword($this->getParm('password'));
        $id = $user->createNewUser($email,$this->getParm('password'));
        
        $token = new \cms\model\Token();
        
        $hash = $token->createNewToken($id, $email);
        echo "\n hash = $hash \n";
        // send email...
        
        dd($this->getParms());
        
    }
    
    
    
    public function verifyNewUser() {
        
        $token = $this->getParm('token');
        
        if (!$token) {
            return "<h1>Invalid token ($token)</h1>";
        } else {

            $user = \cms\model\User::find($token['user_id']);
            
            if (!$user) {
                return "<h1>User not found </h1>";
            }
            
            $user->status = 2;
            $user->update();
            
            \harpya\ufw\Application::getInstance()
                        ->getView()->assign('email', $user->email);

            $contents = \harpya\ufw\Application::getInstance()
                        ->getView()->fetch('pages/user_verified.tpl');

            return $contents;
        }
             
    }
        
}
