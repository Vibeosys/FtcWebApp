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
//use App\Request\V1;
//use App\Response\V1;
/**
 * Description of SignalV1Controller
 *
 * @author niteen
 */
class SignalV1Controller extends Controller\ApiController{
    
    
    public function getTableObj() {
        return new V1\SignalV1Table();
    }
    
    public function getTradeSignal() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $signalRequest = \App\Request\V1\SignalV1Request::Deserialize($request->data);
        $this->conncetionCaterator();
        $signals = $this->getTableObj()->getSignal($signalRequest->date);
        if(empty($signals))
            $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(101));
        else
             $response = new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(1), json_encode ($signals));
        
         $this->response->body(json_encode($response));     
    }
}
