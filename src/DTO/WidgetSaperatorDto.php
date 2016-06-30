<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of WidgetSaperatorDto
 *
 * @author niteen
 */
class WidgetSaperatorDto {
    
    public $widget;
    public $position;
    public $value;
   
    public function __construct($widget = null, $position = null, $value = null) {
        $this->widget = $widget;
        $this->position = $position;
        $this->value = $value;
    }
}
