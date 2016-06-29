<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Model\Table\V2;
use App\Controller;
use App\Response\V1;
use App\DTO;

/**
 * Description of PagesController
 *
 * @author niteen
 */
class PagesController extends Controller\ApiController{
    
    public function getTableObj() {
        return new V2\PagesTable();
    }
    
    public function getPages() {
        $this->autoRender = false;
        $this->conncetionCreator();
        $pages = $this->getAllPages();
        $widgetController = new WidgetController();
        $pageTypeController = new PageTypeController();
        $widgets = $widgetController->getAllWidgets();
        $pageType = $pageTypeController->getAllPageType();
        if(!empty($pages)){
              $pagesCustomization = new \App\Response\V2\PageCustomizationResponse($pageType, $pages, $widgets);  
        $response = new V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(11), json_encode($pagesCustomization));    
        }else
        $response = new V1\BaseResponse(DTO\ErrorDto::prepareError(116));
        
    $this->response->body(json_encode($response));
    }
    
    public function getAllPages() {
        $result = $this->getTableObj()->getPages();
        return $result;
    }
    
}
