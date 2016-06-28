<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\DTO;
/**
 * Description of WidgetDto
 *
 * @author niteen
 */
class WidgetDto {
    
    public $widgetId;
    public $widgetTitle;
    public $position;
    public $data;

    public function __construct($id = null, $title = null, $position = null, 
            $data = null) {
        $this->widgetId = $id;
        $this->widgetTitle = $title;
        $this->position = $position;
        $this->data = $data;
    }
}
