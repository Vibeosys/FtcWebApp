<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use App\Model\Table\V1;
/**
 * Description of UserTable
 *
 * @author niteen
 */
class UserTable extends V1\UserTable{
    
    public function login($username, $pwd) {
        
    }
    
    public function getUser($subscriberId) {
        
        $join = [
            'US' => [
                'table' => 'user_subsctiption',
                'type' => 'INNER',
                'conditions' => 'users.userid and US.subscriberId ='.$subscriberId
            ]
        ];
        $fields = [
            'UserId' => 'users.userid'
        ];
        $users = [];
        $counter = 0;
        $rows = $this->connect()->find('All',['fields' => $fields])->join($join);
        if($rows->count())
            foreach ($rows as $row)
            $users[$counter++] = $row->UserId;
    return $users;
        
    }
}
