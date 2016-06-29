<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller\V1;
use App\Model\Table\V2;
/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends V1\UserController{
    
    public function getTableObj() {
        return new V2\UserTable();
    }
    
   
    public function getAdminClients($subscriberId) {
        $result = $this->getTableObj()->getUser($subscriberId);
        return $result;
    }
    // Web methods
    public function adminWebLogin() {
        
    }
    
    public function userManagement() {
        
    }
}
