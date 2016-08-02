<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V2;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\Model\Mtrait;
use App\DTO;
use Cake\Log\Log;
/**
 * Description of AppNotificationTable
 *
 * @author niteen
 */
class AppNotificationTable extends Table{
    
    public function connect() {
        return TableRegistry::get('app_notification');
    }
    
    public function insert(DTO\AppNotificationInsertDto $note) {
        $tableObj = $this->connect();
        $newEntry = $tableObj->newEntity();
        $newEntry->SendBy = $note->sendBy;
        $newEntry->NoteTitle = $note->noteTitle;
        $newEntry->NoteText = $note->noteText;
        $newEntry->NoOfRecipients = $note->recipients;
        $newEntry->SendDate = date(DATE_TIME_FORMAT);
        if($tableObj->save($newEntry))
            return $newEntry->NoteId;
        return FALSE;
    }
    
    public function getNote($sendBy) {
        $notes = [];
        $counter = 0;
        $conditions = [
            'SendBy =' => $sendBy
        ];
        $rows = $this->connect()->find()->where($conditions);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                $notes[$counter++] = new DTO\AppNotificationInsertDto(
                        $row->SendBy, $row->NoteTitle, $row->NoteText, 
                        $row->NoOfRecipients, $row->SendDate, $row->NoteId);
          
        return $notes;
    }
    
    public function getUserNotification($userId) {
        $pre_date = date("Y-m-d",strtotime("-1 month",strtotime(date("Y-m-d",strtotime("now") ) )));
        $joins = [
            
            'UAN' => [
                'table' => 'user_app_notification',
                'type' => 'INNER',
                'conditions' => 'app_notification.NoteId = UAN.NoteId and UAN.UserId = '.$userId
                . ' and app_notification.SendDate > "'.$pre_date.'"'
            ]
        ];
       
        $fields = [
            'NoteId'=> 'app_notification.NoteId',
            'Title'=> 'app_notification.NoteTitle',
            'Text'=> 'app_notification.NoteText',
            'Date'=> 'app_notification.SendDate',
        ];
        Log::debug('previous one month date:');
        $notes = [];
        $counter = 0;
        $rows = $this->connect()->find('All',['fields' => $fields])->join($joins);
        \Cake\Log\Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                $notes[$counter++] = new \App\Response\V2\UserAppNotificationResponse 
                        ($row->NoteId, $row->Title, $row->Text, $row->Date);
        return $notes;
    }
}
