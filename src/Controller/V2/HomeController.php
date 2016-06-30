<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
/**
 * Description of HomeController
 *
 * @author niteen
 */
class HomeController extends Controller\ApiController{
    
    
    public function index() {
        $query = $this->request->query('code');
        if($this->request->is('get') and !isset($query))
            $this->redirect ('admin/login');
    }
    
    public function gallery() {
        
    }
    
    public function database() {
        
    }
    
    public function editDatabase() {
        
    }
    
    public function emailNotification() {
        
    }
    
    public function editTemplate() {
        
    }
    
    public function appNotification() {
        
    }
    
     public function addTemplate() {
        
    }
    
}
