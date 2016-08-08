<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
use App\DTO;
/**
 * Description of SyncManagementController
 *
 * @author niteen
 */
class SyncManagementController extends V2\SyncManagementController{
    
    public function getTableObj() {
        return new V3\SyncManagementTable() ;
    }
    
    public function addSyncReference(DTO\SyncManagementDto $tableDto) {
        $result = $this->getTableObj()->insert($tableDto->userId, $tableDto->referenceId);
        return $result;
    }
    
    public function deleteSyncReference(DTO\SyncManagementDto $tableDto) {
        $retult = $this->getTableObj()->deleteEntry($tableDto->userId, $tableDto->referenceId);
        return $retult;
    }
    
    public function getSyncRefernce($referenceId) {
        $result = $this->getTableObj()->getEntry($referenceId);
        return $result;
    }
}
