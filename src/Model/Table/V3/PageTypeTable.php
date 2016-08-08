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
 * Description of PageTypeTable
 *
 * @author niteen
 */
class PageTypeTable extends V2\PageTypeTable{
    
    public function connect() {
        return TableRegistry::get('mobile_page_type');
    }
    
    public function getPageType() {
        $PageTypes = [];
        $counter = 0;
        $order = 'PageTypeId';
        $rows = $this->connect()->find()->orderAsc($order);
        if($rows->count())
            foreach ($rows as $row)    
            $PageTypes[$counter++] = new DTO\PageTypeDto(
                    $row->PageTypeId, 
                    $row->PageTypeDesc, 
                    $row->Active);
    return $PageTypes;    
    }
}
