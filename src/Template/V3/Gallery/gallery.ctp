<?php
use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    use Cake\View\ViewBuilder;
    use Cake\View\Helper\UrlHelper;
  
    $this->layout = 'super_admin_layout';
    $this->assign('title', 'Gallery');
    $this->assign('gallery','1');
    
?>
<?php $this->start('css');?>
   <?= $this->Html->css('simplelightbox.min.css') ?>
<?php $this->end('css');?>

 <section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>Gallery</h2>
                        <span id="up_error" style="margin-left: 28%;display: none" class="error-check error fadeOut">Please select media to upload.</span>
                        <div class="upload-content">
                            <form action="galleryitemupload" method="post" enctype="multipart/form-data"> 
                                <div class="box-input">
                                    <input type="file" name="file" id="fileLoader" class="inputfile inputfile-6" required/>
                                    <label for="fileLoader"><span></span> <strong><i class="fa fa-upload"></i> Choose File</strong></label>
                                </div>
                                <!--<input type="file" id="fileLoader" name="file" title="Load File" required>-->
                                <input type="submit" id="btnOpenFileDialog" value = "Upload" class="btn btn-primary" />
                            </form>
                        </div>
                    </div>
                   <div class="image-list">
                     <div class="gallery">
                         <div id="item_list" class="row"></div>          
                    </div>
                   </div>
                </div>
              </div>
           </div>
       </section>
<input type="hidden" id="cur_delete">
<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog" style="width: 480px">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom:none">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Do you want to delete selected media item?</h4>
                
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="modal-footer">
                        
                        <input type="button" id="yes" data-dismiss="modal" aria-hidden="true" value="Yes" class="btn btn-success btn-large decide">
                        <input type="button" id="no"  data-dismiss="modal" aria-hidden="true" value="No" class="btn btn-large cancel decide">
                    </div>
                </div>
               </div>
            </div>
         </div>
        </div> 
   <div  id="notify" class="ui-pnotify stack_top_right" style="display: none;width: 100%">
    <ul>
        
    </ul>
    
</div>   
<?php $this->start('script');?>
<?= $this->Html->script('notify.js') ?>
       
<script>
  $(document).ready(function(){
      var url = 'getgalleryitems';
       $.ajax({
                type: "post",
                url: url,
                data: null,
                contentType: "application/json; charset=utf-8",
                dataType: "json",  
                success: function(data){
                    if(!data){
                        alert('Access Denied.');
                        return false;
                    }
                    if(data === 1){
                         $('#item_list').html('<h3>Please add gallery items.</h3>');
                    }
                   
                    var html = '';
                  $.each(data, function(key,json){
                   if(json.itemType === 1){   
                  html +='<div id="me_'+ json.itemId+'" class="col-lg-15 col-md-15 col-sm-3 col-xs-12"><div class="wrapper center-block">' +
                        '<div class="img-wrapper center-block">'+
                                '<img src="../'+ json.itemUrl+'" alt=""  class="img-responsive center-block"/>'+
                        '</div><div class="text-wrapper"><div class="preview">'+
                        '<a href="../'+ json.itemUrl+'" ><span class="fa fa-eye icon-hover"></span> Preview</a></div>'+   
                            '<div><button onclick="deleteme('+ json.itemId+');" data-toggle="modal" data-target="#myModal" class="alert-danger deleteme"><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></button></div>'+
                            '</div></div></div>';
                    }else{
                    //html +=   '<div class="col-lg-2 col-md-3 col-xs-12 thumb">'+
                          
                      //      '<video class="video" controls>'+
                        //              '<source src="/readvideo" type="video/mp4">'+
                          //            'Your browser does not support HTML5 video.'+
                            // '</video></div>';    
                        
                    }
                  });
                $('#item_list').html(html);
                  loadafter();  
                },
                failure: function(errMsg) {
                   alert(errMsg);    
                }
                
                  });
                $('#btnOpenFileDialog').on('click',function(e){
                    var file = $('#fileLoader').val();
                    if(file.length <= 0){
                       $('#up_error').css('display','inline-block');
                       e.preventDefault();
                    }
                    
                });
                $('.decide').on('click',function(e){
                    var id = $('#cur_delete').val();
                    if($(this).attr('id') === 'yes'){
                        $.post('/deleteimage',{imageId:id},function(data){
                        var json = $.parseJSON(data);
                        if(json.id === 1){
                            $('#me_'+id).remove();
                            create_note('Media item deleted.','green','info');
                        }else{ create_note('Error to delete media item.','red','warning');
                        }
                        }); 
                     }    
                });
        
       
  }); 
   function deleteme(id){
                $('#cur_delete').val(id);
   }
</script>
<?= $this->Html->script('simple-lightbox.js') ?>
       <script type="text/javascript">
     
    function loadafter(){    
         $(function(){
		var $gallery = $('.gallery a').simpleLightbox();
		
		$gallery.on('show.simplelightbox', function(){
			console.log('Requested for showing');
		})
		.on('shown.simplelightbox', function(){
			console.log('Shown');
		})
		.on('close.simplelightbox', function(){
			console.log('Requested for closing');
		})
		.on('closed.simplelightbox', function(){
			console.log('Closed');
		})
		.on('change.simplelightbox', function(){
			console.log('Requested for change');
		})
		.on('next.simplelightbox', function(){
			console.log('Requested for next');
		})
		.on('prev.simplelightbox', function(){
			console.log('Requested for prev');
		})
		.on('nextImageLoaded.simplelightbox', function(){
			console.log('Next image loaded');
		})
		.on('prevImageLoaded.simplelightbox', function(){
			console.log('Prev image loaded');
		})
		.on('changed.simplelightbox', function(){
			console.log('Image changed');
		})
		.on('nextDone.simplelightbox', function(){
			console.log('Image changed to next');
		})
		.on('prevDone.simplelightbox', function(){
			console.log('Image changed to prev');
		})
		.on('error.simplelightbox', function(e){
			console.log('No image found, go to the next/prev');
			console.log(e);
		});
	});  }  
       </script>
       <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
<?php $this->end('script');?>