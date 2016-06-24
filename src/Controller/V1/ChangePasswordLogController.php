<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V1;
use App\Controller;
use App\Model\Table\V1;

/**
 * Description of ChangePasswordLogController
 *
 * @author niteen
 */
class ChangePasswordLogController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V1\ChangePasswordLogTable();
    }
    
    public function addNewEntry($entry) {
        return $this->getTableObj()->addEntry($entry);
    }
    
    public function getCurrentEntry($logCode) {
        $userId = $this->getTableObj()->getEntry($logCode);
        if($userId){
            $this->getTableObj()->deleteEntry($userId);
            return $userId;
        }
        return FALSE;
    }
    
}
