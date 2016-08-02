<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Response\V2;

/**
 * Description of UserAppNotificationResponse
 *
 * @author niteen
 */
class UserAppNotificationResponse {
    
    public $notificationId;
    public $title;
    public $text;
    public $sendDate;
    
    public function __construct($noteId, $title, $text, $date) {
        $this->notificationId = $noteId;
        $this->title = $title;
        $this->text = $text;
        $this->sendDate = $date;
    }
    
}
