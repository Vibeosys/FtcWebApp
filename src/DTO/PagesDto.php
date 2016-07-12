<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of PagesDto
 *
 * @author niteen
 */
class PagesDto {
    
    public $pageId;
    public $pageTitle;
    public $status;
    public $pageType;
    public $active;
    public $author;
    public $updatedDate;
    public $pageFor;




    public function __construct($pageId = null, $pageTitle = null, 
            $status = null, $pageType = null, $active = null, $author = null, 
            $updatedDate = null, $pageFor = null) {
        $this->pageId = $pageId;
        $this->pageTitle = $pageTitle;
        $this->status = $status;
        $this->pageType = $pageType;
        $this->active= $active;
        $this->author = $author;
        $this->updatedDate = $updatedDate;
        $this->pageFor = $pageFor;
    }
    
}
