<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Response\V2;

/**
 * Description of SyncUpdateResponse
 *
 * @author niteen
 */
class SyncUpdateResponse {
    
    public $syncId;
    public $tableName;
    public $tableOperation;
    public $jsonData;
    
    public function __construct($syncId = null, $tableName = null, 
            $tableOperation = null, $pageJson = null) {
        $this->syncId = $syncId;
        $this->tableName = $tableName;
        $this->tableOperation = $tableOperation;
        $this->jsonData = $pageJson;
    }
}
