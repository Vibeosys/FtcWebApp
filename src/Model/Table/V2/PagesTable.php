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
         return TableRegistry::get('mobile_pages');
     }
     
     public function getPages($author = null, $for = null) {
        /* $conditions = [
            'PageId =' => $pageId
        ];
        */ 
         $condition = '';
         if(!is_null($author))
             $condition .= 'and mobile_pages.Author ='.$author;
         if(!is_null($for))
             $condition .= ' and mobile_pages.PageFor = '.$for;
         
         $joins = [
             'U' => [
                 'table' => 'users',
                 'type' => 'INNER',
                 'conditions' => 'mobile_pages.Author = U.userid '.$condition
             ]
         ];
         $fields = [
             'PageId' => 'mobile_pages.PageId',
             'PageTitle' => 'mobile_pages.PageTitle',
             'Status' => 'mobile_pages.Status',
             'PageTypeId' => 'mobile_pages.PageTypeId',
             'Active' => 'mobile_pages.Active',
             'UpdatedDate' => 'mobile_pages.UpdatedDate'
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
                    $row->Active,
                    $row->Author,
                    $row->UpdatedDate);
     return $pages;  
     }
     
    public function getSingalPage($pageId) {
        $conditions = [
            'PageId =' => $pageId
        ];
        $pages = FALSE; 
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            foreach ($rows as $row)    
            $pages = new DTO\PagesDto(
                    $row->PageId, 
                    $row->PageTitle, 
                    $row->Status, 
                    $row->PageTypeId,
                    $row->Active,
                    $row->Author,
                    $row->updatedDate);
        return $pages;
    }
     
     public function insert(DTO\PageInsertDto $pageInsertDto) {
         $tableobj = $this->connect();
         $newEntity = $tableobj->newEntity();
         $newEntity->PageTitle = $pageInsertDto->pageTitle;
         $newEntity->Status = $pageInsertDto->status;
         $newEntity->PageTypeId = $pageInsertDto->pageType;
         $newEntity->CreatedDate = date(DATE_TIME_FORMAT);
         $newEntity->UpdatedDate = date(DATE_TIME_FORMAT);
         $newEntity->Active = $pageInsertDto->active;
         $newEntity->Author = $pageInsertDto->author;
         $newEntity->PageFor = $pageInsertDto->pageFor;
         Log::debug('This page for :'.$pageInsertDto->pageFor);
         if($tableobj->save($newEntity))
             return $newEntity->PageId;
         return FALSE;
     }
     
     public function pageNameCheck($pageName) {
        $conditions = [
            'PageTitle =' => $pageName
        ]; 
        Log::debug('Page name check for :'.$pageName);
        $rows = $this->connect()->find()->where($conditions);
        if($rows->count())
            return TRUE;
        return FALSE;
     }
     
      public function updatePage(DTO\PageUpdateDto $page) {
        
        $tableObj = $this->connect();
        $oldPage = $tableObj->get($page->pageId);
        $oldPage->PageName = $page->pageName; 
        $oldPage->Status = $page->pageStatus; 
        $oldPage->PageTypeId = $page->pageType; 
        $oldPage->UpdatedDate = date(DATE_TIME_FORMAT);
        if($tableObj->save($oldPage))
            return TRUE;
        return FALSE;
   }
}
