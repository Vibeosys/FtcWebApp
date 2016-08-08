<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V3;
use App\Controller\V2;
use App\Model\Table\V3;
use App\DTO;
/**
 * Description of GalleryController
 *
 * @author niteen
 */
class GalleryController extends V2\GalleryController {
    
    public function getTableObj() {
        return new V3\GalleryTable();
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
                $itemType = 1; if($result['type'] == 'video')$itemType = 2;
                $this->conncetionCreator();
                $addRresult = $this->getTableObj()->addItem(
                        new DTO\GalleryDto(null, $itemUrl, $itemType));
                
            }
            
        }
        $this->redirect('gallery');
    }
    
    public function gallery() {
     
    }
    
    public function readVideo() {
        $this->autoRender = FALSE;
        $local_file = 'http://localhost/upload/video.mp4';
        $size = filesize($local_file);
        
        header("Content-Type: video/mp4");
        header("Content-Length: ".$size);
      //  $this->response->type('html');
        //$this->response->body();
        readfile($local_file);
    }
    
    public function deleteImage() {
        $this->autoRender = false;
        $id = $this->request->data['imageId'];
        \Cake\Log\Log::debug('Image deleted foe Id: '.$id);
        $this->conncetionCreator(parent::readCookie('sub_id'));
        if($this->getTableObj()->deleteme($id)){
        $response['id'] = 1;
        $response['msg'] = 'Gallery item deleted.';
        }  else {
        $response['id'] = 1;
        $response['msg'] = 'Error to Delete gallery item.';    
        }
        $this->response->body(json_encode($response));
    }
}
