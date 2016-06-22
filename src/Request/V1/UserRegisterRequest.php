<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V1;
use App\Request;
/**
 * Description of UserRegisterRequest
 *
 * @author niteen
 */
class UserRegisterRequest extends Request\JsonDeserializer{
    
    public $username;
    public $name;
    public $pwd;
    public $email;
    public $phone;
    
    
}
