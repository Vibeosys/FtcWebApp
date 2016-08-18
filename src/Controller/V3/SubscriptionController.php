<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3\SubscriptionTable;
use App\DTO;
/**
 * Description of SubscriptionController
 *
 * @author niteen
 */
class SubscriptionController extends V2\SubscriptionController{
    
    
    //website methods
    public function getTableObj() {
        return new SubscriptionTable();
    }
    
    public function createSubscription() {
        
    }
    
    public function getSubscriberSystem($subscriberId) {
        $result = $this->getTableObj()->getsystem($subscriberId);
        return $result;
    }
    public function pageUnderConstruction() {
        
    }
    
    public function TestDatabaseConnection() {
       $this->autoRender = FALSE;
       if($this->request->is('Post')){
           $request = $this->getRequest();
           \Cake\Log\Log::debug($request->data);
           $testConnect = \App\Request\V2\DbTestConnectRequest::Deserialize($request->data);
           try{
           $result = mysql_connect($testConnect->hostname, $testConnect->dbuname, $testConnect->pwd);
           if($result)
               if(mysql_select_db ($testConnect->dbname)){
                $this->response->body(json_encode(DTO\ErrorDto::prepareSuccessMessage(13)));
                return;
               }
           }  catch (PDOException $e){
               
           }    
           $this->response->body(json_encode(DTO\ErrorDto::prepareError(118)));
       }
    }
    
    public function database() {
        if(!parent::readCookie('isAdmin')){
            \Cake\Log\Log::debug('redirect to '.$this->request->query('back_url'));
            $this->redirect($this->request->query('back_url'));
        }
         \Cake\Log\Log::debug('We are in database top');
        $subscriberId = parent::readCookie('sub_id');
        $this->conncetionCreator($this->getDatabasesubscription($subscriberId));
        $adminId = parent::readCookie('cur_ad_id');
        $userController = new UserController();
        $isOwner = $userController->userGroupCheck(parent::readCookie('uname'), OWNER_GROUP);
        \Cake\Log\Log::debug('We are in database middle');
        if($isOwner or $userController->fullSubscriberCheck(parent::readCookie('uname'))){
        $adminId = null; $isOwner = TRUE;}
      
        \Cake\Log\Log::debug('THIS is admin : '.$adminId);
        $result = $userController->getAdminDatabaseList($adminId);
        $this->set([
            'dbs' => $result,
            'isOwner' => $isOwner,
            'layout' => parent::readCookie('current_layout')
        ]);
    }
    
    public function addDatabase() {
        $request = $this->request->data;
        if($this->request->is('post')){
           // $this->autoRender = FALSE;
          $subscriberId = parent::readCookie('sub_id');
        $this->conncetionCreator($this->getDatabasesubscription($subscriberId));
            $testConnect = \App\Request\V2\DbTestConnectRequest::Deserialize(json_encode($request));
            $result = $this->getTableObj()->addDatabase($testConnect);
            if($result)
                $this->set([
                    'subid' => $result,
                    'color' => 'green',
                    'message' => DTO\ErrorDto::getWebMessage(8),
                     'layout' => parent::readCookie('current_layout')
                ]);
              else 
              $this->set([
                    'color' => 'red',
                    'message' => DTO\ErrorDto::getWebMessage(9),
                   'layout' => parent::readCookie('current_layout')
                ]);    
        }else {
            $this->set([ 'layout' => parent::readCookie('current_layout')]);    
        }
    }
    
    public function editDatabase() {
        $request = $this->request->data;
        if($this->request->is('post') and !isset($request['save'])){
            $editData = \App\Request\V2\DbTestConnectRequest::Deserialize(json_encode($request));
            $this->set([
                'edit' => $editData,
                     'layout' => parent::readCookie('current_layout')
            ]);
        }else if($this->request->is('post') and isset($request['save'])){
            //$this->autoRender = FALSE;
                 $subscriberId = parent::readCookie('sub_id');
        $this->conncetionCreator($this->getDatabasesubscription($subscriberId));
                $testConnect = \App\Request\V2\DbTestConnectRequest::Deserialize(json_encode($request));
                 $result = $this->getTableObj()->updateDatabase($testConnect);
            if($result)
                $this->set([
                     
                    'color' => 'green',
                    'message' => DTO\ErrorDto::getWebMessage(10),
                     'layout' => parent::readCookie('current_layout')
                ]);
              else 
              $this->set([
                    'color' => 'red',
                    'message' => DTO\ErrorDto::getWebMessage(11),
                   'layout' => parent::readCookie('current_layout')
                ]);    
        }else
            $this->redirect ('database');
        
    }
}
