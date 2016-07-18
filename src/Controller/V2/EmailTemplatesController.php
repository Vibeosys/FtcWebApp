<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\DTO;
use App\Model\Table\V2;
use Cake\Log\Log;
/**
 * Description of EmailTemplatesController
 *
 * @author niteen
 */
class EmailTemplatesController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\EmailTemplatesTable();
    }
    
    public function addNewTemplate($template) {
        $result = $this->getTableObj()->addTemplate($template);
        return $result;
    }
    
    public function editTemplate($template) {
        $result = $this->getTableObj()->updateTemplate($template);
        return $result;
    }
    
    public function getAllTemplate() {
        
    }
    
    public function emailNotification() {
       $request = $this->request->data;
         $this->conncetionCreator(parent::readCookie('sub_id'));
        if($this->request->is('post') and isset($request['edit'])){
              //$this->autoRender = FALSE;
             $template = new DTO\EmailTemplateInsertDto($request['name'], $request['template'], $request['id']);
            if($this->editTemplate($template))
                $response = [
                    'color' => 'green',
                    'message' => 'Template has updated.'
                ];
            else
               $response = [
                    'color' => 'red',
                    'message' => 'Error to update Template.'
                ]; 
            
        }elseif ($this->request->is('post') and isset ($request['save'])) {
            Log::debug($request);
          
            $template = new DTO\EmailTemplateInsertDto($request['name'], $request['template']);
            if($this->addNewTemplate($template))
                $response = [
                    'color' => 'green',
                    'message' => 'Template added into list.'
                ];
            else
               $response = [
                    'color' => 'red',
                    'message' => 'Error to add Template.'
                ];
        }elseif ($this->request->is('post') and isset ($request['send'])) {
            $this->autoRender = FALSE;
            print_r($request);
        }
       $temps = $this->getTableObj()->getTemplates(); 
       if(!empty($temps))
       $response['temps'] = $temps; 
        $this->set ($response);
    }
    
    
}
