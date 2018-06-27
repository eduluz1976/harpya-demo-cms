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
    
    
    
}