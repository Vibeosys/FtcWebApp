<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use Cake\ORM\TableRegistry;
use App\Model\Table\V2;
use Cake\ORM\Table;
use App\Model\Mtrait;
use App\DTO;
/**
 * Description of TradeBackupTable
 *
 * @author niteen
 */
class TradeBackupTable extends V2\TradeBackupTable{
    
    use Mtrait\DateConvertorTrait;
    
    public function connect() {
        return TableRegistry::get('trade_backup');
    }
    
    public function getHistory($timestamp) {
        $date = $this->timestampToDate($timestamp);
        
        $signals = [];
        $counter = 0;
        $conditions = [
            'close_time >' => $date
        ];
        $rows = $this->connect()->find()->where($conditions)->orderAsc('close_time');
        //\Cake\Log\Log::debug($rows->sql());
        if($rows->count()){
        foreach ($rows as $row){
            $signals[$counter++] = new DTO\TradeBackupDto($row->masteraccountid,
                    $row->Ticket, $row->Symbol, 
                    $row->sType, $row->lot, 
                    $row->price, $row->sl, 
                    $row->tp, $row->close_price, 
                    $row->swap, $row->profit, 
                    $this->dateToTimestamp($row->open_time), 
                    $this->dateToTimestamp($row->close_time), 
                    $row->status, $row->pl_pips);
        }
        }
        return $signals;
    }
}
