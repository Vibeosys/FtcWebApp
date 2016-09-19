<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\DTO;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
/**
 * Description of MobileAppSubscrTable
 *
 * @author niteen
 */
class MobileAppSubscrTable extends Table{
    
    public function connect() {
        return TableRegistry::get('mobile_app_subscr');
    }
    
    public function isPresent($userId) {
        $conditions = ['userid =' => $userId];
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            return TRUE;
        return FALSE;
    }
}
