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
 * Description of SystemsController
 *
 * @author niteen
 */
class SystemsController extends V2\SystemsController{
    
    public function getTableObj() {
        return new V3\SystemsTable();
    }
    
    public function getOwnerEmailSettings($userId) {
        $result = $this->getTableObj()->getSettings($userId);
        return $result;
    }
    
    public function getSubscriberSystem($subscriberId) {
        $result = $this->getTableObj()->getsystem($subscriberId);
        return $result;
    }
    
    public function subscriberValidationCheck($userId, $subscriberId) {
        $result = $this->getTableObj()->isValidSubscriber($userId, $subscriberId);
        return $result;
    }
}
