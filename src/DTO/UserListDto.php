<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of UserListDto
 *
 * @author niteen
 */
class UserListDto {
   
    public $userId;
    public $email;

    public function __construct($userId = null, $email = null) {
        $this->userId = $userId;
        $this->email = $email;
    }
}
