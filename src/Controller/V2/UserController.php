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
use App\DTO;
/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends V1\UserController{
    
    public function getTableObj() {
        return new V2\UserTable();
    }
    
     public function userLogin() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $loginRequest = \App\Request\V1\UserLoginRequest::Deserialize(
                $request->data);
        Log::debug("request data string: " . $request->data);
        Log::debug($loginRequest);
        $this->conncetionCreator();

        if (!$this->getTableObj()->validateCredential(
                $loginRequest->username, md5($loginRequest->pwd)))
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(103));
        else {
            $info = $this->getTableObj()->getUserDetails($loginRequest->username);
           
            $info->subscriberId = 0;
            $userSubscriptionController = new UserSubscriptionController();
            $notificationInsertResult = $userSubscriptionController->addNotificationDetails(
                    new DTO\UserGcmIdDto($info->userId, $loginRequest->gcmId, $loginRequest->apnId));
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(3), json_encode($info));
        }
        $this->response->body(json_encode($response));
    }
    
    public function userSubLogin() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        
        $loginRequest = \App\Request\V1\UserSubLoginRequest::Deserialize(
                $request->data);
        Log::debug("request data string: " . $request->data);
        Log::debug($loginRequest);
        //connect to database using subscriberId
        if (!$this->conncetionCreator($this->getDatabasesubscription($loginRequest->subscriberId)) 
                or !$this->getDatabaseSubscription($loginRequest->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        if($loginRequest->weblogin == 1){
            if($this->getTableObj()->isGroup($loginRequest->username, USER_GROUP)){
               $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(110));
            $this->response->body(json_encode($response));
            return;   
                
            }
        }
        //validate user using username, password, and validate license 
        //availability and expiry date
        // return bool true if all condition true else return error object
        $result = $this->userValidation($loginRequest);
        if (is_bool($result)) {
            $info = $this->getTableObj()->getUserDetails($loginRequest->username);
             parent::writeCookie('cur_name', $info->fullName);
            parent::writeCookie('cur_email', $info->email);
            $info->subscriberId = $this->getMySubscription($loginRequest->subscriberId);
            $userSubscriptionController = new UserSubscriptionController();
            $userController = new UserController();
            if($loginRequest->weblogin != 1 and $userController->getTableObj()->isGroup($loginRequest->username, USER_GROUP))
            $notificationInsertResult = $userSubscriptionController->addNotificationDetails(
                    new DTO\UserGcmIdDto($info->userId, $loginRequest->gcmId, $loginRequest->apnId, $this->getMySubscription($loginRequest->subscriberId)));
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(3), json_encode($info));
        } else
            $response = $result;
        $this->response->body(json_encode($response));
    }
    
   
    public function getAdminClients($subscriberId, $pageFor = null) {
        $result = $this->getTableObj()->getUser($subscriberId, $pageFor);
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
       $userList = [];
       $counter = 0;
        $status = TRUE;
       foreach ($request as $key => $value)
           if($value == 'true')
              $condition[$key] = $value; 
       $subscriberId = parent::readCookie('sub_id');    
       $isAdmin = parent::readCookie('isAdmin');    
       $this->conncetionCreator($this->getMySubscription($subscriberId));
       $subscriberController = new SubscriptionController();
       $userSubscriptionController = new UserSubscriptionController();
        $licensesController = new LicensesController();
        Log::debug($condition);
       if(key_exists('all', $condition) or (key_exists('sub', $condition) and key_exists('non_sub', $condition) and key_exists('indirect', $condition))){
            $allSubSystem = $subscriberController->getSubscriberSystem($subscriberId);
           
            
            /*$inditectUserList = $licensesController->getIndirectUser($allSubSystem, TRUE);
            foreach ($inditectUserList as $user){
                $userList[$counter++] = $user; 
            }*/
             $allUserList = $licensesController->getSubscribedUser($allSubSystem);
            foreach ($allUserList as $user){
                $userList[$counter++] = $user; 
            }
            $expiredUserList = $licensesController->getSubscribedUser($allSubSystem, true);
            foreach ($expiredUserList as $user){
                $userList[$counter++] = $user; 
            }
            if($isAdmin){
            $nonUserList = $userSubscriptionController->getNonsubscribedUser();
            foreach ($nonUserList as $user){
                $userList[$counter++] = $user; 
            }}
            
             Log::debug('All user condition true');
             $status = FALSE;
       } 
       
       if($status and key_exists('sub', $condition)){
           $subSubSystem = $subscriberController->getSubscriberSystem($subscriberId);
           $subUserList = $licensesController->getSubscribedUser($subSubSystem);
            foreach ($subUserList as $user){
                $userList[$counter++] = $user; 
            }
           Log::debug('Subscriber user condition true');
       }
       
       if($status and key_exists('non_sub', $condition)){
           $nonSubSystem = $subscriberController->getSubscriberSystem($subscriberId);
           
           $expiredUserList = $licensesController->getSubscribedUser($nonSubSystem, true);
           $nonUserList = $userSubscriptionController->getNonsubscribedUser();
            /*$inditectUserList = $licensesController->getIndirectUser($nonSubSystem, TRUE);
            
            foreach ($inditectUserList as $user){
                $userList[$counter++] = $user; 
            }*/
            foreach ($expiredUserList as $user){
                $userList[$counter++] = $user; 
            } 
           foreach ($nonUserList as $user){
                $userList[$counter++] = $user; 
            }
           Log::debug('Non Subscriber user condition true');
       }
       
       if($status and key_exists('indirect', $condition)){
           $inditectSubSystem = $subscriberController->getSubscriberSystem($subscriberId);
           $inditectUserList = $licensesController->getIndirectUser($inditectSubSystem);
            foreach ($inditectUserList as $user){
                $userList[$counter++] = $user; 
            }
           Log::debug('Indirect user condition true');
       }
       
       
       foreach ($userList as $user){
           $userDetails = $this->getTableObj()->getProfile($user->userId);
           $user->fullName = $userDetails->fullName;
           $user->email = $userDetails->email;
       }
       Log::debug('get user list result from system');
       //Log::debug($subSystem);
      
       
       Log::debug('get user list');
       Log::debug($userList);
       
       $this->response->body(json_encode($userList));
        
    }
    
    public function pageUnderConstruction() {
        
    }
    
    public function userGroupCheck($uname, $group) {
        $result = $this->getTableObj()->isGroup($uname, $group);
        return $result;
    }
    
    public function getOwnerClient() {
        $this->autoRender = FALSE;
        if($this->request->is('post')){
            $suscriberId = parent::readCookie('sub_id');
            $this->conncetionCreator($this->getDatabasesubscription($suscriberId));
            $users = $this->getTableObj()->getAdminUser();
            if(empty($users))
                $this->response->body (0);
            else
                $this->response->body (json_encode($users));
        }
    }
    
    public function getOwnerEmailSettings() {
        $result = $this->getTableObj()->getEmailSettings();
        return $result;
    }
}
