<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V1;
use App\Request;
/**
 * Description of TradeHistoryRequest
 *
 * @author niteen
 */
class TradeHistoryRequest extends Request\JsonDeserializer{
   
    public $date;
}
