<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\Model\Table\V2;
/**
 * Description of WidgetController
 *
 * @author niteen
 */
class WidgetController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\WidgetTable();
    }
    
    public function getPageWidgets($pageId){
        $result = $this->getTableObj()->getWidgets($pageId);
        return $result;
    }
    
}
