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
 * Description of UserPlanController
 *
 * @author niteen
 */
class UserPlanController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V1\UserPlanTable();
    }
    
    public function getUserPlan($userId) {
        return $this->getTableObj()->getPlan($userId);
    }
}
