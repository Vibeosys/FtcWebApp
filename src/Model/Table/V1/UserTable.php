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
use App\Request\V1;
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
    
    public function validateCredential($username, $pwd = null, $userId = null) {
        if(is_null($pwd))
            $conditions = [
                'username =' => $username 
            ];
        else if(is_null($userId))
            $conditions = [
                'username =' => $username,
                'password =' => $pwd
            ];
        else
            $conditions = [
                'userid =' => $userId,
                'password =' => $pwd
            ]; 
        //print_r($conditions);
        Log::debug($conditions);
        $rows = $this->connect()->find()->where($conditions);
        Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
            return $row->userid;
        return FALSE;
    }
    
    public function getPassword($username, $email) {
        $conditions = [
                'username =' => $username,
                'email =' => $email
            ];
            Log::debug($conditions);
            $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)
            return $row->userid;
        return FALSE;
    }
    
    public function getUserDetails($username, $userId = null) {
        if(is_null($userId))  
        $conditions = [
                'username =' => $username 
            ];
        else
           $conditions = [
                'userid =' => $userId
            ];  
        $user = null;
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)
            $user = new \App\Response\V1\UserLoginResponse (
                    $row->userid, 
                    $row->fullname, 
                    $row->username, 
                    $row->password, 
                    $row->email, 
                    $row->userid);
        return $user;
    }
    
    public function getProfile($userId) {
        $conditions = [
                'userid =' => $userId
            ];  
        $user = null;
        $rows = $this->connect()->find()->where($conditions);
         if($rows->count())
            foreach ($rows as $row)
                $user = new \App\Response\V1\getUserProfileResponse (
                        $row->userid, 
                        $row->username, 
                        $row->fullname, 
                        $row->email, 
                        $row->phone, 
                        $row->company_name); 
         return $user;
    }
    
    
    public function isGroup($uname, $group) {
        $conditions = [
                'groupid =' => $group,
                'username =' => $uname
            ];  
         $rows = $this->connect()->find()->where($conditions);
         if($rows->count())
             return 1;
         return 0;
    }
    
    public function updateProfile($userId, V1\UpdateUserProfileRequest $update) {
        $tableObj = $this->connect();
        $entity = $tableObj->get($userId);
        $entity->email = $update->email;
        $entity->fullname = $update->fullName;
        $entity->phone = $update->phone;
        if($tableObj->save($entity))
            return TRUE;
        return false;
    }
    
    public function changePassword($userId, $newPwd) {
       /* $conditions = [
                'userid =' => $userId
            ];
        $key = [
            'password' => $newPwd
        ];*/
        
        $update = $this->connect();
        $row = $update->get($userId);
        $row->password = md5($newPwd);
        if($update->save($row))
            return true;
        return FALSE;
        
    }
    
  
    
    
}
