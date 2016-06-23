<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V1;
use App\Request;
/**
 * Description of forgotPasswordRequest
 *
 * @author niteen
 */
class ForgotPasswordRequest extends Request\JsonDeserializer{
    
    public $username;
    public $email;
}
