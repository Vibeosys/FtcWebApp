<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of PageUpdateDto
 *
 * @author niteen
 */
class PageUpdateDto {
    public $pageId;
    public $pageName;
    public $pageType;
    public $pageStatus;
    public $active;


    public function __construct($pageId = null, $pageName = null, 
            $pageType = null, $pageStatus = null, $active = null) {
        $this->pageId = $pageId;
        $this->pageName = $pageName;
        $this->pageType = $pageType;
        $this->pageStatus = $pageStatus;
        $this->active = $active;
    }
}
