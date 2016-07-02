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
use Cake\Log\Log;

/**
 * Description of PagesController
 *
 * @author niteen
 */
class PagesController extends Controller\ApiController {

    private $tableName = 'mobile_pages';
    //widget json variables

    private $linkJson = 'link';
    private $captionJson = 'caption';
    private $imageJson = 'url';
    private $textJson = 'text';
    private $videoJson = 'url';
    private $headingJson = 'head';
    private $webViewjson = 'view';
    private $rssjson = 'view';
    //widget titles variables

    private $linkTitle = 'Link';
    private $imageTitle = 'Image';
    private $textTitle = 'Text';
    private $headingTitle = 'Heading';
    private $videoTitle = 'Video';
    private $webViewTitle = 'WebView';
    private $rssTitle = 'Rss';

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
        if (!empty($pages)) {
            $pagesCustomization = new \App\Response\V2\PageCustomizationResponse(
                    json_encode($pageType), json_encode($pages), json_encode($widgets));
            $response = new V1\BaseResponse(DTO\ErrorDto::prepareSuccessMessage(11), json_encode($pagesCustomization));
        } else
            $response = new V1\BaseResponse(DTO\ErrorDto::prepareError(116));

        $this->response->body(json_encode($response));
    }
    
    public function isPageNameAvailable() {
        $this->autoRender = FALSE;
        $pagename = $this->request->data['page'];
        $this->conncetionCreator(parent::readCookie('sub_id'));
        if($this->getTableObj()->pageNameCheck($pagename))
        $this->response->body(0);
        else
        $this->response->body(1);    
    }
    public function getAllPages() {
        $result = $this->getTableObj()->getPages();
        return $result;
    }

    public function insertNewPage($newPage) {
        $result = $this->getTableObj()->insert($newPage);
        if ($result) {
            $syncEntry = new DTO\SyncInsertDto(
                    $newPage->author, $this->tableName, INSERT, $this->getTableObj()->getSingalPage($result), $newPage->subscriberId);
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry);
            return $result;
        }
        return FALSE;
    }

    // website methods

    public function pageList() {
        
    }

    public function getWidgets($insert, $pageId, $subscriberId) {
        $counter2 = 0;
        $counter1 = 0;
        $linkWidgets = [];
        $otherWidgets = [];
        $completeWidget = [];
        foreach ($insert as $obj) {
            if ($obj->widget === 'link' or $obj->widget === 'link_caption') {
                $linkWidgets[$counter2++] = $obj;
            } else
                $otherWidgets[$counter1++] = $obj;
        }
        $counter = 0;
        foreach ($otherWidgets as $single) {
            if ($single->widget === 'image') {
                $completeWidget[$counter++] = $this->bindWidget($this->imageTitle, $this->imageJson, $single, $pageId, $subscriberId);
            } elseif ($single->widget === 'video') {
                $completeWidget[$counter++] = $this->bindWidget($this->videoTitle, $this->videoJson, $single, $pageId, $subscriberId);
            } elseif ($single->widget === 'text') {
                $completeWidget[$counter++] = $this->bindWidget($this->textTitle, $this->textJson, $single, $pageId, $subscriberId);
            } elseif ($single->widget === 'heading') {
                $completeWidget[$counter++] = $this->bindWidget($this->headingTitle, $this->headingJson, $single, $pageId, $subscriberId);
            } elseif ($single->widget === 'web') {
                $completeWidget[$counter++] = $this->bindWidget($this->webViewTitle, $this->webViewjson, $single, $pageId, $subscriberId);
            } elseif ($single->widget === 'rss') {
                $completeWidget[$counter++] = $this->bindWidget($this->rssTitle, $this->rssjson, $single, $pageId, $subscriberId);
            }
        }
        foreach ($linkWidgets as $obj) {
            if ($obj->widget === 'link') {
                foreach ($linkWidgets as $objCaption) {
                    if ($objCaption->widget === 'link_caption' and $obj->position === $objCaption->position) {
                        $json = [];
                        $json[$this->linkJson] = $obj->value;
                        $json[$this->captionJson] = $objCaption->value;
                        $completeWidget[$counter++] = new DTO\WidgetInsertDto($this->linkTitle, $obj->position, json_encode($json), $pageId, $subscriberId);
                    }
                }
            }
        }
        return $completeWidget;
    }

    public function bindWidget($title, $jsonKey, $single, $pageId, $sunscriberId) {
        $json = [];
        $json[$jsonKey] = $single->value;
        return new DTO\WidgetInsertDto($title, $single->position, json_encode($json), $pageId, $sunscriberId);
    }
    
    public function getPageType($search) {
         if (in_array('web', $search)){
                return 2;
            }elseif(in_array('rss', $search)){
                return 3;
            }elseif (count($search)) {
                return 1;
            }
            
    }
    public function page() {
        $data = $this->request->data;
        if ($this->request->is('post')) {
            $insert = [];
            $count = 0;
          
            foreach ($data as $key => $value) {
                if ($key != 'save' and $key != 'page' and $key != 'publish') {
                    $widget = explode('-', $key);
                    $insert[$count] = new DTO\WidgetSaperatorDto(
                            $widget[0], $widget[1], $value);
                    $all[$count++] = $widget[0];
                }
            }
            $this->conncetionCreator();
            $author = 14571;
            $subscriberId = 2;
            $pageName = $data['page'];
            $pageStatus = INACTIVE;
            $pageActive = INACTIVE;
            if(isset($data['publish'])){
              $pageStatus = ACTIVE;
            $pageActive = ACTIVE;  
            }
            $newPage = new DTO\PageInsertDto($pageName, $pageStatus, 
                    $this->getPageType($all), $pageActive, $author, $subscriberId);
            $pageId = $this->insertNewPage($newPage);
            $completeWidget = $this->getWidgets($insert, $pageId, $subscriberId);
            $widgetController = new WidgetController();
            $widgetResult = $widgetController->insertNewWidget($completeWidget, $author, $subscriberId);
            if($widgetResult){
                $this->set([
                    'message' => DTO\ErrorDto::getWebMessage(4),
                    'color' => 'green'
                ]);
            }  else {
                $this->set([
                    'message' => DTO\ErrorDto::getWebMessage(5),
                    'color' => 'red'
                ]);
            }
           
        }
    }
    
    public function editPage() {
        
    }

}
