<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
/**
 * Description of PageTable
 *
 * @author niteen
 */
class PageTable extends Table{
    
    public function __construct($connection = []) {
        $this->_dbconnect = $connection;
    }
    
    public function connect() {
        return TableRegistry::get('login',['connection' => $this->_dbconnect]);
    }
    
    public function testDb() {
        
        $data = $this->connect()->find();
        if($data->count()){
        foreach ($data as $row){
           // print_r($row);  
            //echo $row->username.'</br>';
            //echo $row->pwd;
        }
        }
        
    }
}
