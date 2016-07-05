<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\Model\Table\V2;
/**
 * Description of UserNotificationController
 *
 * @author niteen
 */
class UserSubscriptionController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\UserSubscriptionTable();
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
