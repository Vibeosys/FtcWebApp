<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO;
/**
 * Description of DatabaseConnectionTable
 *
 * @author niteen
 */
class DatabaseConnectionTable extends Table{
    
    public function connect() {
        return TableRegistry::get('database_connection');
    }
    
    public function getConnection($customerId) {
        
        $conditions = [
            'CustomerId =' => $customerId
        ];
        $connections = $this->connect()->find()->where($conditions);
        if($connections->count()){
            foreach ($connections as $connection){
              $config = new DTO\DBConfigDto(
                      $connection->Hostname, 
                      $connection->Username, 
                      $connection->Pwd, 
                      $connection->DatabaseName);  
                
            }
            return $config;
        }
        return false;
    }
}
