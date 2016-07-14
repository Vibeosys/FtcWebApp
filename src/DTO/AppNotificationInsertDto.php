<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of AppNotificationInsertDto
 *
 * @author niteen
 */
class AppNotificationInsertDto {
    
    public $sendBy;
    public $noteTitle;
    public $noteText;
    public $recipients;
    public $date;
    public $noteId;
    
    public function __construct($sendBy = null, $noteTitle = null, 
            $noteText = null, $recipients = null, $date = null, $noteId = null) {
        $this->sendBy = $sendBy;
        $this->noteTitle = $noteTitle;
        $this->noteText = $noteText;
        $this->recipients = $recipients;
        $this->date = $date;
        $this->noteId = $noteId;
    }
}
