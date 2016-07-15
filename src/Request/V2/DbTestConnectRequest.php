<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V2;
use App\Request\JsonDeserializer;
/**
 * Description of DbTestConnectRequest
 *
 * @author niteen
 */
class DbTestConnectRequest extends JsonDeserializer{
    
    public $hostname;
    public $pwd;
    public $dbuname;
    public $dbname;
    public $port;
    public $owner;
    public $subscriberId;


    public function __construct($hostname = null, $pwd = null, 
            $dbuname = null, $dbname = null, $port = null,$owner = null, $subscriberId = null) {
        $this->hostname = $hostname;
        $this->pwd = $pwd;
        $this->dbuname = $dbuname;
        $this->dbname = $dbname;
        $this->port = $port;
        $this->owner = $owner;
        $this->subscriberId = $subscriberId;
    }
}
