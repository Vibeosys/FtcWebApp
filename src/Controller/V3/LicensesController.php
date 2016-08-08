<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3\LicensesTable;

/**
 * Description of LicensesController
 *
 * @author niteen
 */
class LicensesController extends V2\LicensesController{
    
    public function getTableobj() {
        return new LicensesTable();
    }
    
    public function getSubscribedUser($subSystem, $expired = false) {
        $result = $this->getTableobj()->getsubscribedUser($subSystem ,$expired);
        return $result;
    }
    
    public function getIndirectUser($subSystem, $expired = false) {
        $result = $this->getTableobj()->getIndirectClients($subSystem ,$expired);
        return $result;
    }
    
    
    
}
