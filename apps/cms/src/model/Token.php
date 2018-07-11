<?php

namespace cms\model;

use Illuminate\Database\Eloquent\Model as Eloquent;
use \harpya\ufw\Utils;

class Token extends Eloquent
{
    
    public function createNewToken($id,$email, $props=[]) {
        $nounce = $email.$id.time(); 
        $this->hash = hash('sha256', $nounce);
        
        $this->user_id = $id;
        
        $this->controller = Utils::get('controller', $props, '\cms\controller\Signup');
        $this->method = Utils::get('method', $props, 'verifyNewUser');
        //$this->parms = '[]';
        $this->save();
        return $this->hash;
    }
    
    
}