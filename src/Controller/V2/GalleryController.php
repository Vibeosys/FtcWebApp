<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V2;
use App\Controller;
use App\Model\Table\V2;
use App\DTO;
/**
 * Description of GalleryController
 *
 * @author niteen
 */
class GalleryController extends Controller\ApiController {
    
    public function getTableObj() {
        return new V2\GalleryTable();
    }
    
    public function getAllGallery() {
        $this->autoRender = FALSE;
        if(!$this->request->is('post')){
            $this->response->body (0);
            return;
        }
        $this->conncetionCreator();
        $result = $this->getTableObj()->getAllItem(); 
        if(!empty($result))
            $this->response->body (json_encode($result));
        else
            $this->response->body (1);
    }
    
    public function galleryItemUpload() {
        $this->autoRender = false;
        if($this->request->is('post')){
            $request = $this->request->data;
            $result = $this->uploadItem($request['file']);
            if($result){
                $itemUrl = $result['url'];
                $itemType = 1; if($result['type'] == 'video')$itemType = 2;;
                $this->conncetionCreator();
                $addRresult = $this->getTableObj()->addItem(
                        new DTO\GalleryDto(null, $itemUrl, $itemType));
                
            }
            
        }
        $this->redirect('gallery');
    }
    
    public function gallery() {
     
    }
}
