<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of PagetypeDto
 *
 * @author niteen
 */
class PageTypeDto {
    
    public $pageTypeId;
    public $pageTypeDesc;
    public $active;
    
    public function __construct($id = null, $desc = null, $active = null) {
        $this->pageTypeId = $id;
        $this->pageTypeDesc = $desc;
        $this->active = $active;
    }
}
