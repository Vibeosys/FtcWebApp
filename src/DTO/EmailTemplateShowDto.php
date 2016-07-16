<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of EmailTemplateShowDto
 *
 * @author niteen
 */
class EmailTemplateShowDto {

    public $templateId;
    public $name;
    public $body;
    public $date;
    public $active;
    
    public function __construct($id = null, $name = null, $body = null, 
            $date = null, $active = null) {
        $this->templateId = $id;
        $this->name = $name;
        $this->body = $body;
        $this->date = $date;
        $this->active = $active;
    }
}
