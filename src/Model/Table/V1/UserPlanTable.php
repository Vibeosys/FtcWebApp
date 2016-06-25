<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V1;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO;
use App\Model\Mtrait;
use Cake\Log\Log;
/**
 * Description of UserPlanTable
 *
 * @author niteen
 */
class UserPlanTable extends Table{
    
    public function connect() {
        return TableRegistry::get('user_plan');
    }
    
    public function getUserPlan($userId) {
        
        $joins = [
            'p'=>[
                'table' => 'plans',
                'type' => 'INNER',
                'conditions' => 'p.plan_id = user_plan.planid'
            ]
        ];
    }
}
