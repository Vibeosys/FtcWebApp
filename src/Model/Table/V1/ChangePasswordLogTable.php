<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V1;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO;
use App\Model\Mtrait;
use Cake\Log\Log;

/**
 * Description of ChangePasswordLogTable
 *
 * @author niteen
 */
class ChangePasswordLogTable extends Table{
    
    public function connect() {
        return TableRegistry::get('change_password_log');
    }
    
    public function addEntry(DTO\ChangePasswordLogDto $entry) {
        $tableObj = $this->connect();
        $newEntry = $tableObj->newEntity();
        $newEntry->UserId = $entry->userId;
        $newEntry->LogCode = $entry->logCode;
        if($tableObj->save($newEntry))
            return true;
        return FALSE;
    }
    
    public function getEntry($logCode) {
        $conditions = [
            'LogCode =' => $logCode
        ];
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)
            return $row->UserId;
        return FALSE;
    }
    
    public function deleteEntry($userId) {
        $conditions = [
            'UserId =' => $userId
        ];
        $delete = $this->connect()->query()->delete();
        $delete->where($conditions);
        $delete->execute();
    }
    
    
}
