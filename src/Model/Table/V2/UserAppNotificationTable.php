<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO;
/**
 * Description of UserAppNotificationTable
 *
 * @author niteen
 */
class UserAppNotificationTable extends Table{
    
    public function connect() {
        return TableRegistry::get('user_app_notification');
    }
    
    public function insert(DTO\UserAppNotificationInsertDto $request) {
        
        $tableObj = $this->connect();
        $newEntry = $tableObj->newEntity();
        $newEntry->UserId = $request->userId;
        $newEntry->NoteId = $request->notificationId;
        $newEntry->SendDate = date(DATE_TIME_FORMAT);
        
        if($tableObj->save($newEntry))
            return TRUE;
        return false;
    }
}
