<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller\V1;
use App\Model\Table\V2;
use Cake\Log\Log;
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
    
    public function getUserList() {
       $this->autoRender =  false;
       $request = $this->request->data;
       $condition =  [];
       foreach ($request as $key => $value)
           if($value == 'true')
              $condition[$key] = $value; 
       $this->conncetionCreator();
       $subscriberId = parent::readCookie('sub_id');
       $subscriberController = new SubscriptionController();
        $licensesController = new LicensesController();
       if(key_exists('all', $condition)){
            $subSystem = $subscriberController->getSubscriberSystem($subscriberId);
            $userList = $licensesController->getSubscribedUser($subSystem);
       } 
       
       if('sub'){
           $subSystem = $subscriberController->getSubscriberSystem($subscriberId);
           $userList = $licensesController->getSubscribedUser($subSystem);
       }
       
       if('sub'){
           $subSystem = $subscriberController->getSubscriberSystem($subscriberId);
           $userList = $licensesController->getSubscribedUser($subSystem);
       }
      
       Log::debug('get user list result from system');
       Log::debug($subSystem);
      
       
       Log::debug('get user list');
       Log::debug($userList);
       $this->response->body(json_encode($condition));
        
    }
}
