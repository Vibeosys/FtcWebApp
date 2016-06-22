<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Response\V1;

/**
 * Description of BaseResponse
 *
 * @author niteen
 */
class BaseResponse {
    
    public $error;
    public $data;
    
    public function __construct($error = null, $data = null) {
        $this->error = $error;
        $this->data = $data;
    }
}
