<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V1;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO;
use App\Model\Mtrait;
/**
 * Description of SignalV1Table
 *
 * @author niteen
 */
class SignalTable extends Table{
    
    use Mtrait\DateConvertorTrait;
    
    public function connect() {
        return TableRegistry::get('signal');
    }
    
    public function getSignal($timestamp = false) {
        $date = $this->timestampToDate($timestamp);
        $signals = [];
        $counter = 0;
        $conditions = [
            'open_time >' => $date
        ];
        $order = 'open_time';
        $rows = $this->connect()->find()->where($conditions)->orderAsc($order);
        if($rows->count()){
        foreach ($rows as $row){
            $signals[$counter++] = new DTO\SignalDto(
                    $row->Ticket, $row->Symbol, 
                    $row->sType, $row->lot, 
                    $row->price, $row->sl, 
                    $row->tp, $row->close_price, 
                    $row->swap, $row->profit, 
                    $this->dateToTimestamp($row->open_time), 
                    $this->dateToTimestamp($row->close_time), 
                    $row->status, $row->copy, 
                    $this->dateToTimestamp($row->exp_time));
        }
        }
        return $signals;
        
    }
}
