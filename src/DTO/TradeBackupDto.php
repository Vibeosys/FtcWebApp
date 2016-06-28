<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO;

/**
 * Description of TradeBackupDto
 *
 * @author niteen
 */
class TradeBackupDto {
    
    public $masterAcountId;
    public $ticket;
    public $symbol;
    public $sType;
    public $lot;
    public $price;
    public $sl;
    public $tp;
    public $closePrice;
    public $swap;
    public $profit;
    public $openTime;
    public $closeTime;
    public $status;
    public $plPips;
    
    public function __construct($masterAccountId = null, $ticket = null, 
            $symbol = null, $sType = null, 
            $lot = null, $price = null, $sl = null, $tp = null, $closePrice = null
            ,$swap = null,$profit = null, $openTime = null, $closeTime = null, 
            $status = null, $plPips = null) {
                $this->masterAcountId = $masterAccountId;
                $this->ticket = $ticket;
                $this->symbol = $symbol;
                $this->sType = $sType;
                $this->lot = $lot;
                $this->price = $price;
                $this->sl = $sl;
                $this->tp = $tp;
                $this->closePrice = $closePrice;
                $this->swap = $swap;
                $this->profit = $profit;
                $this->openTime = $openTime;
                $this->closeTime = $closeTime;
                $this->status = $status;
                $this->plPips = $plPips;
    }
}
