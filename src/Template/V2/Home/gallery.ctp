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
                        <h2>Media</h2>
                    <input type="file" id="fileLoader" name="files" title="Load File" />
                    <input type="button" id="btnOpenFileDialog" value = "Media Upload" class="btn btn-info" onclick="openfileDialog();" />
                         
                    </div>
                
                   <div class="image-list">
                    
         <div class="gallery">
			<div class="row">
                
			<div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div><div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper">
                                <img src="../img/download.jpg" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/download.jpg" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/download.jpg" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/download.jpg" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
                <div class="col-lg-15 col-md-15 col-sm-3 col-xs-6">
                    <div class="wrapper center-block">
                        <div class="img-wrapper center-block">
                                <img src="../img/bg.png" alt=""  class="img-responsive center-block"/>
                        </div>
                       <!-- <div class="view">
                                
                        </div>-->
                        <div class="text-wrapper"> <div class="preview"> <a href="../img/bg.png" ><span class="fa fa-eye icon-hover"></span> Preview</a> </div>   <div> <a href=""><span class="remove"><span class="fa fa-close icon-hover"></span> Remove</span></a></div></div>
                    </div>
                    
			</div>
              
		</div>
          
       </div>
                   </div>
                </div>
               
            
                 
               
                
            
            </div>
           </div>
           
       </section>
<?php $this->start('script');?>
<?= $this->Html->script('simple-lightbox.js') ?>
       <script type="text/javascript">
       function openfileDialog() {
    $("#fileLoader").click();
}
       </script>
       
       
<script>
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
	});
</script>
<?php $this->end('script');?>