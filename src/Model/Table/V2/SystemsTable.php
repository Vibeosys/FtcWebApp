<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO;

/**
 * Description of SystemsTable
 *
 * @author niteen
 */
class SystemsTable extends Table{
    
    public function connect() {
        return TableRegistry::get('systems');
    }
    
    public function getSettings($userId) {
       
        $joins = [
            'ES' => [
                'table' => 'email_settings',
                'type' => 'INNER',
                'conditions' => 'systems.ownerid = ES.userid'
            ],
            'L' => [
                'table' => 'licenses',
                'type' => 'INNER',
                'conditions' => 'systems.systemid = L.systemid and L.userid ='.$userId 
            ]
        ];
       
        $fields = [
            'UserId' => 'systems.ownerid',
            'Host' => 'ES.smtpserver',
            'Port' => 'ES.smtpport',
            'Username' => 'ES.smtpuser',
            'Pwd' => 'ES.smtppassword'
        ];
        $rows = $this->connect()->find('All',['fields' => $fields])->join($joins);
        Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                return new DTO\EmailSettingsDto($row->Host, $row->Port, 
                        $row->Username, $row->Pwd);
            return FALSE;
        
    }
}
