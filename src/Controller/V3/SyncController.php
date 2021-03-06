<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
use App\Request\V1;


use App\DTO;

/**
 * Description of SyncController
 *
 * @author niteen
 */
class SyncController extends V2\SyncController{
    
    public function getTableObj() {
        return new V3\SyncTable();
    }
    
    public function makeSyncEntry(DTO\SyncInsertDto $syncEntry, $pageFor = null) {
        //$this->reliseConnection();
        //$this->conncetionCreator($syncEntry->subscriberId);
        $userController = new UserController();
        $clients = $userController->getAdminClients($syncEntry->subscriberId, $pageFor);
        //$this->reliseConnection();
        //$this->conncetionCreator();
        if(is_array($syncEntry->json)){
            foreach ($syncEntry->json as $json){
                 $result = $this->getTableObj()->newEntry($clients, $syncEntry->tableName, $syncEntry->tableOperation, $json);
            }
        }else{
            $result = $this->getTableObj()->newEntry($clients, $syncEntry->tableName, $syncEntry->tableOperation, $syncEntry->json);
        }
        
        return $result;//tableOperation
    }
    
    public function getPageUpdates() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $requestUser = V1\UserRequest::Deserialize($request->user);
        $requestUpdate = \App\Request\V2\SyncUpdatesRequest::Deserialize($request->data);
        if(!$this->conncetionCreator($this->getDatabasesubscription($requestUser->subscriberId))){
            $dbError = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(105));
            $this->response->body($dbError);
            return;
        }   
        $syncManagementController = new SyncManagementController();
        $result = $syncManagementController->addSyncReference(
                new DTO\SyncManagementDto($requestUser->userId, $requestUpdate->referenceId));
        \Cake\Log\Log::debug('Reference entry result : '.$result);
        $updates = $this->getTableObj()->getUpdates($requestUser->userId);
        if(!empty($updates))
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareSuccessMessage (11), json_encode ($updates));
        else
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(116));
        
        $this->response->body(json_encode($response));
    }
    
    public function syncAcknowledgement() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $requestUser = V1\UserRequest::Deserialize($request->user); 
        $requestUpdate = \App\Request\V2\SyncUpdatesRequest::Deserialize($request->data);
        if(!$this->conncetionCreator($this->getDatabasesubscription($requestUser->subscriberId))){
            $dbError = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(105));
            $this->response->body($dbError);
            return;
        }   
        $syncManagementController = new SyncManagementController();
        $result = $syncManagementController->getSyncRefernce($requestUpdate->referenceId);
        $syncDeleteResult=FALSE;
        $deleteResult=FALSE;
        if($result){
            $syncDeleteResult = $this->getTableObj()->deleteSyncEntry($result->userId, $result->lastSync);
            $deleteResult = $syncManagementController->deleteSyncReference($result);
        }
        \Cake\Log\Log::debug($request);
        \Cake\Log\Log::debug('Sync table Delete done . result:'.$syncDeleteResult);
        \Cake\Log\Log::debug('Sync management table Delete done . result:'.$deleteResult);
        if($syncDeleteResult)
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareSuccessMessage (12));
        else
            $response = new \App\Response\V1\BaseResponse (DTO\ErrorDto::prepareError(117));
        
        $this->response->body(json_encode($response));
        
    }
    
    
}
