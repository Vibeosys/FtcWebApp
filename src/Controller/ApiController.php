<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
//use App\Request\V1;
use Cake\Datasource;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use App\DTO;
//use \V1;

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
        $request = \App\Request\V1\BaseRequest::Deserialize($json);
        return $request;
    }
    
    public function validateUser($json) {
       $user = V1\UserRequest::Deserialize($json); 
       
    }
    
    public function conncetionCreator($subscriberId = false) {
        $this->configDBToMain();
        if(!$subscriberId){
            return;
        }
        Log::debug('connection create for subscriber :'.$subscriberId);
        $dbConnectionController = new V1\SubscriptionController();
        $config = $dbConnectionController->getCustomerConnection($subscriberId);
        $this->reliseConnection();
        if($config){
         $this->config['host'] = $config->host;   
         $this->config['username'] = $config->username;   
         $this->config['password'] = $config->pwd;   
         $this->config['database'] = $config->dbName;   
        }
       ConnectionManager::config('local',$this->config);
        return ConnectionManager::get('local');
    }
    
    public function configDBToMain() {
        ConnectionManager::config('local',$this->config);
        return ConnectionManager::get('local');
    }
    
    public function reliseConnection() {
        ConnectionManager::drop('local');
    }
    
    public function checkLicenseValidity($userId) {
       
        $licencesController = new V1\LicensesController();
        $result = $licencesController->isLicenseValid($userId);
        if(is_bool($result))
            return TRUE;
        return $result;
    }
    
    public function userValidation($loginRequest) {
        $userController = new V1\UserController();
        $loginResult = $userController->checkUserCredential($loginRequest->username, md5($loginRequest->pwd)); 
        if($loginResult){
            return $this->checkLicenseValidity($loginResult);
        }else
            return new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(103));
    }
}
