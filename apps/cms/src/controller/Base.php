<?php

namespace cms\controller;

use \harpya\ufw\Controller;

class Base extends Controller {
    
    public function showLandingPage() {
      $view = \harpya\ufw\Application::getInstance()
                    ->getView();
      
      $app = ['title'=>'MyCMS'];
      $page = [
          'title' => ''
      ];
              
      
      if (\cms\helper\Authenticated::isLogged()) {
          $page['show_signin'] = false;
          $page['show_signup'] = false;
          $page['show_signout'] = true;
      } else {
          $page['show_signin'] = true;
          $page['show_signup'] = true;
          $page['show_signout'] = false;          
      }

      
      $view->assign('app', $app);
      $view->assign('page', $page);
      
      
      
      $view->display('main.tpl');           
    }
    
    
    public function showPage($props=[]) {
        //dd($props);
        \harpya\ufw\Application::getInstance()
                    ->getView()
                    ->display('main.tpl');        
    }
    
    
    
}
