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
        //connect to database using subscriberId
        if (!$this->conncetionCreator($loginRequest->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        //validate user using username, password, and validate license 
        //availability and expiry date
        // return bool true if all condition true else return error object
        $result = $this->userValidation($loginRequest);
        if (is_bool($result)) {
            $info = $this->getTableObj()->getUserDetails($loginRequest->username);
            $info->subscriberId = $loginRequest->subscriberId;
            $userSubscriptionController = new UserSubscriptionController();
            $notificationInsertResult = $userSubscriptionController->addNotificationDetails(
                    new DTO\UserGcmIdDto($info->userId, $loginRequest->gcmId, $loginRequest->apnId, $loginRequest->subsciberId));
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(3), json_encode($info));
        } else
            $response = $result;
        $this->response->body(json_encode($response));
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
       $userList = [];
       $counter = 0;
        $status = TRUE;
       foreach ($request as $key => $value)
           if($value == 'true')
              $condition[$key] = $value; 
       $this->conncetionCreator();
       $subscriberId = parent::readCookie('sub_id');
       $subscriberController = new SubscriptionController();
       $userSubscriptionController = new UserSubscriptionController();
        $licensesController = new LicensesController();
       if(key_exists('all', $condition) or (key_exists('sub', $condition) and key_exists('non_sub', $condition) and key_exists('indirect', $condition))){
            $allSubSystem = $subscriberController->getSubscriberSystem($subscriberId);
            $allUserList = $licensesController->getSubscribedUser($allSubSystem);
            $expiredUserList = $licensesController->getSubscribedUser($allSubSystem, true);
            $nonUserList = $userSubscriptionController->getNonsubscribedUser();
            foreach ($allUserList as $user){
                $userList[$counter++] = $user; 
            }
            
            foreach ($nonUserList as $user){
                $userList[$counter++] = $user; 
            }
            
            foreach ($expiredUserList as $user){
                $userList[$counter++] = $user; 
            } 
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
           $inditectUserList = $licensesController->getSubscribedUser($inditectSubSystem);
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
}
