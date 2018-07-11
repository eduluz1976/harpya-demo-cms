<?php
namespace cms\controller;

class Index extends Base {
    
    public function welcome() {
        
        if (\cms\helper\Authenticated::isLogged()) {
            $this->showDashboard();
            exit;
        } 
        
        
        $slugfy = \Cocur\Slugify\Slugify::create();
        $slug = $slugfy->slugify($_SERVER['REQUEST_URI']);
        
        if (empty($slug)) {
            $slug = "/";
        }
        
        $page = \cms\model\Page::where('slug','=',$slug)->first();

        
        $view = \harpya\ufw\Application::getInstance()
                    ->getView();
        
        //
        if (\cms\helper\Authenticated::isLogged()) {
            $view->assign('isLogged', "Is logged");
        } else {
            $view->assign('isLogged', "Is not logged");
        }
        
        
        if (!empty($page)) {
            
            $html = $view->fetch('string:'.$page->contents);
            
//            $this->setContents($page->contents);
            $this->setContents($html);
        }
        
        $this->showLandingPage();
    }
    
    
    protected function showDashboard() {
         $view = \harpya\ufw\Application::getInstance()
                    ->getView();
         
         $view->display('dashboard/index.tpl');
         exit;
    }
    
    
    
    public function showFormSignin() {
        
        $contents = $this->getView()->fetch('forms/signin.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();
        
    }
    
    
    /**
     * Show the form where an user can inform his email, to send a message with 
     * a link to reset his password
     */
    public function showFormSendLinkResetPassword() {

        $contents = $this->getView()->fetch('forms/inform_email_to_recover_password.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();        
    }
    
    /**
     * receive the user's email and send a message with link to reset password
     */
    public function sendLinkResetPassword() {

        $email = $this->getParm('email');

        // generate token

        // send email
        
        $user = new \cms\bo\User();
        $user->requestEmailResetPassword($email);

        
        echo $user->getHash();
        
        $this->getView()->assign('email',$email);
        
        $contents = $this->getView()->fetch('pages/reset_link_sent.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();                
    }
    
    /**
     * executed by token, show the form to reset the password
     */
    public function showFormResetPassword() {

        $contents = $this->getView()->fetch('forms/reset_password.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();                
    }
    
    /**
     * receive the token and new password
     */
    public function performResetPassword() {

        $contents = $this->getView()->fetch('pages/password_reset.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();                        
    }
    
    
}