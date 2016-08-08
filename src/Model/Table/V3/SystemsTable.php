<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO;

/**
 * Description of SystemsTable
 *
 * @author niteen
 */
class SystemsTable extends V2\SystemsTable{
    
    public function connect() {
        return TableRegistry::get('systems');
    }
    
    public function getSettings($userId) {
       
        $joins = [
            'ES' => [
                'table' => 'email_settings',
                'type' => 'INNER',
                'conditions' => 'systems.ownerid = ES.userid'
            ],
            'L' => [
                'table' => 'licenses',
                'type' => 'INNER',
                'conditions' => 'systems.systemid = L.systemid and L.userid ='.$userId 
            ]
        ];
       
        $fields = [
            'UserId' => 'systems.ownerid',
            'Host' => 'ES.smtpserver',
            'Port' => 'ES.smtpport',
            'Username' => 'ES.smtpuser',
            'Pwd' => 'ES.smtppassword'
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($joins);
        Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                return new DTO\EmailSettingsDto($row->Host, $row->Port, 
                        $row->Username, $row->Pwd);
            return FALSE;
        
    }
    
    public function isValidSubscriber($userId, $subscriberId) {
         $joins = [
            'Sub' => [
                'table' => 'subscription',
                'type' => 'INNER',
                'conditions' => 'systems.ownerid = Sub.OwnerId and Sub.SubscriberId = '.$subscriberId
            ],
            'L' => [
                'table' => 'licenses',
                'type' => 'INNER',
                'conditions' => 'systems.systemid = L.systemid and L.userid ='.$userId 
            ]
        ];
       
        $fields = [
            'UserId' => 'L.userid'
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($joins);
        Log::debug($rows->sql());
        if($rows->count())
            return TRUE;
        return FALSE;

    }
    
     public function getsystem($subscriberId) {
        
        $join = [
            'S' => [
                'table' => 'subscription',
                'type' => 'INNER',
                'conditions' => 'systems.ownerid = S.OwnerId and S.SubscriberId = '.$subscriberId
            ]
        ];
        $fields = [
            'SubscriberId' => 'S.SubscriberId',
            'OwnerId' => 'systems.ownerid',
            'SystemId' => 'systems.systemid'
        ];
        
        $rows = $this->connect()->find('All',['fields' => $fields])->join($join);
        //$rows = $this->connect()->find();
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count()){
            foreach ($rows as $row)
                return new DTO\SubscriberSystemDto($row->SubscriberId, 
                        $row->SystemId, $row->OwnerId);
        }
        return false;
    }
}
