<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of EmailTemplateInsertDto
 *
 * @author niteen
 */
class EmailTemplateInsertDto {
    
    public $name;
    public $template;
    
    
    public function __construct($name = null, $template = null) {
        $this->name = $name;
        $this->template = $template;
    }
}
