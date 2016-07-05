<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;

use OneSignal\Notifications;
use OneSignal\Devices;
use OneSignal\Config;
use OneSignal\OneSignal;
use App\Controller;
use Cake\Log\Log;

/**
 * Description of AppNotificationController
 *
 * @author niteen
 */


class AppNotificationController extends Controller\ApiController {

    public $devices = [
        '82308b7d-6d9e-4c32-b903-9fa35cfe090f',
        'af64deb6-99b1-4db4-9c8c-1e198342ab64'
    ];
    public $api;

    public function initialize() {
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
        ];

        $result = $this->api->notifications->add($notificationData);
        if (is_array($result)) {
            Log::debug('One signal notidication add result array : ');
            Log::debug($result);
            $resultOpen = $this->api->notifications->open($result['id']);
            if (is_array($resultOpen)) {
                Log::debug('One signal notofication open result array: ');
                Log::debug($resultOpen);
                return $resultOpen['success'];
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
    
    public function appNotification() {
        $request = $this->request->data;
       
        if(isset($request['send'])){
            $counter = 0;
            $i = 0;
            $device = [];
            $message = [];
            $contents = [];
            for ($i; $i < count($request); $i++)
            foreach ($request as $key => $value){
                
                if($key === 'client-'.$i){
                   $device[$counter++] = $value; 
                }
                
            }
            Log::debug($device);
            if(!is_array($device) or empty($device)){
                $this->set([
                    'message' => 'Recipents list is empty.',
                    'color' => 'red'
                ]);
            }else{
               $message['title'] = $request['title'];
               $contents['en'] = $request['msg']; 
               if($this->sendNotification($device, $message, $contents))
               $this->set([
                    'message' => 'Notification was send.',
                    'color' => 'green'
                ]);
                else
                  $this->set([
                    'message' => 'Error in notification.',
                    'color' => 'red'
                ]);     
            }
            
        }
    }
    

}
