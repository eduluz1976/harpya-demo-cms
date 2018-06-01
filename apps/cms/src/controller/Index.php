<?php
namespace cms\controller;

class Index extends Base {
    
    public function welcome() {
        
        
        $slugfy = \Cocur\Slugify\Slugify::create();
        $slug = $slugfy->slugify($_SERVER['REQUEST_URI']);
        
        if (empty($slug)) {
            $slug = "/";
        }
        
        $page = \cms\model\Page::where('slug','=',$slug)->first();

        if (!empty($page)) {
            $this->setContents($page->contents);
        }
        
        $this->showLandingPage();
    }
    
    
    public function showFormSignin() {
        
        $contents = \harpya\ufw\Application::getInstance()
                    ->getView()->fetch('forms/signin.tpl');
        
        $this->setContents($contents);
        $this->showLandingPage();
        
    }
    
    
    public function performSignin() {
        dd($this->getParms());
    }
    
    
    
}