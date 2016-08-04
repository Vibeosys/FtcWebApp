<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V1;
use App\Model\Table\V1;
use App\Controller;
/**
 * Description of DatabaseConnectionController
 *
 * @author niteen
 */
class SubscriptionController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V1\SubscriptionTable();
    }
    
    public function getCustomerConnection($custId) {
        return $this->getTableObj()->getConnection($custId);
    }
    
    public function getOwner($subscriberId) {
        
        $id = $this->getTableObj()->getOwnerId($subscriberId);
        return $id;
        
    }
}
