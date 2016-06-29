<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use App\Model\Mtrait;
use Cake\ORM\Table;
use App\DTO;
use Cake\Log\Log;
use App\Response\V2;
/**
 * Description of SyncTable
 *
 * @author niteen
 */
class SyncTable extends Table{
    
    public function connect() {
        return TableRegistry::get('sync');
    }
    
    public function newEntry($users, $entry) {
       $result = FALSE;
        foreach ($users as $key => $value){
        $tableObj = $this->connect();
        $newEntity = $tableObj->newEntity();
        $newEntity->UserId = $value;
        $newEntity->TableName = $entry->table;
        $newEntity->TableOperation = $entry->operation;
        $newEntity->Json = json_encode($entry->json);
        $newEntity->CreatedDate = date(DATE_TIME_FORMAT);
        if($tableObj->save($newEntity))
            $result = TRUE;
        }
        return $result ;
    }
    
    public function getUpdates($userId) {
        $conditions = [
            'UserId =' => $userId
        ];
        $updates = [];
        $counter = 0;
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)
                $updates[$counter++] = new V2\SyncUpdateResponse (
                        $row->SyncId, 
                        $row->TableName, 
                        $row->TableOperation, 
                        $row->PageJson); 
        return $updates;
    }
}
