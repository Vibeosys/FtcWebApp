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
 * Description of SystemsController
 *
 * @author niteen
 */
class SystemsController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\SystemsTable();
    }
    
    public function getOwnerEmailSettings($userId) {
        $result = $this->getTableObj()->getSettings($userId);
        return $result;
    }
    
    public function subscriberValidationCheck($userId, $subscriberId) {
        $result = $this->getTableObj()->isValidSubscriber($userId, $subscriberId);
        return $result;
    }
}
