<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\Model\Table\V2;
use App\Request\V2\DbTestConnectRequest;
use App\DTO;

/**
 * Description of UserTable
 *
 * @author niteen
 */
class UserTable extends V2\UserTable{
    
    public function login($username, $pwd) {
        
    }
    
    public function getUser($subscriberId, $pageFor = null) {
        $conditions = '';
        if(is_null($pageFor) or $pageFor == 1)
            $conditions .= 'and US.SubscriberId ='.$subscriberId;
        
        $join = [
            'US' => [
                'table' => 'user_subscription',
                'type' => 'INNER',
                'conditions' => 'users.userid = US.UserId '.$conditions
            ]
        ];
        $fields = [
            'UserId' => 'users.userid'
        ];
        $users = [];
        $counter = 0;
        $rows = $this->connect()->find('All',['fields' => $fields])->join($join);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
            $users[$counter++] = $row->UserId;
    return $users;
        
    }
    
    public function getNonSubscribedUser() {
        
    }
    
    public function getAdminUser($adminId = null) {
        $users = [];
        $counter = 0;
        $conditions = [
            'groupid =' => ADMIN_GROUP
        ];
        
        $rows = $this->connect()->find()->where($conditions);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                $users[$counter++] = new DTO\UserListDto ($row->userid, $row->email);
        return $users;
    }
    
    public function getEmailSettings() {
        $join = [
            'ES' => [
                'table' => 'email_settings',
                'type' => 'INNER',
                'conditions' => 'users.userid = ES.userid and users.groupid = 1'
            ]
        ];
        $fields = [
            'UserId' => 'ES.userid',
            'Host' => 'ES.smtpserver',
            'Port' => 'ES.smtpport',
            'Username' => 'ES.smtpuser',
            'Pwd' => 'ES.smtppassword'
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($join);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                return new DTO\EmailSettingsDto($row->Host, $row->Port, 
                        $row->Username, $row->Pwd);
            return FALSE;
        
    }
    
    public function isFullSubscriber($uname) {
        $join = [
            'UP' => [
                'table' => 'user_plan',
                'type' => 'INNER',
                'conditions' => 'users.userid = UP.userid and users.username = "'.$uname.'" and UP.planid = 3'
            ]
        ];
        $fields = [
            'UserId' => 'users.userid',
            'PlanId' => 'UP.planid',
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($join);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            return 1;
            return 0;
        
    }
    
    public function getDatabaseList($adminId) {
        $users = [];
        $counter = 0;
        $conditions = [
            'SUB.Active =' => ACTIVE
        ];
        
        if(!is_null($adminId))
            $conditions['SUB.OwnerId'] = $adminId;
        
        $joins = [
            'SUB' => [
                'table' => 'subscription',
                'type' => 'INNER',
                'conditions' => 'users.userid = SUB.OwnerId'
            ]
        ];
        
        $fields = [
            'SubId' => 'SUB.SubscriberId',
            'Host' => 'SUB.Hostname',
            'Uname' => 'SUB.Username',
            'Port' => 'SUB.Port',
            'Pwd' => 'SUB.Pwd',
            'Dbname' => 'SUB.DatabaseName',
            'Owner' => 'users.fullname',
            'Active' => 'SUB.Active',
            'Stype' => 'SUB.subscriptionType'
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($joins)->where($conditions);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                $users[$counter++] = new DbTestConnectRequest (
                        $row->Host, $row->Pwd, $row->Uname, $row->Dbname, 
                        $row->Port, $row->Owner, $row->SubId);
        return $users;
        
    }
    
   
}
