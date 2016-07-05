<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of UserGcmIdDto
 *
 * @author niteen
 */
class UserGcmIdDto {
    
    public $userId;
    public $gcmId;
    public $fullName;
    public $email;
    public $apnId;
    public $subscriberId;


    public function __construct($userId = null, $gcmId = null,$apnId = null,
           $subscriberId = null, $fullName = null, $email = null) {
        $this->userId = $userId;
        $this->gcmId = $gcmId;
        $this->apnId = $apnId;
        $this->subscriberId = $subscriberId;
        $this->fullName = $fullName;
        $this->email = $email;
        
    }
    
}
