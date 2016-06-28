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
    public $author;
    public $pageData;
    
    public function __construct($pageId = null, $pageTitle = null, 
            $status = null, $pageType = null, $author = null, 
            $pageData = null) {
        $this->pageId = $pageId;
        $this->pageTitle = $pageTitle;
        $this->status = $status;
        $this->pageType = $pageType;
        $this->author = $author;
        $this->pageData = $pageData;
    }
    
}
