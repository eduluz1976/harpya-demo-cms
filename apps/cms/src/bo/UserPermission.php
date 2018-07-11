<?php
namespace cms\bo;

use \harpya\ufw\Application;

class UserPermission {
    
    /**
     * 
     * @param integer $userID
     * @param array   $permissions
     */
    public static function addPermissions($userID, $permissions) {
        
        foreach ($permissions as $permission) {
            try {
                Application::getInstance()
                        ->getDB()
                        ->insert('user_permission', [
                            'user_id'=>$userID,
                            'permission'=>$permission
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }            
        }        
    }
    
    
    
    public static function getPermissions($userID,$filterStatus=1) {
        
        $sql = "SELECT permission FROM user_permission WHERE user_id=? ";
        
        if ($filterStatus !== false) {
            $sql .= " AND status=$filterStatus ";
        }
        
        $cur = Application::getInstance()
                        ->getDB()
                        ->select($sql,[$userID]);
        
        $response = [];
        
        foreach ($cur as $reg) {
            $response[] = $reg['permission'];
        }
        
        return $response;
    }
    
    
}