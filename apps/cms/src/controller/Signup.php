<?php

namespace cms\controller;

use \cms\helper\Email;

class Signup extends Base {

    public function showFormSignup() {
        
        $contents = \harpya\ufw\Application::getInstance()
                    ->getView()->fetch('forms/signup.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();
    }
    
    
    public function performSignup() {
        
        
        try {
            $email = $this->getParm('email');
            
            $this->getView()->assign('email', $email);
            
            $user = new \cms\bo\User();
            $user->createNewUser($email, $this->getParm('password'));
            
            
            $hash = $user->getHash();
            $this->sendVerificationEmail($email, $hash);
            $contents = $this->getView()->fetch('pages/email_sent.tpl');

        } catch (\cms\exception\UserAlreadyExistsException $ex) {
            $this->performSignin();
            
        } catch (\Exception $ex) {            
            
            $this->getView()->assign('msg', $ex->getMessage());
            $contents = $this->getView()->fetch('forms/signup.tpl');
        }
        
        $this->setContents($contents);
        $this->showLandingPage();
        
    }
    
    protected function sendVerificationEmail($email,$hash) {

        $this->getView()->assign('HOST', getenv('HOST'));
        $this->getView()->assign('hash', $hash);
        $this->getView()->assign('email', $email);
        $htmlEmailContents = $this->getView()->fetch('email/verify_email.tpl');

        $props = [
            Email::EMAIL_FROM_ADDR => 'mail@systlets.com',
            Email::EMAIL_FROM_NAME => 'Verify your account <noreply@@systlets.com>',
            Email::EMAIL_TO_ADDR => $email,
            Email::TITLE => 'Verify your account',
            Email::MIME_TYPE => 'text/html',
            Email::CONTENT => $htmlEmailContents                    
        ];

        $r = Email::send($props);
        
        return $r;
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
            
            $this->getView()->assign('email', $user->email);

            $contents = $this->getView()->fetch('pages/user_verified.tpl');

            return $contents;
        }
             
    }
        
}
