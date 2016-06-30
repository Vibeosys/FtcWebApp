<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\Model\Table\V2;
use App\DTO;
/**
 * Description of WidgetController
 *
 * @author niteen
 */
class WidgetController extends Controller\ApiController{
    
    public  $tableName = 'widget';
    public function getTableObj() {
        return new V2\WidgetTable();
    }
    
    public function getPageWidgets($pageId){
        $result = $this->getTableObj()->getWidgets($pageId);
        return $result;
    }
    
    public function getAllWidgets() {
        $result = $this->getTableObj()->getWidgets();
        return $result;
    }
    
     public function insertNewWidget($newWidget, $authorId, $subscriberId) {
        $result = $this->getTableObj()->insert($newWidget);
        if($result){
            $syncEntry = new DTO\SyncInsertDto(
                    $authorId, 
                    $this->tableName, 
                    INSERT, 
                    $this->getPageWidgets($result), $subscriberId);
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry);
            return $result;
        }
        return FALSE;
    }
    
}
