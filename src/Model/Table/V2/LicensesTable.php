<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use App\Model\Table\V1;
use App\DTO\SubscriberSystemDto;
use App\DTO\UserGcmIdDto;

/**
 * Description of LicensesController
 *
 * @author niteen
 */
class LicensesTable extends V1\LicensesTable{
    
    
    public function getsubscribedUser(SubscriberSystemDto $subSystem) {
        
        $join = [
            'US' => [
                'table' => 'user_subscription',
                'type' => 'INNER',
                'conditions' => 'licenses.userid = US.UserId and licenses.date_expired > "'.
                date(DATE_TIME_FORMAT) .'" and licenses.systemid = '.$subSystem->systemId
            ],
        ];
        
        $fields = [
            'UserId' => 'US.UserId',
            'GcmId' => 'US.GcmId'
        ];
        $users = [];
        $count = 0;
        $rows = $this->connect()->find('All', ['fields' => $fields])->join($join);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count()){
            foreach ($rows as $row)
            $users[$count++] = new UserGcmIdDto($row->UserId, $row->GcmId);
        }
        return $users;
    }
}
