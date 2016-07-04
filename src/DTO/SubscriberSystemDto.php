<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of SubscriberSystemDto
 *
 * @author niteen
 */
class SubscriberSystemDto {
    
    public $systemId;
    public $subscriberId;
    public $ownerId;
    
    
    public function __construct($subscriberId = null, $systemid = null, $ownerId = null) {
        $this->subscriberId = $subscriberId;
        $this->systemId = $systemid;
        $this->ownerId = $ownerId;
    }
    
}
