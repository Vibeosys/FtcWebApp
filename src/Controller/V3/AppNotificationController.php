<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;

use OneSignal\Notifications;
use OneSignal\Devices;
use OneSignal\Config;
use OneSignal\OneSignal;
use OneSignal\Exception\OneSignalException;
use App\Controller\V2;
use Cake\Log\Log;
use App\Model\Table\V3;
use App\DTO;

/**
 * Description of AppNotificationController
 *
 * @author niteen
 */


class AppNotificationController extends V2\AppNotificationController {

    public $devices = [
        '82308b7d-6d9e-4c32-b903-9fa35cfe090f',
        'af64deb6-99b1-4db4-9c8c-1e198342ab64'
    ];
    public $api;
    
    public function getTableObj() {
        return new V3\AppNotificationTable();
    }
    public function initialize() {
        parent::initialize();
        $config = new Config();
        $config->setApplicationId(ONESIGANL_APP_ID);
        $config->setApplicationAuthKey(ONESIGANL_APP_AUTH_KEY);
       // $config->setUserAuthKey('82308b7d-6d9e-4c32-b903-9fa35cfe090f');
        $this->api = new OneSignal($config);
    }

    public function sendNotification(array $device, array $message, array  $contents) {
        $notificationData = [
            'include_player_ids' => $device,
            'contents' => $contents,
           'data' => $message,
            'isAndroid' => true,
            'isIos' => true
        ];

       
         try{
                $result = $this->api->notifications->add($notificationData);
                Log::debug($result); 
            }  catch (OneSignalException $e){
              
                return $e->getErrors();
            }
        if (is_array($result)) {
            Log::debug('One signal notification add result array : ');
            
            try{
            $resultOpen = $this->api->notifications->open($result['id']);
            }  catch (OneSignalException $e){
                
                 return $e->getErrors();
            }
            if (is_array($resultOpen)) {
                Log::debug('One signal notofication open result array: ');
                Log::debug($resultOpen);
                return $resultOpen;
            }
        }
        return FALSE;
    }
    
    
    public function createNotification() {
          $this->autoRender = FALSE;
          //$message['message'] = 'DEMO 4 message.';
          $message['title'] = 'DEMO5';
          $contents['en'] = 'Demo 5 notification'; 
          if($this->sendNotification($this->devices, $message, $contents))
              echo 'notification was send.';
          else
              echo 'Error in notification.';
    }
    /*
     * new Entry of notification in database
     * 
     */
    public function addNewEntry($notification) {
        $result = $this->getTableObj()->insert($notification);
        return $result;
    }
    public function appNotification() {
       $request = $this->request->data;
       $sendBy = parent::readCookie('cur_ad_id');
       $subscriberId = parent::readCookie('sub_id');
       $this->conncetionCreator($this->getDatabasesubscription($subscriberId));
       if(isset($request['send']) and $this->request->is('post')){
            $counter = 0;
            $u_count = 0;
            $i = 0;
            $device = [];
            $users = [];
            $message = [];
            $contents = [];
            for ($i; $i < count($request); $i++)
            foreach ($request as $key => $value){
                
                if($key === 'client_a-'.$i or $key === 'client_i-'.$i){
                   $device[$counter++] = $value; 
                }
                if($key === 'userId-'.$i)
                        $users[$u_count++] = $value;
            }
            
        Log::debug('User list of notification recipients');
        Log::debug($users);
            if(!is_array($device) or empty($device)){
                $this->set([
                    'message' => 'Recipents list is empty.',
                    'color' => 'red',
                    'layout' => parent::readCookie('current_layout')
                ]);
            }else{
               $message['title'] = $request['title'];
               $contents['en'] = $request['msg'];
               $sendNoteResult = $this->sendNotification($device, $message, $contents);
               Log::debug('Error from send notification');
               Log::debug($sendNoteResult);
               if(isset($sendNoteResult['success'])){
                    Log::debug('notification was send.');
                  $noteId = $this->addNewEntry(new DTO\AppNotificationInsertDto(
                          $sendBy , 
                           $message['title'], $contents['en'], count($device)));
                  $userAppNotificationController = new UserAppNotificationController();
                  $in_result = $userAppNotificationController->addUserNotification($users, $noteId);
                   $this->set([
                    'message' => 'Notification was send.',
                    'color' => 'green',
                       'layout' => parent::readCookie('current_layout')
                ]);
               }else
                  $this->set([
                    'message' => 'Your not registered with app notification.',
                    'color' => 'red',
                      'layout' => parent::readCookie('current_layout')
                ]);
            }
        }
        Log::debug(parent::readCookie('current_layout'));
        $notes = $this->getTableObj()->getNote($sendBy);
        if(!empty($notes))
            $this->set (['notes' => $notes,'isAdmin' => parent::readCookie('isAdmin'), 'layout' => parent::readCookie('current_layout')]);
        else
            $this->set(['layout' => parent::readCookie('current_layout')]);  
    }
    
    public function getMyNotification() {
        $this->autoRender =  false;
        $request = $this->request->data;
        $baseRequest = \App\Request\V1\BaseRequest::Deserialize($request);
        $requestUser = \App\Request\V1\UserRequest::Deserialize($baseRequest->user);
        $this->conncetionCreator($this->getDatabasesubscription($requestUser->subscriberId));
        $validationResult = $this->userValidation($requestUser, FALSE);
        Log::debug($validationResult);
        if(!is_bool($validationResult)){
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(110));
        $this->response->body(json_encode($response));        
        return;
        
        }
        Log::debug('get notification device authenticated');
        $result = $this->getTableObj()->getUserNotification($requestUser->userId);
        if(empty($result))
           $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(112));
        else
        $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareSuccessMessage(13), json_encode($result));
        $this->response->body(json_encode($response));
    }
    

}
