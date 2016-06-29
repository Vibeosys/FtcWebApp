<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of SyncInsertDto
 *
 * @author niteen
 */
class SyncInsertDto {
    
    public $authorId;
    public $tableName;
    public $tableOperation;
    public $json;
    public $subscriberId;


    public function __construct($authorId = null, $tableName = null, 
            $tableOperation = null, $json = null, $subscriberId = null) {
        $this->authorId = $authorId;
        $this->tableName = $tableName;
        $this->tableOperation = $tableOperation;
        $this->json = $json;
         $this->subscriberId = $subscriberId;
    }
}
