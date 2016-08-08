<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use App\Model\Mtrait;
use Cake\ORM\Table;
use App\DTO;
use Cake\Log\Log;

/**
 * Description of WidgetTable
 *
 * @author niteen
 */
class WidgetTable extends V2\WidgetTable{
    
    use Mtrait\DateConvertorTrait;
    
    public function connect() {
        return TableRegistry::get('widget');
    }
    
    public function getWidgets($pageId) {
        if(is_array($pageId))
            $op = ' IN ';
        else
            $op = ' = ';
        $widgets = [];
        $counter = 0;
        $order = 'Position';
        $rows = $this->connect()->find()->where(['PageId'.$op => $pageId])->orderAsc($order);
        if($rows->count())
            foreach ($rows as $row)    
            $widgets[$counter++] = new DTO\WidgetDto (
                    $row->WidgetId, 
                    $row->WidgetTitle, 
                    $row->Position, 
                    $row->WidgetData,
                    $row->PageId);
    return $widgets;    
    }
    
    public function insert($widgets) {
        $result = FALSE;
        $tableObj = $this->connect();
        foreach ($widgets as $widget){
            $newEntity = $tableObj->newEntity();
            $newEntity->WidgetTitle = $widget->title;
            $newEntity->Position = $widget->position;
            $newEntity->WidgetData = $widget->data;
            $newEntity->PageId = $widget->pageId;
            if($tableObj->save($newEntity))
                $result = $newEntity->PageId;
        }
        return $result;
    }
    
    public function deleteWidgets($pageId) {
        $conditions = [
            'PageId =' => $pageId
        ];
        try {
            $delete = $this->connect()->query()->delete();
            $delete->where($conditions);
            if($delete->execute())
                return TRUE;
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
        
    }
    
   
}
