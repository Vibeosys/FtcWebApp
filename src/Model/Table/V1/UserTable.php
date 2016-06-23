<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V1;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO;
use App\Model\Mtrait;
use Cake\Log\Log;
/**
 * Description of UserTable
 *
 * @author niteen
 */
class UserTable extends Table{
    
    use Mtrait\DateConvertorTrait;
    
    public function connect() {
        return TableRegistry::get('users');
    }
    
    public function insert($user) {
        
        $tableObj = $this->connect();
        $newUser = $tableObj->newEntity();
        $newUser->username = $user->username;
        $newUser->fullname = $user->name;
        $newUser->email = $user->email;
        $newUser->password = $user->pwd;
        $newUser->groupid = $user->groupId;
        if(!is_null($user->lastLogin))
        $newUser->lastlogin = $user->lastLogin;
        $newUser->creator_id = $user->creatorId;
        $newUser->create_time = $user->createTime;
        $newUser->client_id = $user->clientId;
        $newUser->phone = $user->phone;
        $newUser->deletestatus = $user->deleteStatus;
        $newUser->company_name = $user->companyName;
        $newUser->isactive = $user->active;
        if($tableObj->save($newUser)){
            Log::debug('User registration success');
            return TRUE;
        }
        Log::error('User registration success');
        return FALSE;
    }
    
    public function validateCredential($username, $pwd = null) {
        if(is_null($pwd))
            $conditions = [
                'username =' => $username 
            ];
        else
            $conditions = [
                'username =' => $username,
                'password =' => $pwd
            ];
        //print_r($conditions);
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)
            return $row->userid;
        return FALSE;
    }
}
