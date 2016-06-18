<?php
namespace App\DTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConfigDto
 *
 * @author niteen
 */
class DBConfigDto {
    
    public $host;
    public $username;
    public $pwd;
    public $dbName;
    
    public function __construct($host = null, 
            $username = null, 
            $pwd = null,
            $dbName = null) {
        $this->host = $host;
        $this->username = $username;
        $this->pwd = $pwd;
        $this->dbName = $dbName;
    }
}
