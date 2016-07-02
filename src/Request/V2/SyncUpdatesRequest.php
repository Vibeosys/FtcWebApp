<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Request\V2;
use App\Request;
/**
 * Description of SyncUpdatesRequest
 *
 * @author niteen
 */
class SyncUpdatesRequest extends Request\JsonDeserializer{
    
    public $referenceId;
}
