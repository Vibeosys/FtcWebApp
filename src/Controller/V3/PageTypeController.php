<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
/**
 * Description of PageTypeController
 *
 * @author niteen
 */
class PageTypeController extends V2\PageTypeController{
    
    public function getTableobj() {
        return new V3\PageTypeTable(); 
    }
    
    public function getAllPageType() {
        $result = $this->getTableobj()->getPageType();
        return $result;
    }
    
}
