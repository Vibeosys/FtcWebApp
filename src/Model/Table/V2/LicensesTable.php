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
    
    
    public function getsubscribedUser(SubscriberSystemDto $subSystem, $expired) {
        $conditions = '';
        if($expired){
            $conditions = 'licenses.date_expired < "'.date(DATE_TIME_FORMAT).'" and licenses.systemid = '.$subSystem->systemId.' group by US.UserId';
        }else 
             $conditions = 'licenses.date_expired > "'.date(DATE_TIME_FORMAT).'" and licenses.systemid = '.$subSystem->systemId.' group by US.UserId';
        $join = [
            'US' => [
                'table' => 'user_subscription',
                'type' => 'INNER',
                'conditions' => 'licenses.userid = US.UserId and '.$conditions
            ],
        ];
        
        $fields = [
            'UserId' => 'US.UserId',
            'GcmId' => 'US.GcmId',
            'ApnId' => 'US.ApnId'
        ];
        $users = [];
        $count = 0;
        $rows = $this->connect()->find('All', ['fields' => $fields])->join($join);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count()){
            foreach ($rows as $row)
            $users[$count++] = new UserGcmIdDto($row->UserId, $row->GcmId, $row->ApnId);
        }
        return $users;
    }
    
    public function getIndirectClients(SubscriberSystemDto $subSystem, $expired) {
        if($expired){
            $conditions = 'and licenses.date_expired < "'.date(DATE_TIME_FORMAT).'"';
        }else 
             $conditions = 'and licenses.date_expired > "'.date(DATE_TIME_FORMAT).'"';
        $join = [
            'US' => [
                'table' => 'user_subscription',
                'type' => 'INNER',
                'conditions' => 'licenses.userid = US.UserId '.$conditions
            ],
            'SA' =>[
                'table' => 'slaveaccounts',
                'type' => 'INNER',
                'conditions' => 'licenses.userid = SA.userid and SA.systemid ='.$subSystem->systemId.' group by US.UserId'
            ],
        ];
        
        $fields = [
            'UserId' => 'US.UserId',
            'GcmId' => 'US.GcmId',
            'ApnId' => 'US.ApnId'
        ];
        $users = [];
        $count = 0;
        $rows = $this->connect()->find('All', ['fields' => $fields])->join($join);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count()){
            foreach ($rows as $row)
            $users[$count++] = new UserGcmIdDto($row->UserId, $row->GcmId, $row->ApnId);
        }
        return $users;
    }

}


