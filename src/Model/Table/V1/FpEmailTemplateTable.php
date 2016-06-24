<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V1;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
/**
 * Description of FpEmailTemplateTable
 *
 * @author niteen
 */
class FpEmailTemplateTable extends Table{
    
    public function connect() {
        return TableRegistry::get('forgot_password_email_template');
    }
    public function getTemplate($templateId) {
        $conditions = [
            'id =' => $templateId
        ];
        $rows = $this->connect()->find()->where($conditions);
         if($rows->count())
            foreach ($rows as $row)
            return $row->email_template;
        return FALSE;
    }
}
