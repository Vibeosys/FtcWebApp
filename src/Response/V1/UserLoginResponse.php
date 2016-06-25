<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Response\V1;
/**
 * Description of UserLoginResponse
 *
 * @author niteen
 */
class UserLoginResponse {
    
    public $userId;
    public $fullName;
    public $username;
    public $pwd;
    public $email;
    public $subscriberId;
            
    public function __construct($userId = null, $fullName = null, $username = null, 
            $pwd = null, $email = null, $subscriberId = 0) {
        $this->userId = $userId;
        $this->username = $username;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->subscriberId = $subscriberId;
        $this->pwd = $pwd;
    }
}
