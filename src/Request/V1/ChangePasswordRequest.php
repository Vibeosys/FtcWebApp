<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V1;

/**
 * Description of ChangePasswordRequest
 *
 * @author niteen
 */
class ChangePasswordRequest {
    
    public $userId;
    public $subscriberId;
    public $pwd;
    
    public function __construct($userId = null, $subscriberId = null, $pwd = null) {
        $this->userId = $userId;
        $this->subscriberId = $subscriberId;
        $this->pwd = $pwd;
    }
    
}
