<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\DTO;
/**
 * Description of SignalController
 *
 * @author niteen
 */
class SignalController extends V2\SignalController{
    
    public function getTradeSignal() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        \Cake\Log\Log::debug($request);
        $signalRequest = \App\Request\V1\SignalRequest::Deserialize($request->data);
        $requestUser = \App\Request\V1\UserRequest::Deserialize($request->user);
         if (!$this->conncetionCreator($this->getDatabasesubscription($requestUser->subscriberId)) 
                or !$this->getDatabaseSubscription($requestUser->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        $result = $this->userValidation($requestUser, FALSE);
        if(is_bool($result)){
        $signals = $this->getTableObj()->getSignal($signalRequest->date);
        if(empty($signals))
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(101));
        else
             $response = new \App\Response\V1\BaseResponse(
                     DTO\ErrorDto::prepareSuccessMessage(1), json_encode ($signals));
        }else{
            $result->error = DTO\ErrorDto::prepareError(110);
            $response = $result;
            
        }
         $this->response->body(json_encode($response));     
    }
    
}
