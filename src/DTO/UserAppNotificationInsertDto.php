<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of UserAppNotificationInsertDto
 *
 * @author niteen
 */
class UserAppNotificationInsertDto {
   
    public $userId;
    public $notificationId;
    
    public function __construct($userId, $noteId) {
        $this->userId = $userId;
        $this->notificationId = $noteId;
    }
}
