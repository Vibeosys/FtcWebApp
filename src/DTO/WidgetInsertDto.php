<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of WidgetInsertDto
 *
 * @author niteen
 */
class WidgetInsertDto {
    
    public $title;
    public $position;
    public $data;
    public $pageId;
    public $subscriberId;
    
    public function __construct($title = null, $position = null, 
            $data = null, $pageId = null, $subscriberId = null) {
        $this->title = $title;
        $this->position = $position;
        $this->data = $data;
        $this->pageId = $pageId;
        $this->subscriberId = $subscriberId;
    }
    
}
