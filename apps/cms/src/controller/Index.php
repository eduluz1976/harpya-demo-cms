<?php
namespace cms\controller;

class Index extends Base {
    
    public function welcome() {
        $this->showLandingPage();
        
        
//        if (!\cms\helper\Authenticated::isLogged()) {
//            $this->showLandingPage();
//        } else {
//            $this->showPage(['slug'=>'welcome']);
//        }
        
    }
    
    
    public function showFormSignup() {
        
        $contents = \harpya\ufw\Application::getInstance()
                    ->getView()->fetch('forms/signup.tpl');
        
        
        \harpya\ufw\Application::getInstance()
                    ->getView()->assign('contents', $contents, true);
         $this->showLandingPage();
    }
    
    
}