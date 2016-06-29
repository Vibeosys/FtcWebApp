<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Response\V2;

/**
 * Description of PageCustomizationResponse
 *
 * @author niteen
 */
class PageCustomizationResponse {
   
    public $pageType;
    public $pages;
    public $widgets;
    
    public function __construct($pageType = null, $pages = null, $widgets = null) {
        $this->pageType = $pageType;
        $this->pages = $pages;
        $this->widgets = $widgets;
    }
}
