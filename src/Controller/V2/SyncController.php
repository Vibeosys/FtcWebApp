<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\Model\Table\V2;
use App\Request\V1;

use App\DTO;

/**
 * Description of SyncController
 *
 * @author niteen
 */
class SyncController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\SyncTable();
    }
    
    public function makeSyncEntry(DTO\SyncInsertDto $syncEntry) {
        $this->reliseConnection();
        $this->conncetionCreator($syncEntry->subscriberId);
        $userController = new UserController();
        $clients = $userController->getAdminClients($syncEntry->subscriberId);
        $this->reliseConnection();
        $this->conncetionCreator();
        $result = $this->getTableObj()->newEntry($clients, $syncEntry);
        return $result;
    }
    
    public function getPageUpdates() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $requestUser = V1\UserRequest::Deserialize($request->user);
        if(!$this->conncetionCreator($requestUser->subscriberId)){
            $dbError = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(105));
            $this->response->body($dbError);
            return;
        }   
        $updates = $this->getTableObj()->getUpdates($requestUser->userId);
        if(!empty($updates))
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareSuccessMessage (11), $updates);
        else
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(116));
        
        $this->response->body($response);
    }
    
    
}
