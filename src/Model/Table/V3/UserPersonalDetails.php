<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;


/**
 * Description of UserPersonalDetails
 *
 * @author niteen
 */
class UserPersonalDetailsView extends V2\UserPersonalDetailsView{
    
    public function connect() {
        return TableRegistry::get('user_personal_details');
    }
    
    public function getPersonalDetails($userId = null) {
       // $user = [];
        //$counter = 0;
        $conditions = [
            'user_id' => $userId
        ];
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)
                return $row;
    }
}
