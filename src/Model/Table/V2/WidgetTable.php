<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
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
class WidgetTable extends Table{
    
    use Mtrait\DateConvertorTrait;
    
    public function connect() {
        return TableRegistry::get('widget');
    }
    
    public function getWidgets($pageId) {
        $conditions = [
            'PageId =' => $pageId
        ];
        
        $widgets = [];
        $counter = 0;
        $order = 'Position';
        $rows = $this->connect()->find()->where($conditions)->orderAsc($order);
        if($rows->count())
            foreach ($rows as $row)    
            $widgets[$counter++] = new DTO\WidgetDto (
                    $row->WidgetId, 
                    $row->WidgetTitle, 
                    $row->Position, 
                    $row->WidgetData);
    return $widgets;    
    }
}
