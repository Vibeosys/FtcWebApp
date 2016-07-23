<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\Model\Mtrait;
use App\DTO;
/**
 * Description of GalleryTable
 *
 * @author niteen
 */
class GalleryTable extends Table{
    
    public function connect() {
        return TableRegistry::get('gallery');
    }
    
    public function getAllItem() {
        $items = [];
        $counter = 0;
        $rows = $this->connect()->find();
        if($rows->count())
            foreach ($rows as $row)
            $items[$counter++] = new DTO\GalleryDto ($row->ItemId, 
                    $row->ItemUrl, $row->ItemType, $row->UploadedDate);
    return $items;
    }
    
    public function addItem(DTO\GalleryDto $item) {
        $tableObj = $this->connect();
        $newEntity = $tableObj->newEntity();
        $newEntity->ItemUrl = $item->itemUrl;
        $newEntity->ItemType = $item->itemType;
        $newEntity->UploadedDate = date(DATE_TIME_FORMAT);
        if($tableObj->save($newEntity))
            return $newEntity->ItemId;
        else
            return FALSE;
    }
    
    public function deleteme($id) {
        $conditions = [
            'ItemId =' => $id
        ];
        $delete = $this->connect()->query()->delete();
        $delete->where($conditions);
        if($delete->execute())
            return TRUE;
        return FALSE;
    }
}
