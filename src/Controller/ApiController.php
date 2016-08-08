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
use Cake\Filesystem\Folder;
//use \V1;

/**
 * Description of ApiCotroller
 *
 * @author niteen
 */
define('DOMAIN',  'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
class ApiController extends AppController{
  
      public $components = array('Cookie');
      public  $galleryItem_ext = [
          'jpeg','jpg','JPEG','JPG','GIF','gif','PNG','png','MP4','mp4','3GP','3gp'
      ];
      
      protected $emailConfig = array();
      protected $from_mail;


      public function initialize() {
        parent::initialize();
        if($this->request->contentType() == 'application/json')
        $this->response->type('json');
    }
    
    public function getRequest() {
        $json = $this->request->input();
        Log::debug($json);
        $request = \App\Request\V1\BaseRequest::Deserialize($json);
        return $request;
    }
    
    public function validateUser($json) {
       $user = V1\UserRequest::Deserialize($json); 
       
    }
    
    public function conncetionCreator($subscriberId = 0) {
        if(is_null($subscriberId))
            return FALSE;
        $this->configDBToMain();
        if($subscriberId == 0){
            return true;
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
        Log::debug($this->dumy);
        }  else {
            Log::debug('Invalid subscription Id used for request. config value :'.$config);
            return $config;
        }
       ConnectionManager::config('local',$this->dumy);
        return ConnectionManager::get('local');
    }
    
    public function configDBToMain() {
        $this->reliseConnection();
        Log::debug('Database connect to owner');
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
    
    public function userValidation($loginRequest, $type = true) {
        if($type){
            $pwd = md5($loginRequest->pwd);
            $errorCode = 103;
        }else{
            $pwd = $loginRequest->pwd;
            $errorCode = 110;
        }
        Log::debug('Subscriber Id of user :- '.$loginRequest->subscriberId);
        $userController = new V1\UserController();
        $loginResult = $userController->checkUserCredential($loginRequest->username,
                $pwd, $this->getMySubscription($loginRequest->subscriberId));
        Log::debug($loginResult);
        if($loginResult){
            if($loginRequest->subscriberId > 0)
            return $this->checkLicenseValidity($loginResult);
        return TRUE;
        }else
            return new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError($errorCode));
    }
    
    public function userValidationV2($loginRequest, $type = true) {
        if($type){
            $pwd = md5($loginRequest->pwd);
            $errorCode = 103;
        }else{
            $pwd = $loginRequest->pwd;
            $errorCode = 110;
        }
        Log::debug('Subscriber Id of user :- '.$loginRequest->subscriberId);
        $userController = new V1\UserController();
        $loginResult = $userController->checkUserCredential($loginRequest->username,$pwd); 
        if($loginResult){
            if($loginRequest->subscriberId > 0)
            return $this->checkLicenseValidity($loginResult);
        return TRUE;
        }else
            return new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError($errorCode));
    }
    
    public function configureEmail($userId) {
        if($userId){
            $systemController = new V2\SystemsController();
            $userEmail = $systemController->getOwnerEmailSettings($userId);
        }else{
            $userController = new V2\UserController();
            $userEmail = $userController->getOwnerEmailSettings();
        }
        if(!isset($userEmail))
            return FALSE;
        $this->emailConfig = json_decode(json_encode($userEmail), true);
        $this->from_mail = $userEmail->username;
        $this->emailConfig['tls'] = true;
       Email::configTransport('gmail', $this->emailConfig);
       return TRUE;
    }
    
    public function mail($to, $subject, $message, $userId = 0) {
        if(!$this->configureEmail($userId))
            return FALSE;
        $email = new Email();
        $mainResult = $email->transport('gmail')->from([$this->from_mail => 'FTC Admin'])
                ->to($to)
                ->subject($subject)
                ->emailFormat('html')
                ->send($message);
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
    
    public function writeCookie($name, $value, $expires = '1 Day', $path = '/') {
        $this->Cookie->configKey($name, ['expires' => $expires ,'path' => $path]);
        $this->Cookie->write($name, $value);
    }
     
    public function readCookie($name) {
        return $this->Cookie->read($name);
    }
     
    public function deleteCookie($name) {
        
        $this->Cookie->configKey($name, ['expires' => '-1 Day' ,'path' => '/']);
        $this->Cookie->delete($name);
    }
    
    public function uploadItem($file) {
        if(!is_array($file)){
            $this->writeCookie('up_msg', 'File not found.');
            $this->writeCookie('up_error', 1);
            return FALSE;
        }
        $type = explode('/', $file['type']);
        Log::debug($type);
        if(!in_array($type[1], $this->galleryItem_ext)){
               $this->writeCookie('up_msg', 'File do no have valid extension.');
            $this->writeCookie('up_error', 1);
            return false;
            
        }else{
            $filename = str_replace(" ","_",$file['name']);
            $tempName = $file['tmp_name'];
            $folder = new Folder(GALLERY_ITEM_UPLOAD_DIR, TRUE);
            $url = 'upload/'.$filename;
            $destination = $folder->path.DS.$filename;
            $response ['url'] = $url; 
            $response ['type'] = $type[0];
            if(move_uploaded_file($tempName, $destination)){
                    $this->writeCookie('up_msg', 'File uploaded successfully.');
                    $this->writeCookie('up_error', 1);
            return $response;
            }else{
                $this->writeCookie('up_msg', 'File fails to upload.');
                $this->writeCookie('up_error', 1);
                return FALSE;
            }
        }
        
    }
    
    public function getDatabasesubscription($composite) {
        if($composite == 0) return 0;
        Log::debug('Composite subscriberId for database connection.'.$composite);
        if(strrchr($composite, SUBSCRIBERID_SAPARATOR)){
            Log::debug('Correct SubscriberId');
            $sub = explode(SUBSCRIBERID_SAPARATOR, $composite);
            return $sub[0];
        }
        return null;
    }
    
    public function getMySubscription($composite) {
         if($composite == 0) return 0;
        Log::debug('Composite subscriberId for business operation.'.$composite);
           if(strrchr($composite, SUBSCRIBERID_SAPARATOR)){
            Log::debug('Correct SubscriberId');
               $sub = explode(SUBSCRIBERID_SAPARATOR, $composite);
            return $sub[1]==1?$sub[0]:$sub[1];
        }
        return null;
    }
    
   
}
