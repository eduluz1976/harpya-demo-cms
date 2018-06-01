<?php

namespace cms\controller;

use \harpya\ufw\Controller;

class Base extends Controller {
    
    protected function setContents($contents='') {
        \harpya\ufw\Application::getInstance()
                ->getView()->assign('contents', $contents);
        
    }
    
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
    
    public function runToken() {
        
        
        $token = \cms\model\Token::where('hash','=',$this->getParm('token'))->first();
        
        if (!$token) {
            $this->setContents("<h3>Token not found</h3>");            
        } else {        
            $target = [
                'type'=>'controller', 
                'target'=> [ 
                    'controller' => $token->controller, 
                    'method'=>$token->method, 
                    'app'=>'cms', 
                    ],
                'match' => [ 
                    'params'=> [
                        'token'=>$token 
                    ]
                  ]
               ];
            
            $result = \harpya\ufw\Application::getInstance()->getRouter()->evaluate($target);
            $this->setContents($result);
        }
        
        $this->showLandingPage();
        exit;        
        
    }
    
    
    
}
