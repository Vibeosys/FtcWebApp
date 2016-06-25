<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V1;
use App\Request;
/**
 * Description of resetPasswordRequest
 *
 * @author niteen
 */
class ResetPasswordRequest extends Request\JsonDeserializer{
    
    public $oldPwd;
    public $newPwd;
    
    public function __construct($oldPwd = null, $newPwd = null) {
        $this->oldPwd = $oldPwd;
        $this->newPwd = $newPwd;
    }
}
