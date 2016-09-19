<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller;
use App\Model\Table\V3\MobileAppSubscrTable;
use App\DTO;

/**
 * Description of MobileAppSubscrController
 *
 * @author niteen
 */
class MobileAppSubscrController extends Controller\ApiController{
    
    public function getTableObj() {
        return new MobileAppSubscrTable();
    }
    
    public function isUserPresent($userId) {
        $result = $this->getTableObj()->isPresent($userId);
        if($result)
           return $result;
        return new \App\Response\V1\BaseResponse(DTO\ErrorDto::prepareError(104));
    }
}
