<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use Cake\Log\Log;
use App\DTO;
/**
 * Description of HomeController
 *
 * @author niteen
 */
class HomeController extends V2\HomeController{
    
    
    public function initialize() {
        Log::debug('initiolized');
        parent::initialize();
    }
    public function index() {
        $username = parent::readCookie('uname');
        
       
        $subscriberId = parent::readCookie('sub_id');
        if(!isset($subscriberId) and !isset($username)){
              $this->redirect ('admin/login');
        }
        $userController = new UserController();
        $this->conncetionCreator($this->getDatabasesubscription($subscriberId));
        $userId = $userController->checkUserCredential($username);
        $role = $userController->getTableObj()->isGroup($username, OWNER_GROUP);
        parent::writeCookie('cur_ad_id', $userId);
        if(!$role)
            $role = $userController->getTableObj()->isFullSubscriber ($username);
        if($role)
        $layout =  FULL_LAYOUT; 
        else
           $layout = MONTHLY_LAYOUT;
        parent::writeCookie('isAdmin', $role);
        parent::writeCookie('current_layout', $layout);
        $this->set(['layout' => $layout]);
          
    }
    
    public function logout() {
        parent::deleteCookie('sub_id');
        parent::deleteCookie('uname');
        parent::deleteCookie('cur_name');
        parent::deleteCookie('cur_email');
        parent::deleteCookie('cur_ad_id');
        parent::deleteCookie('isAdmin');
        $this->redirect ('admin/login');
    }
    
    public function gallery() {
        
    }
    
    public function pageUnderConstruction() {
        
    }
      
   
    
    public function editTemplate() {
        
    }

    public function addTemplate() {
        
    }
  
    
    public function setCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        if($this->request->is('post')){
            $name = $data['name'];
            $value = $data['value'];
            Log::debug('name of cookie: '.$name .'and value is :'.$value);
            parent::writeCookie($name, $value);
            //parent::readCookie($name);
            $this->response->body(1);
        }
    }
    public function getCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        $result = 0;
        if($this->request->is('post')){
            $name = $data['name'];
            $result = parent::readCookie($name);
            Log::debug('cookie value of'. $name.'  return:'.$result);
             if(is_null($result)){
            $result = 0;
        }
        }
       
        $this->response->body($result);
        $this->response->type('text/html');
    }
    
    public function removeCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        if($this->request->is('post')){
            $name = $data['name'];
            $result = parent::deleteCookie($name); 
            Log::debug('cookie value of'. $name.'deleted');
        }
        if(is_null($result)){
            $result = 0;
        }
        $this->response->body($result);
        $this->response->type('text/html');
    }
    
}
