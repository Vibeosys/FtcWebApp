<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use App\DTO;
use App\Model\Table\V1;

/**
 * Description of SubscriptionTable
 *
 * @author niteen
 */
class SubscriptionTable extends V1\SubscriptionTable {

    
    public function getsystem($subscriberId) {

        $join = [
            'S' => [
                'table' => 'systems',
                'type' => 'INNER',
                'conditions' => 'subscription.OwnerId = S.ownerid and subscription.SubscriberId'
            ]
        ];
        $fields = [
            'SubscriberId' => 'subscription.SubscriberId',
            'OwnerId' => 'S.ownerid',
            'SystemId' => 'S.systemid'
        ];
        
        $rows = $this->connect()->find('All',['fields' => $fields])->join($join);
        if($rows->count()){
            foreach ($rows as $row)
                return new DTO\SubscriberSystemDto($row->SubscriberId, 
                        $row->SystemId, $row->OwnerId);
        }
        return false;
    }

}
