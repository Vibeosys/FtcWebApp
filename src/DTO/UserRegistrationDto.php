<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;
use App\Request\V1;
/**
 * Description of UserRegistrationDto
 *
 * @author niteen
 */
class UserRegistrationDto extends V1\UserRegisterRequest{
    
    public $groupId;
    public $lastLogin;
    public $creatorId;
    public $createTime;
    public $clientId;
    public $deleteStatus;
    public $companyName;
    public $active;
    
    
    public function __construct($username = null, $name = null, $pwd = null, 
            $email = null, $phone = null, $groupId = null,$lastLogin = null, 
            $creatorId = null, $createTime = null, $clientId = null, 
            $deleteStatus  = null, $companyName = null, $active = null) {
        $this->username = $username;
        $this->name = $name;
        $this->pwd = $pwd;
        $this->email = $email;
        $this->phone = $phone;
        $this->groupId = $groupId;
        $this->lastLogin = $lastLogin;
        $this->creatorId = $creatorId;
        $this->createTime = $createTime;
        $this->clientId = $clientId;
        $this->deleteStatus = $deleteStatus;
        $this->companyName = $companyName;
        $this->active = $active;
    }
}
