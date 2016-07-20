<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of EmailSettingsDto
 *
 * @author niteen
 */
class EmailSettingsDto {
    
    public $host;
    public $port;
    public $username;
    public $password;
    public $className;


    public function __construct($host = null, $port = null, $username = null, 
            $pwd = null, $className = 'smtp') {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $pwd;
        $this->className = $className;
    }
}
