<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
use App\Response\V1;
use App\DTO;
/**
 * Description of TradeBackupController
 *
 * @author niteen
 */
class TradeBackupController extends V2\TradeBackupController{
    
    public function getTableObj() {
        return new V3\TradeBackupTable();
    }
    
     public function getTradeBackup() {
        $this->autoRender = false;
        $request = $this->getRequest();
         $requestUser = \App\Request\V1\UserRequest::Deserialize($request->user);
         if (!$this->conncetionCreator($this->getDatabasesubscription($requestUser->subscriberId)) 
                or !$this->getDatabaseSubscription($requestUser->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
         $result = $this->userValidation($requestUser, false);
        if(is_bool($result)){
        $tradeHistoryRequest = \App\Request\V1\TradeHistoryRequest::Deserialize(
                $request->data);
        $result = $this->getTableObj()->getHistory($tradeHistoryRequest->date);
        if(empty($result))
            $response = new V1\BaseResponse(DTO\ErrorDto::prepareError(115));
        else
            $response = new V1\BaseResponse (
                    DTO\ErrorDto::prepareSuccessMessage (10), 
                    json_encode($result));
        }else{
            $result->error = DTO\ErrorDto::prepareError(110);
            $response = $result;
            
        }
        $this->response->body(json_encode($response));
    }
}
