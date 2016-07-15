<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use App\DTO;
use App\Model\Table\V1;
use App\Request\V2;

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
    
    public function addDatabase(V2\DbTestConnectRequest $request) {
        
        $tableObj = $this->connect();
        $newEntry = $tableObj->NewEntity();
        $newEntry->Hostname = $request->hostname;
        $newEntry->Username = $request->dbuname;
        $newEntry->Pwd = $request->pwd;
        $newEntry->DatabaseName = $request->dbname;
        $newEntry->Port = $request->port;
        $newEntry->OwnerId = $request->owner;
        $newEntry->Active = ACTIVE;
        if($tableObj->save($newEntry))
            return $newEntry->SubscriberId;
        return FALSE;
        
    }
    
    public function updateDatabase(V2\DbTestConnectRequest $request) {
        
        $tableObj = $this->connect();
        $newEntry = $tableObj->get($request->subscriberId);
        $newEntry->Hostname = $request->hostname;
        $newEntry->Username = $request->dbuname;
        $newEntry->Pwd = $request->pwd;
        $newEntry->DatabaseName = $request->dbname;
        $newEntry->Port = $request->port;
        if($tableObj->save($newEntry))
            return $newEntry->SubscriberId;
        return FALSE;
        
    }
    
    public function getDatabaseList($adminId = NULL) {
        $users = [];
        $counter = 0;
        $conditions = [
            'subscription.Active =' => ACTIVE
        ];
        if(!is_null($adminId))
            $conditions['subscription.OwnerId'] = $adminId;
        
        $joins = [
            'U' => [
                'table' => 'users',
                'type' => 'INNER',
                'conditions' => 'U.userid = subscription.OwnerId'
            ]
        ];
        
        $fields = [
            'SubId' => 'subscription.SubscriberId',
            'Host' => 'subscription.Hostname',
            'Uname' => 'subscription.Username',
            'Port' => 'subscription.Port',
            'Pwd' => 'subscription.Pwd',
            'Dbname' => 'subscription.DatabaseName',
            'Owner' => 'U.fullname',
            'Active' => 'subscription.Active',
            'Stype' => 'subscription.subscriptionType'
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($joins)->where($conditions);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                $users[$counter++] = new V2\DbTestConnectRequest (
                        $row->Host, $row->Pwd, $row->Uname, $row->Dbname, 
                        $row->Port, $row->Owner, $row->SubId);
        return $users;
        
    }

}
