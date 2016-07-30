<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO;
use App\Model\Mtrait;
use Cake\Log\Log;
use App\Request\V1;

/**
 * Description of UserNotificationTable
 *
 * @author niteen
 */
class UserSubscriptionTable extends Table {

    public function connect() {
        return TableRegistry::get('user_subscription');
    }

    public function insertEntry($request) {
        $conditions = ['UserId' => $request->userId];
        if(is_null($request->subscriberId))
            $request->subscriberId = 0;
        $rows = $this->connect()->find()->where($conditions);
        $tableObj = $this->connect();
        if ($rows->count()) {
            $update = $tableObj->get($request->userId);
            $update->GcmId = $request->gcmId;
            $update->ApnId = $request->apnId;
            $update->SubscriberId = $request->subscriberId;
            if ($tableObj->save($update))
                return TRUE;
            return FALSE;
        }else {
            $newEntity = $tableObj->newEntity();
            $newEntity->UserId = $request->userId;
            $newEntity->GcmId = $request->gcmId;
            $newEntity->ApnId = $request->apnId;
            $newEntity->SubscriberId = $request->subscriberId;
            if ($tableObj->save($newEntity))
                return TRUE;
            return FALSE;
        }
    }
    
    public function getNonSubscriber() {
        $conditions = [
            'SubscriberId =' => 0
        ];
        $users = [];
        $count = 0;
        $rows = $this->connect()->find()->where($conditions);
        Log::debug('Non Subscriber query');
        Log::debug($rows->sql());
        if($rows->count()){
            foreach ($rows as $row)
            $users[$count++] = new DTO\UserGcmIdDto($row->UserId, $row->GcmId, $row->ApnId);
        }
        return $users; 
    }

}
