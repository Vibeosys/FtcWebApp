<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Response\V1;

/**
 * Description of getUserProfileResponse
 *
 * @author niteen
 */
class getUserProfileResponse {
  
    public $userId;
    public $username;
    public $fullName;
    public $email;
    public $phone;
    public $companyName;
    public $plan;
    public $subscriberId;
    
    public function __construct($userId = null, $username = null, $fullname = null, 
            $email = null, $phone = null, $companyName = null, $plan = null, 
            $subscriberId = null) {
        $this->userId = $userId;
        $this->username = $username;
        $this->fullName = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->companyName = $companyName;
        $this->plan = $plan;
        $this->subscriberId = $subscriberId;
    }
}
