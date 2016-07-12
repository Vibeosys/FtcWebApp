<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of PageInsertDto
 *
 * @author niteen
 */
class PageInsertDto {
    
    public $pageTitle;
    public $status;
    public $pageType;
    public $active;
    public $author;
    public $subscriberId;
    public $pageFor;


    public function __construct($pageTitle = null, $status = null, 
            $pageType = null, $active = null, $author = null, 
            $subscriberId = null, $pageFor = null) {
        $this->pageTitle = $pageTitle;
        $this->status = $status;
        $this->pageType = $pageType;
        $this->active = $active;
        $this->author = $author;
        $this->subscriberId = $subscriberId;
        $this->pageFor = $pageFor;
    }
    
}
