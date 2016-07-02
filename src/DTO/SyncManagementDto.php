<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of SyncManagementDto
 *
 * @author niteen
 */
class SyncManagementDto {
    
    public $userId;
    public $referenceId;
    public $lastSync;
    
    public function __construct($userId = null, $referenceid = null, $lastSync = null) {
        $this->userId = $userId;
        $this->referenceId = $referenceid;
        $this->lastSync = $lastSync;
    }
    
}
