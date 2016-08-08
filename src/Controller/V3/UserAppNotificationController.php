<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
use Cake\Log\Log;
use App\DTO;
/**
 * Description of UserAppNotificationController
 *
 * @author niteen
 */
class UserAppNotificationController extends V2\UserAppNotificationController{
    
    public function getTableObj() {
        return new V3\UserAppNotificationTable();
    }
    
    public function addUserNotification($users, $noteId) {
        Log::debug('notification entry saving userwise for.');
        Log::debug($users);
       if(count($users)){
        foreach ($users as $key => $value)
            $result = $this->getTableObj ()->insert (new DTO\UserAppNotificationInsertDto($value, $noteId));
        return $result;
    }
    else
        return FALSE;
    }
}
