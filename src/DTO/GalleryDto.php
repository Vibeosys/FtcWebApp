<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of GalleryDto
 *
 * @author niteen
 */
class GalleryDto {
    
    public $itemId;
    public $itemUrl;
    public $itemType;
    public $uploadDate;
    
    public function __construct($itemId = null, $itemUrl = null, 
            $itemType = null, $uploadDate = null) {
        $this->itemId = $itemId;
        $this->itemUrl = $itemUrl;
        $this->itemType = $itemType;
        $this->uploadDate = $uploadDate;
    }
}
