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
/**
 * Description of SyncController
 *
 * @author niteen
 */
class SyncController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\SyncTable();
    }
    
    public function makeSyncEntry($syncEntry) {
        $result = $this->getTableObj()->newEntry($syncEntry);
        return $result;
    }
    
    public function getPageUpdates() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $requestUser = V1\UserRequest::Deserialize($request->user);
        $this->conncetionCreator($requestUser->subscriberId);
        
        
    }
    
    public function getSyncUpdates($userId) {
        
    }
}
