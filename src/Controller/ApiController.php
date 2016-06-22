<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Request\V1;

/**
 * Description of ApiCotroller
 *
 * @author niteen
 */
class ApiController extends AppController{
  
    
    public function initialize() {
        parent::initialize();
        $this->response->type('json');
    }
    
    public function getRequest() {
        $json = $this->request->input();
        $request = V1\BaseRequest::Deserialize($json);
        return $request;
    }
    
    public function validateUser($json) {
       $user = V1\UserV1Request::Deserialize($json); 
       
    }
}
