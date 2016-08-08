<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table\V3;
use App\Model\Table\V2;
use App\DTO;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\Model\Mtrait;
/**
 * Description of EmailTemplatesTable
 *
 * @author niteen
 */
class EmailTemplatesTable extends V2\EmailTemplatesTable{
    
    public function connect() {
        return TableRegistry::get('email_templates');
    }
    
    public function addTemplate(DTO\EmailTemplateInsertDto $template) {
        
        $tableObj = $this->connect();
        $newTemplate = $tableObj->newEntity();
        $newTemplate->TemplateName = $template->name;
        $newTemplate->TemplateBody = $template->template;
        $newTemplate->CreatedDate = date(DATE_TIME_FORMAT);
        $newTemplate->Active = ACTIVE;
        if($tableObj->save($newTemplate))
            return TRUE;
        return FALSE;
    }
    
    public function getTemplates($templateId = null) {
        
        $conditions = [
            'Active' => ACTIVE
        ];
        if(!is_null($templateId)){
            $conditions['TemplateId'] = $templateId;
        }
        $templates = [];
        $counter = 0;
        $rows = $this->connect()->find()->where($conditions);
        Log::debug('Get Template method query');
        Log::debug($rows->sql());
        if($rows->count())
            foreach ($rows as $row)
                $templates[$counter++] = new DTO\EmailTemplateShowDto (
                        $row->TemplateId, $row->TemplateName, 
                        $row->TemplateBody, $row->CreatedDate, $row->Active);
        
        return $templates;
    }
    
    public function updateTemplate(DTO\EmailTemplateInsertDto $request) {
        $tableObj = $this->connect();
        $template = $tableObj->get($request->templateId);
        $template->TemplateName = $request->name;
        $template->TemplateBody = $request->template;
        if($tableObj->save($template))
            return true;
        return FALSE;
    }
}
