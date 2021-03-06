<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
use App\DTO;
/**
 * Description of WidgetController
 *
 * @author niteen
 */
class WidgetController extends V2\WidgetController{
    
    public  $tableName = 'widget';
    public function getTableObj() {
        return new V3\WidgetTable();
    }
    
    public function getPageWidgets($pageId){
        $result = $this->getTableObj()->getWidgets($pageId);
        return $result;
    }
    
    public function getAllWidgets($pageId) {
        $result = $this->getTableObj()->getWidgets($pageId);
        return $result;
    }
    
     public function insertNewWidget($newWidget, $authorId, $subscriberId, $status, $pageFor = null) {
        $result = $this->getTableObj()->insert($newWidget);
        if($result and $status){
            $syncEntry = new DTO\SyncInsertDto(
                    $authorId, 
                    $this->tableName, 
                    INSERT, 
                    $this->getPageWidgets($result), $subscriberId);
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry, $pageFor);
           
        }
        return $result;
    }
    
    public function updatePageWidgets($widgets, $authorId, $subscriberId, $pageId, $status, $pageFor) {
        if($this->deletePageWidgets($pageId)){
            $result = $this->insertNewWidget($widgets, $authorId, $subscriberId, $status, $pageFor);
            return $result;
        }
        return FALSE;
    }
    
    public function deletePageWidgets($pageId) {
        $result = $this->getTableObj()->deleteWidgets($pageId);
        return $result;
    }
    
}
