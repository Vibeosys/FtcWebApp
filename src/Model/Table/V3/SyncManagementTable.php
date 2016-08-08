<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO;
use Cake\Log\Log;
/**
 * Description of SyncManagementTable
 *
 * @author niteen
 */
class SyncManagementTable extends V2\SyncManagementTable{
    
    public function connect() {
        return TableRegistry::get('sync_management');
    }
    
    public function insert($userId, $referenceId) {
        $tableObj = $this->connect();
        $newEntry = $tableObj->newEntity();
        $newEntry->UserId = $userId;
        $newEntry->SyncReferenceId = $referenceId;
        $newEntry->CreatedDate = date(DATE_TIME_FORMAT);
        if($tableObj->save($newEntry))
            return TRUE;
        return FALSE;
    }
    
    public function getEntry($referenceId) {
        $conditions = [
            'SyncReferenceId =' => $referenceId
        ];
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count()){
            foreach ($rows as $row)
            return new DTO\SyncManagementDto($row->UserId, $row->SyncReferenceId, $row->CreatedDate);
        }
        return FALSE;
    }
    
    public function deleteEntry($userId, $referenceId) {
        $conditions = [
            'UserId =' => $userId,
            'SyncReferenceId =' => $referenceId
        ];
        $delete = $this->connect()->query()->delete();
        $delete->where($conditions);
        if($delete->execute())
            return TRUE;
        return FALSE;
    }
    
    
}
