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
 * Description of PageTypeController
 *
 * @author niteen
 */
class PageTypeController extends Controller\ApiController{
    
    public function getTableobj() {
        return new V2\PageTypeTable(); 
    }
    
    public function getAllPageType() {
        $result = $this->getTableobj()->getPageType();
        return $result;
    }
    
}
