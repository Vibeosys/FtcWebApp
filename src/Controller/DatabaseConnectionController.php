<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of DatabaseConnectionController
 *
 * @author niteen
 */
class DatabaseConnectionController extends AppController{
    
    public function getTableObj() {
        return new Table\DatabaseConnectionTable();
    }
    
    public function getCustomerConnection($custId) {
        return $this->getTableObj()->getConnection($custId);
    }
}
