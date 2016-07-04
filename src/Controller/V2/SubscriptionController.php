<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller\V1;
use App\Model\Table\V2\SubscriptionTable;
/**
 * Description of SubscriptionController
 *
 * @author niteen
 */
class SubscriptionController extends V1\SubscriptionController{
    
    
    //website methods
    public function getTableObj() {
        return new SubscriptionTable();
    }
    
    public function createSubscription() {
        
    }
    
    public function getSubscriberSystem($subscriberId) {
        $result = $this->getTableObj()->getsystem($subscriberId);
        return $result;
    }
}
