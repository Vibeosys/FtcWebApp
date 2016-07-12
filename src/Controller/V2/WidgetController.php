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
    
    public function getAllWidgets($pageId) {
        $result = $this->getTableObj()->getWidgets($pageId);
        return $result;
    }
    
     public function insertNewWidget($newWidget, $authorId, $subscriberId, $pageFor = null) {
        $result = $this->getTableObj()->insert($newWidget);
        if($result){
            $syncEntry = new DTO\SyncInsertDto(
                    $authorId, 
                    $this->tableName, 
                    INSERT, 
                    $this->getPageWidgets($result), $subscriberId);
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry, $pageFor);
            return $result;
        }
        return FALSE;
    }
    
    public function updatePageWidgets($widgets, $authorId, $subscriberId, $pageId) {
        if($this->deletePageWidgets($pageId)){
            $result = $this->insertNewWidget($widgets, $authorId, $subscriberId);
            return $result;
        }
        return FALSE;
    }
    
    public function deletePageWidgets($pageId) {
        $result = $this->getTableObj()->deleteWidgets($pageId);
        return $result;
    }
    
}
