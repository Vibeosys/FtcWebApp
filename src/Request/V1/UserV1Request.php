<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V1;
use App\Request;
/**
 * Description of UserV1Request
 *
 * @author niteen
 */
class UserV1Request extends Request\JsonDeserializer{
    
    public $userId;
    public $subscriberId;
    public $userName;
    public $pwd;
}
