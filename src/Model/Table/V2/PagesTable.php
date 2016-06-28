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
 * Description of PagesTable
 *
 * @author niteen
 */
class PagesTable extends Table{
    
     use Mtrait\DateConvertorTrait;
     
     public function connect() {
         return TableRegistry::get('pages');
     }
     
     public function getPages() {
        /* $conditions = [
            'PageId =' => $pageId
        ];
        */  
         $joins = [
             'U' => [
                 'table' => 'users',
                 'type' => 'INNER',
                 'conditions' => 'pages.Author = U.userid'
             ]
         ];
         $fields = [
             'PageId' => 'pages.PageId',
             'PageTitle' => 'pages.PageTitle',
             'Status' => 'pages.Status',
             'PageTypeId' => 'pages.PageTypeId',
             'Author' => 'U.fullname'
         ];
        $pages = [];
        $counter = 0;
        $rows = $this->connect()->find('all',['fields' => $fields])->join($joins);
       // Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)    
            $pages[$counter++] = new DTO\PagesDto(
                    $row->PageId, 
                    $row->PageTitle, 
                    $row->Status, 
                    $row->PageTypeId,
                    $row->Author);
     return $pages;  
     }
}
