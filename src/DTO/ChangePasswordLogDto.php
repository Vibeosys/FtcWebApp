<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of ChangePasswordLogDto
 *
 * @author niteen
 */
class ChangePasswordLogDto {
   
    public $userId;
    public $logCode;
    
    public function __construct($userId = null, $logCode = null) {
        $this->userId = $userId;
        $this->logCode = $logCode;
    }
}
