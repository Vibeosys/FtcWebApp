<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\controller\V1;
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
        if(!$this->getTableObj()->validateCredential($loginRequest->username, md5($loginRequest->pwd)))
           $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(103));
        else
            $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(3));
           
        $this->response->body(json_encode($response)); 
    }
}
