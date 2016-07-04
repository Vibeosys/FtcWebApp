<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller\V1;
use App\Model\Table\V2\LicensesTable;

/**
 * Description of LicensesController
 *
 * @author niteen
 */
class LicensesController extends V1\LicensesController{
    
    public function getTableobj() {
        return new LicensesTable();
    }
    
    public function getSubscribedUser($subSystem) {
        $result = $this->getTableobj()->getsubscribedUser($subSystem);
        return $result;
    }
    
    
    
}
