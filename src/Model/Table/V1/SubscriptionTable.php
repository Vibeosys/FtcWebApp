<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V1;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO;
use Cake\Cache\Cache;
/**
 * Description of DatabaseConnectionTable
 *
 * @author niteen
 */
class SubscriptionTable extends Table{
    
    public function connect() {
        return TableRegistry::get('subscription');
        Cache::clear(FALSE);
    }
    
    public function getConnection($subscriberId) {
        
        $conditions = [
            'SubscriberId =' => $subscriberId
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
    
    public function getOwnerId($subscriberId) {
        $conditions = [
            'SubscriberId =' => $subscriberId
        ];
        $connections = $this->connect()->find()->where($conditions);
        if($connections->count()){
            foreach ($connections as $connection){
              $config = $connection->OwnerId;  
            }
            return $config;
        }
        return false;
    }
}
