<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Model\Table\V2;
use Cake\Log\Log;
use App\DTO;
/**
 * Description of UserAppNotificationController
 *
 * @author niteen
 */
class UserAppNotificationController {
    
    public function getTableObj() {
        return new V2\UserAppNotificationTable();
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
