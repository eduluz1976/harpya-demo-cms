<?php
namespace cms\bo;

use \harpya\ufw\Utils;
class User {
    
    
    protected $hash;
    
    /**
     *
     * @var \cms\model\User
     */
    protected $model;
    
    
    public function getHash() {
        return $this->hash;
    }
    
    /**
     * 
     * @return \cms\model\User
     */
    public function getModel() {
        if (!$this->model) {
            $this->model = new \cms\model\User();
        }
        return $this->model;
    }
            
    
    public function createNewUser($email, $password) {
//        $user = new \cms\model\User();
//        $user->setPassword($password);
        $id = $this->getModel()->createNewUser($email,$password);
        $token = new \cms\model\Token();

        $this->hash = $token->createNewToken($id, $email);

    }
    
    
    public function requestEmailResetPassword($email) {

//
//        $model = new \cms\model\User();
//        $model->test1($email);

        
        $this->model = \cms\model\User::where('email','=',$email)->first();
        
//        $user = \cms\model\User::where('email','=',$email)->first();
        
//        dd([$email,$this->model]);
        
        $token = new \cms\model\Token();

        $this->hash = $token->createNewToken($this->model->id, $email,[
            'controller' => '\\cms\\controller\\Index',
            'method' => 'showFormResetPassword'
        ]);
        
    }
    
    
    public function login($email, $password) {
        $result = \cms\model\User::login($email,$password);
        
        if (Utils::get('success', $result)==true) {
            $user = Utils::get('user', $result);
            $userID = $user->id;
            
            
            $permissions = UserPermission::getPermissions($userID);
            
            $sessionToken = Utils::createToken(['id'=>$userID]);

            \harpya\ufw\Application::getInstance()->getSession()->set('logged', [
                'email'=>$email,
                'token'=>$sessionToken,
                'permissions' => $permissions
            ]);
        } else {
            throw new \Exception("Username or password invalid",1000);
        }        
    }
    
    
}