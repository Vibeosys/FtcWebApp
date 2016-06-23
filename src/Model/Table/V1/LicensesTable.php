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
/**
 * Description of LicensesTable
 *
 * @author niteen
 */
class LicensesTable extends Table{
    
    public function connect() {
        return TableRegistry::get('licenses');
    }
    
    public function isPresent($userId) {
        $conditions = [
            'userid =' => $userId,
        ];
        Log::debug('Is present license for user:- '.$userId);
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            return true;
        return FALSE;
    }
    
    public function isValid($userId) {
          $conditions = [
            'userid =' => $userId,
            'date_expired >' => date(DATE_TIME_FORMAT)  
        ];
          Log::debug('Is valid license for user:- '.$userId." condition for license is");
          Log::debug($conditions);
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
           return true;
        return FALSE;
    }
}
