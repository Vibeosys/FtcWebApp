<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\Model\Table\V2;
use App\Response\V1;
use App\DTO;
/**
 * Description of TradeBackupController
 *
 * @author niteen
 */
class TradeBackupController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\TradeBackupTable();
    }
    
    public function getTradeBackup() {
        $this->autoRender = false;
        $request = $this->getRequest();
        $this->conncetionCreator();
        $tradeHistoryRequest = \App\Request\V1\TradeHistoryRequest::Deserialize(
                $request->data);
        $result = $this->getTableObj()->getHistory($tradeHistoryRequest->date);
        if(empty($result))
            $response = new V1\BaseResponse(DTO\ErrorDto::prepareError(115));
        else
            $response = new V1\BaseResponse (
                    DTO\ErrorDto::prepareSuccessMessage (10), 
                    json_encode($result));
        
        $this->response->body(json_encode($response));
    }
}
