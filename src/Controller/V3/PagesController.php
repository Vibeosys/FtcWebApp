<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;

use App\Model\Table\V3;
use App\Controller\V2;
use App\Response\V1;
use App\DTO;
use Cake\Log\Log;

/**
 * Description of PagesController
 *
 * @author niteen
 */
class PagesController extends V2\PagesController {

    private $tableName = 'mobile_pages';
    //widget json variables

    private $linkJson = 'link';
    private $captionJson = 'caption';
    private $imageJson = 'url';
    private $textJson = 'text';
    private $videoJson = 'url';
    private $headingJson = 'head';
    private $webViewjson = 'view';
    private $rssJson = 'feed';
    private $rssParentJson = 'feedParent';
    private $rssTitleJson = 'feedTitle';
    private $rssLinkJson = 'feedLink';
    private $rssDateJson = 'feedDate';
    private $rssDescriptionJson = 'feedDescription';
    private $youtubeJson = 'link';
    //widget titles variables

    private $linkTitle = 'Link';
    private $imageTitle = 'Image';
    private $textTitle = 'Text';
    private $headingTitle = 'Heading';
    private $videoTitle = 'Video';
    private $webViewTitle = 'WebView';
    private $rssTitle = 'Rss';
    private $youtubeTitle = 'YouTube';

    public function getTableObj() {
        return new V3\PagesTable();
    }

    public function getPages() {
        $this->autoRender = false;
        
        $getPagesRequest = $this->getRequest();
        $requestUser = \App\Request\V1\UserRequest::Deserialize($getPagesRequest->user);
        $this->conncetionCreator($this->getDatabasesubscription($requestUser->subscriberId));
        $licenceController = new LicensesController();
        $licenceCheck = $licenceController->isLicenseValid($requestUser->userId);
        $for = null;
        $ownerId = null;
        if(!is_bool($licenceCheck))
            $for = NON_SUBSCRIBER_PAGE;
        else {
          $systemController = new SystemsController();
          $ownerSystem =  $systemController->getSubscriberSystem(
                  $this->getMySubscription($requestUser->subscriberId));
          Log::debug($ownerSystem);
          $ownerId = $ownerSystem->ownerId;
        }
        
        $pages = $this->getAllPages($ownerId, $for);
        $pageId = [];
        if(count($pages)){
        foreach ($pages as $page){
            array_push($pageId, $page->pageId);
        }
        $widgetController = new WidgetController();
        $pageTypeController = new PageTypeController();
        $widgets = $widgetController->getAllWidgets($pageId);
        $pageType = $pageTypeController->getAllPageType();
        }
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
        $this->conncetionCreator($this->getDatabasesubscription(parent::readCookie('sub_id')));
        if($this->getTableObj()->pageNameCheck($pagename))
        $this->response->body(0);
        else
        $this->response->body(1);    
    }
    public function getAllPages($userId, $for = null) {
        $result = $this->getTableObj()->getPages($userId, $for);
        return $result;
    }

    public function insertNewPage($newPage) {
        $result = $this->getTableObj()->insert($newPage);
        if ($result and $newPage->status) {
            $page = $this->getTableObj()->getSingalPage($result);
            $syncEntry = new DTO\SyncInsertDto(
                    $newPage->author, $this->tableName, INSERT, $page, $newPage->subscriberId);
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry, $page->pageFor);
        }
        return $result;
    }
    
   

    // website methods
    public function getPageTypesList() {
         $pageTypeController = new PageTypeController();
        $pageType = $pageTypeController->getAllPageType();
        $type = new \stdClass();
        foreach ($pageType as $t){
            $key = $t->pageTypeId;
            $type->$key = $t->pageTypeDesc;
        }
        return $type;
    }
    
    public function pageList() {
        $this->conncetionCreator($this->getDatabasesubscription(parent::readCookie('sub_id')));
        $userController = new UserController();
        $userId = $userController->getTableObj()->validateCredential(parent::readCookie('uname'));
        $role = $userController->getTableObj()->isGroup(parent::readCookie('uname'), OWNER_GROUP);
        $pages = $this->getAllPages($userId);
          Log::debug($pages);
          Log::debug('Value of role :'.$role);
        $this->set([
            'pages' => $pages,
            'type' => $this->getPageTypesList(),
            'role' => $role,
            'layout' => parent::readCookie('current_layout')
                ]);
        
    }

    public function getWidgets($insert, $pageId, $subscriberId) {
        $counter2 = 0;
        $counter3 = 0;
        $counter1 = 0;
        $linkWidgets = [];
        $otherWidgets = [];
        $rssWidgets = [];
        $completeWidget = [];
        foreach ($insert as $obj) {
            if ($obj->widget === 'link' or $obj->widget === 'link_caption') {
                $linkWidgets[$counter2++] = $obj;
            } if($obj->widget === 'rss' or $obj->widget === 'title' or $obj->widget === 'parent' or 
                    $obj->widget === 'rss_link' or $obj->widget === 'date' or $obj->widget === 'description'){
               $rssWidgets[$counter3++] = $obj; 
               Log::debug('rss Link Objs'); 
               Log::debug($rssWidgets); 
            }else
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
            } elseif ($single->widget === 'youtube') {
                $completeWidget[$counter++] = $this->bindWidget($this->youtubeTitle, $this->youtubeJson, $single, $pageId, $subscriberId);
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
        
        foreach ($rssWidgets as $outerObj) {
            if ($outerObj->widget === 'rss') {
                $json = [];
                $json[$this->rssJson] = $outerObj->value;
                foreach ($rssWidgets as $innerObj) {
                    if ($innerObj->widget === 'parent' and $outerObj->position === $innerObj->position) {
                       $json[$this->rssParentJson] = $innerObj->value;
                    }else if ($innerObj->widget === 'title' and $outerObj->position === $innerObj->position){
                        $json[$this->rssTitleJson] = $innerObj->value;
                    }else if ($innerObj->widget === 'rss_link' and $outerObj->position === $innerObj->position){
                        $json[$this->rssLinkJson] = $innerObj->value;
                    }else if ($innerObj->widget === 'date' and $outerObj->position === $innerObj->position){
                        $json[$this->rssDateJson] = $innerObj->value;
                    }else if ($innerObj->widget === 'description' and $outerObj->position === $innerObj->position){
                        $json[$this->rssDescriptionJson] = $innerObj->value;
                    }
                }
                 $completeWidget[$counter++] = new DTO\WidgetInsertDto($this->rssTitle, $outerObj->position, json_encode($json), $pageId, $subscriberId);
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
        $this->conncetionCreator($this->getDatabasesubscription(parent::readCookie('sub_id')));
        $widgetController = new WidgetController();
        if ($this->request->is('post') and (isset($data['publish']) or isset($data['save']))) {
            if(!isset($data['pageId'])){
              Log::debug('This is for save or publish');
            $insert = [];
            $count = 0;
            foreach ($data as $key => $value) {
                if ($key != 'save' and $key != 'page' and $key != 'publish' and $key != 'for') {
                    $widget = explode('-', $key);
                    $insert[$count] = new DTO\WidgetSaperatorDto(
                            $widget[0], $widget[1], $value);
                    $all[$count++] = $widget[0];
                }
            }
            // get current login admin user id
            $author = parent::readCookie('cur_ad_id');
            $subscriberId = $this->getMySubscription(parent::readCookie('sub_id'));
            $pageName = $data['page'];
            $pageStatus = INACTIVE;
            $pageActive = INACTIVE;
            $pageFor = $data['for'];
            if(isset($data['publish'])){
              $pageStatus = ACTIVE;
            $pageActive = ACTIVE;  
            }
            $newPage = new DTO\PageInsertDto($pageName, $pageStatus, 
                    $this->getPageType($all), $pageActive, $author, $subscriberId, $pageFor);
            $pageId = $this->insertNewPage($newPage);
            $completeWidget = $this->getWidgets($insert, $pageId, $subscriberId);
            Log::debug('Page status for current request :- '.$pageStatus);
            $widgetResult = $widgetController->insertNewWidget($completeWidget, $author, $subscriberId, $pageStatus, $pageFor);
            if($widgetResult){
               $response = [
                    'message' => DTO\ErrorDto::getWebMessage(4),
                    'color' => 'green'
                ];
               $success = $pageId;
                //$this->redirect('pages');
            }  else {
                $response = [
                    'message' => DTO\ErrorDto::getWebMessage(5),
                    'color' => 'red'
                ];
            }
            }elseif (isset($data['pageId'])) {
                $edit = true;
                Log::debug('This is for Edit');
                 $response = $this->pageEditOperation($data);
            }
            
           if(isset($success) and !isset($edit)){
            $pageInfo = $this->getTableObj()->getSingalPage($success);
            $widgets = $widgetController->getAllWidgets($success);
            $response['page'] = $pageInfo;
            $response['widgets'] = $widgets;
            }
           
        }
        $userController = new UserController();
        if($userController->userGroupCheck(parent::readCookie('uname'), OWNER_GROUP))
            $response['is_admin'] = 1;
        else
            $response['is_admin'] = 0;
        
            $response['layout'] = parent::readCookie('current_layout');
        $this->set($response);
    }
    
    public function editPage() {
        $request = $this->request->data;
        $widgetController = new WidgetController();
        $this->conncetionCreator($this->getDatabasesubscription(parent::readCookie('sub_id')));
        if($this->request->is('post') and isset($request['Edit'])){
            //$this->autoRender = FALSE;
            $pageId = $request['pageId'];
            $pageInfo = $this->getTableObj()->getSingalPage($pageId);
            $widgets = $widgetController->getAllWidgets($pageId);
            Log::debug($widgets);
            Log::debug($pageInfo);
            //print_r($widgets);
            $this->set([
                'page' => $pageInfo,
                'widgets' => $widgets,
                'scopeCount' => count($widgets),
                'role' => parent::readCookie('isAdmin'),
                'layout' => parent::readCookie('current_layout')
            ]);
        }else if($this->request->is('post') and (isset ($request['save'])
                or isset ($request['publish']))){
          $response = $this->pageEditOperation($request);
          $response['layout'] = parent::readCookie('current_layout');
          $this->set($response);
        }  else {
            Log::debug('forced redirect to pages due to insufficient data.');
            $this->redirect('pages');
        } 
        
    }
    
    public function pageEditOperation($request) {
       
         $widgetController = new WidgetController();
         $insert = [];
            $count = 0;
            foreach ($request as $key => $value) {
                if ($key != 'save' and $key != 'page' and $key != 'publish' and 
                        $key != 'pageId' and $key != 'pageType' 
                        and $key != 'status' and $key != 'active' and $key != 'author'
                        and $key != 'for') {
                    $widget = explode('-', $key);
                    $insert[$count] = new DTO\WidgetSaperatorDto(
                            $widget[0], $widget[1], $value);
                    $all[$count++] = $widget[0];
                }
            }
            $subscriberId = $this->getMySubscription(parent::readCookie('sub_id'));
            $authorId = $request['author'];
            $pageName = $request['page'];
            $pageId = $request['pageId'];
            $pageStatus = $request['status'];
            $pageActive = $request['active'];
            $pageFor = $request['for'];
            $pageType = $this->getPageType($all);
            if(isset($request['publish'])){
              $pageStatus = ACTIVE;
            $pageActive = ACTIVE;  
            }
            $result = $this->updatePage(
                    new DTO\PageUpdateDto($pageId, $pageName, $pageType, 
                            $pageStatus, $pageActive, $pageFor), $subscriberId, $authorId);
            $pageInfo = $this->getTableObj()->getSingalPage($pageId);
            $widgets = $widgetController->getAllWidgets($pageId);
            if($result){
                $completeWidget = $this->getWidgets($insert, $pageId, $subscriberId);
                $updateResult = $widgetController->updatePageWidgets(
                        $completeWidget, $authorId, $subscriberId, $pageId, $pageStatus, $pageFor);
                if($updateResult){
                     $pageInfo = $this->getTableObj()->getSingalPage($pageId);
                     $widgets = $widgetController->getAllWidgets($pageId);
                       $response = [
                    'message' => DTO\ErrorDto::getWebMessage(6),
                    'color' => 'green',
                    'page' => $pageInfo,
                    'widgets' => $widgets,
                    'scopeCount' => count($widgets),
                           'role' => parent::readCookie('isAdmin')
                  ]; 
                }else{
                 $response = [
                    'message' => DTO\ErrorDto::getWebMessage(7),
                    'color' => 'red',
                    'page' => $pageInfo,
                    'widgets' => $widgets,
                    'scopeCount' => count($widgets),
                    'role' => parent::readCookie('isAdmin')
            ];}
            }else{
                 $response = [
                    'message' => DTO\ErrorDto::getWebMessage(7),
                    'color' => 'red',
                    'page' => $pageInfo,
                    'widgets' => $widgets,
                    'scopeCount' => count($widgets),
                       'role' => parent::readCookie('isAdmin')
                ];
            }
            return $response;
    }
    
     public function updatePage($page, $subscriberId, $authorId) {
        $result = $this->getTableObj()->updatePage($page);
        if ($result and $page->pageStatus) {
            $syncEntry = new DTO\SyncInsertDto(
                    $authorId, $this->tableName, UPDATE, $this->getTableObj()->getSingalPage($page->pageId), $subscriberId);
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry, $page->pageFor);
        }
       return $result;
    }
    
    public function deletePages() {
        $this->autoRender = FALSE;
        $request = json_decode($this->request->input());
        if(empty($request->id)){
        $this->response->body(0);           return;}
        $this->conncetionCreator($this->getDatabasesubscription(parent::readCookie('sub_id')));
        $widgetController = new WidgetController();
         $response = 0;
         $page = $this->getTableObj()->getSingalPage($request->id);
        if($widgetController->deletePageWidgets($request->id))
            if($this->getTableObj()->deletePage($request->id)){
                
                  $syncEntry = new DTO\SyncInsertDto(
                    parent::readCookie('cur_ad_id'), $this->tableName, DELETE, 
                       $page, parent::readCookie('sub_id'));
            $syncController = new SyncController();
            $syncController->makeSyncEntry($syncEntry, $page->pageFor);
                $response = $page->pageId;
            }
        $this->response->body($response);
       // $this->response->send();
    }

}
