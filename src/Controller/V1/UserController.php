<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V1;
use App\Controller;
use App\Model\Table\V1;
use App\DTO;
use Cake\Log\Log;
//use App\Request\V1;
/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V1\UserTable();
    }
    
    public function UserRegistration() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $userRequest = \App\Request\V1\UserRegisterRequest::Deserialize($request->data);
        $registorInfo = new DTO\UserRegistrationDto($userRequest->username, 
                $userRequest->name, 
                md5($userRequest->pwd), 
                $userRequest->email, 
                $userRequest->phone, 
                USER_GROUP, 
                null, 
                CREATOR_ID, 
                date(DATE_TIME_FORMAT), 
                CLIENT_ID, 
                DELETE_STATUS, 
                COMPANY_NAME, 
                ACTIVE);
        $this->conncetionCreator();
        if(!$this->getTableObj()->insert($registorInfo))
           $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(102));
        else
            $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(2));
           
        $this->response->body(json_encode($response)); 
    }
    
    public function userLogin() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $loginRequest = \App\Request\V1\UserLoginRequest::Deserialize($request->data);
        Log::debug("request data string: ".$request->data);
        $this->conncetionCreator();
        $info = $this->getTableObj()->getUserDetails($loginRequest->username);
               $info->subscriberId = null;
        if(!$this->getTableObj()->validateCredential($loginRequest->username, md5($loginRequest->pwd)))
           $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(103), $info);
        else
            $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(3));
           
        $this->response->body(json_encode($response)); 
    }
    
    public function userSubLogin() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $loginRequest = \App\Request\V1\UserSubLoginRequest::Deserialize($request->data);
        //connect to database using subscriberId
        $this->conncetionCreator($loginRequest->subscriberId);
        //validate user using username, password, and validate license availability and expiry date
        // return bool true if all condition true else return error object
        $result = $this->userValidation($loginRequest);
            if(is_bool($result)){
               $info = $this->getTableObj()->getUserDetails($loginRequest->username);
               $info->subscriberId = $loginRequest->subscriberId;
                $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(3), $info);
            }else
               $response = $result;
        $this->response->body(json_encode($response)); 
    }
    
    public function checkUserCredential($username, $pwd = null) {
        return $this->getTableObj()->validateCredential($username, $pwd);
    }
    
    public function usernameAvailability() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $usernameRequest = \App\Request\V1\UsernameAvailabilityRequest::Deserialize($request->data);
        $this->conncetionCreator();
        if($this->getTableObj()->validateCredential($usernameRequest->username))
            $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(106));
        else
            $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(4));
        $this->response->body(json_encode($response)); 
    }
    
    public function forgotPassword() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $this->conncetionCreator();
        $forgotRequest = \App\Request\V1\ForgotPasswordRequest::Deserialize($request->data);
        $result = $this->getTableObj()->getPassword($forgotRequest->username,$forgotRequest->email);
        if($result){
            echo $result;
        }
            
    }
}
