<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\DTO;
use App\Model\Table\V3;
use Cake\Log\Log;
/**
 * Description of EmailTemplatesController
 *
 * @author niteen
 */
class EmailTemplatesController extends V2\EmailTemplatesController{
    
    public function getTableObj() {
        return new V3\EmailTemplatesTable();
    }
    
    public function addNewTemplate($template) {
        $result = $this->getTableObj()->addTemplate($template);
        return $result;
    }
    
    public function editTemplate($template) {
        $result = $this->getTableObj()->updateTemplate($template);
        return $result;
    }
    
    public function getForgotPasswordTemplate($templateId = 12) {
        $result = $this->getTableObj()->getTemplates($templateId);
        foreach ($result as $temp)
        return $temp->body;
    return FALSE;
    }
    
    public function emailNotification() {
       $request = $this->request->data;
         $this->conncetionCreator(parent::readCookie('sub_id'));
        if($this->request->is('post') and isset($request['edit'])){
              //$this->autoRender = FALSE;
             $template = new DTO\EmailTemplateInsertDto(
                     $request['name'], $request['template'], $request['id']);
            if($this->editTemplate($template))
                $response = [
                    'color' => 'green',
                    'message' => 'Template has updated.',
                    'layout' => parent::readCookie('current_layout')
                ];
            else
               $response = [
                    'color' => 'red',
                    'message' => 'Error to update Template.',
                   'layout' => parent::readCookie('current_layout')
                ]; 
            
        }elseif ($this->request->is('post') and isset ($request['save'])) {
           //$this->autoRender = FALSE;
            Log::debug($request);
            //print_r($request);
            //return;
            $template = new DTO\EmailTemplateInsertDto(
                    $request['name'], $request['template']);
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
            $usercontroller = new UserController();
            $smtp = $usercontroller->getUserEmailSettings(parent::readCookie('cur_ad_id'));
            Log::debug($smtp);
            print_r($request);
        }
       $temps = $this->getTableObj()->getTemplates(); 
       if(!empty($temps))
       $response['temps'] = $temps;
       
       $response['layout'] = parent::readCookie('current_layout');
        $this->set ($response);
    }
    
    
}
