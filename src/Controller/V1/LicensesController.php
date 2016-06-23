<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V1;
use App\Controller;
use App\Model\Table\V1;
use App\DTO;
/**
 * Description of LicensesController
 *
 * @author niteen
 */
class LicensesController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V1\LicensesTable();
    } 
    
    public function isLicenseValid($userId) {
        if($this->getTableObj()->isPresent($userId))
            if($this->getTableObj()->isValid($userId))
            return TRUE;
            else 
                return new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(104));
        else
            return new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(105));  
        
    }
}
