<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
/**
 * Description of UserNotificationController
 *
 * @author niteen
 */
class UserSubscriptionController extends V2\UserSubscriptionController{
    
    public function getTableObj() {
        return new V3\UserSubscriptionTable();
    }
    
    public function addNotificationDetails($request) {
        $result = $this->getTableObj()->insertEntry($request);
        return $result;
    }
    
    public function getNonsubscribedUser() {
        $result = $this->getTableObj()->getNonSubscriber();
        return $result;
    }
    
    
}
