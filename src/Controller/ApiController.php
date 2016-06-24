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
use Cake\Mailer\Email;
use Cake\Routing\Router;
//use \V1;

/**
 * Description of ApiCotroller
 *
 * @author niteen
 */
class ApiController extends AppController{
  
    
    public function initialize() {
        parent::initialize();
        if($this->request->contentType() == 'application/json')
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
            $this->dumy = $this->config;
         $this->dumy['host'] = $config->host;   
         $this->dumy['username'] = $config->username;   
         $this->dumy['password'] = $config->pwd;   
         $this->dumy['database'] = $config->dbName;   
        }
       ConnectionManager::config('local',$this->dumy);
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
    
    public function mail($to, $subject, $message) {
      
        $email = new Email('default');
        $mainResult = $email->from([DEFAULT_EMAIL => 'FTC Admin'])
                ->to($to)
                ->subject($subject)
                ->emailFormat('html')
                ->send($message);
        //Log::debug('Mail sending result :'. $mainResult);
        if($mainResult)
            return TRUE;
        else
            return FALSE;
    }
    
    public function getChangePasswordLink($userId, $isSub = false) {
        $random = mt_rand().$userId;
        $code = md5($random);
        $entry = new DTO\ChangePasswordLogDto($userId, $code);
        $changePasswordLogController = new V1\ChangePasswordLogController();
        if($changePasswordLogController->addNewEntry($entry)){
        $baseLink = Router::url('/', true);
        $param = '?code='.$code;
        if($isSub){
            $param .= '&type=1';
        }
        Log::debug('BaseUrl of website : '.$baseLink);
        Log::debug('BaseUrl of website for User : '.$userId);
        return $baseLink.CHANGE_PASSWORD_URL.$param;
        }
        return 'Our Change Password service not working. please contact to admin.';
    }
    
   
}
