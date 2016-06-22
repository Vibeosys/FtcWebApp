<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Mtrait;


/**
 * Description of DateConvertor
 *
 * @author niteen
 */
Trait DateConvertorTrait {
    
    
    public function dateToTimestamp($date) {
        if(is_null($date) or empty($date))
            return null;
        return date_timestamp_get($date);
    }
    
    public function timestampToDate($timestamp) {
        return date(DATE_TIME_FORMAT,$timestamp);
    }
}
