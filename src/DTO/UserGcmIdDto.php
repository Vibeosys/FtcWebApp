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
    
    public function __construct($userId = null, $gcmId = null) {
        $this->userId = $userId;
        $this->gcmId = $gcmId;
    }
    
}
