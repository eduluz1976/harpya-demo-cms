<?php
namespace cms\bo;

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
    
    
}