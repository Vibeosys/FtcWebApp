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
    $this->assign('title', 'Page Customization');
    $this->assign('page_list','1');
?>
 <section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
                <form action="../pages/page" method="post" enctype="multipart/form-data">  
                <div class="col-lg-12 main-page-publish">
                    
                        <h2>Customisation : Page 1</h2>
                        <?php if(isset($message)){ ?>
                        <span style="text-align:center;background-color:white;color: <?= $color ?>;padding:10px"><strong>Page saved as draft.</strong></span>
                        <?php } ?>
                    <div class="publish-btn">
                        <input type="submit" name="publish" value="Publish" class="btn btn-success">
                    <input type="button" value="Cancel" class="btn btn-danger">
                    </div>
                </div>
               <div class="col-lg-12 mobile-show">
                     <div class="heading">
                        <h2>Toolbox</h2>
                    
                    </div>
                
                
                    <ul class="tool-list-mobile">
                            <li><addimage></addimage></li>
                            <li><addlink></addlink></li>
                            <li><addvideo></addvideo></li>
                            <li><addtext></addtext></li>
                            <li><addheading></addheading></li>
                            <li><addweblink></addweblink></li>
                            <li><addrssfeed></addrssfeed></li>
                    </ul>
                   
                </div>
               <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 main-page">
                      
                <div class="heading">
                        
                        <div class="publish-btn">
                    <input type="button" value="Preview" class="btn btn-warning">
                    <input type="submit" name="save" value="Save as Draft" class="btn btn-info">
                    <input type="button" value="Cancel" class="btn cancel-btn">
                    </div>
                    <span class="title-text">
                    App Page Title</span>
                    <input name="page" type="text" class="form-control title-input" id="page" placeholder="News/blog" required>
                    <img id="page_loader" style="width: 38px;margin: 2px 0px;display: none" src="../img/log_loader.gif" alt="Please Wait">
                    <p id="page_name_check_msg" style="margin: 0 0 -8px;display: none"><p>
                    </div>
                    <div ><span class="app-text">App Content</span></div>
                <div class="page-item" >
                <div class="inner-page" id="space-for-tool">
                <div class="canvas center-block"><span class="canvas-text center-block">Canvas</span></div>
                    
                    
                </div>
                    
                </div>
                   
           </div>
            </form>
                 
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
                   <div class="main-page main-page-hide">
                    <div class="heading">
                        <h2>Toolbox</h2>
                    </div>
                   <div class="tool-list">
                        <ul>
                            <li><addimage></addimage></li>
                             <li><addlink></addlink></li>
                             <li><addvideo></addvideo></li>
                             <li><addtext></addtext></li>
                            <li><addheading></addheading></li>
                             <li><addweblink></addweblink></li>
                            <li><addrssfeed></addrssfeed></li>
                       </ul>
                   </div>
                       </div>
                   <div class="main-page mobile-size">
                   <div class="heading">
                        <h2>Mobile Preview</h2>
                      <a href="#"> <span class="fa fa-refresh refresh-link"></span></a>
                    </div>
                
                <div class="page-item" id="privew-for-tool">
                    
                    <div class="image-preview push-space">
                        <img src="../img/download.jpg" class="img-responsive" width="200" height="200">
                    </div>
                    <div class="text-preview push-space">
                    <P>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</P>
                    </div>
                    <div class="link-preview push-space">
                    <a href="pahe.html">Read More</a>
                    </div>
                    <div class="video-preview push-space">
                    <!--<video src="https://www.youtube.com/watch?v=0WyjWF1nZCM" controls>
                                Your browser does not support the <code>video</code> element.
                    </video>-->
                        <iframe width="300" height="200" src="https://www.youtube.com/embed/fgExvIUYg5w"></iframe>
                    </div>
                </div>
                   </div>
                </div>
               
              <!--   <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 main-page mobile-size">
                    
                
               
            </div>-->
               
            </div>
           </div>
           
       </section>

<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog img-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-dialog" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Media</h4>

            </div>
            <div class="modal-body">
                <div id="tab-menu" class="container-fluid">	
                    <ul  class="nav nav-pills">
			             <li class="active">
                                <a  href="#image" data-toggle="tab">Images</a>
                        </li>
			             <li><a href="#video" data-toggle="tab">Videos</a>
			             </li>
                    </ul>
                    <div class="tab-content clearfix">
			             <div class="tab-pane active" id="image">
                             <input type="file" id="fileLoader" name="files" title="Load File" />
                    <input type="button" id="btnmediaFileDialog" value = "Image Upload" class="btn btn-info" onclick="openfileDialog();" />
                        
                <div class="container-fluid">
                    <div class="row row-wrap">
                        
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                               <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                              <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                                 <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                               <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                                <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                            <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                                <input type="image" class="img-responsive" src="../img/logo.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                              <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                                <input type="image" class="img-responsive" src="../img/download.jpg" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                             <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                                <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-6 thumb">
                            <a class="thumbnail" href="#">
                               <input type="image" class="img-responsive" src="../img/bg.png" alt="">
                            </a>
                        </div>

                    </div>
                </div>
                        </div>
                        <div class="tab-pane" id="video">
                                <input type="file" id="fileLoader" name="video-files" title="Load File" />
                    <input type="button" id="btnmediaFileDialog" value = "Video Upload" class="btn btn-info" onclick="openfileDialog();" />
                         <div class="container-fluid">
                    <div class="row row-wrap">
                        
                        <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="video.mp4" type="video/mp4">
                                      <source src="video.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                         <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                            <a class="thumbnail-video" href="#">
                         
                                    <video class="video" controls>
                                      <source src="../img/mov_bbb.mp4" type="video/mp4">
                                      <source src="mov_bbb.ogg" type="video/ogg">
                                      Your browser does not support HTML5 video.
                                    </video>
                           <!--
                                 <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                
                                </iframe>-->
                                <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                            </a>
                        </div>
                             </div>
                            </div>
				        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <div class="btn-wrap">
                            <input type="Submit" class="btn btn-primary" name="submit" value="Set Media">
                            <input type="button" class="btn btn-danger cancel-dialog" data-dismiss="modal" aria-hidden="true" name="cancel" value="Cancel">
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
<?php $this->start('script')?>
<?= $this->Html->script('angular.js') ?>
 <script type='text/javascript'>

var myApp = angular.module('myApp', []);

function MainCtrl($scope) {
    $scope.count = 0;
	$scope.countfile = 0;
    $scope.counttext = 0;
    $scope.countlinktext = 0;
    $scope.countvideolink = 0;
    $scope.countheading = 0;
    $scope.countwebllink = 0;
    $scope.countrssfeed = 0;
}

//Directive that returns an element which adds buttons on click which show an alert on click
myApp.directive("addimage", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer' addbuttons><span class='fa fa-picture-o' ></span>Add Images <span class='fa fa-plus plus-icon' ></span></a>"
	}
});
myApp.directive("addtext", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer' addtextdiv><span class='fa fa-align-left'></span>Add Text<span class='fa fa-plus plus-icon' ></span></a>"
	}
});
myApp.directive("addlink", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer' addlinktext><span class='fa fa-link'></span>Add Link<span class='fa fa-plus plus-icon' ></span></a>"
	}
});
myApp.directive("addvideo", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer' addvideolink><span class='fa fa-video-camera'></span>Add Video<span class='fa fa-plus plus-icon' ></span></a>"
	}
});
myApp.directive("addheading", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer' addheadinglink><span class='fa fa-header'></span>Add Heading<span class='fa fa-plus plus-icon' ></span></a>"
	}
});
myApp.directive("addweblink", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer'  addweblinktext><span class='fa fa-wpforms'></span>Add Web View<span class='fa fa-plus plus-icon' ></span></a>"
	}
});
myApp.directive("addrssfeed", function(){
	return {
		restrict: "E",
		template: "<a style='cursor:pointer' addrssfeedtext ><span class='fa fa-rss'></span>Add RSS Feed<span class='fa fa-plus plus-icon' ></span></a>"
	}
});

//Directive for adding buttons on click that show an alert on click
myApp.directive("addbuttons", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
           
            scope.count++;
			scope.countfile++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin' type='vbcustom'><div style='display:flex'><input type='text' class='form-control' file id=file-input-"+scope.countfile+"'><a name='image-select' class='img-btn' data-toggle='modal' data-target='#myModal'> Select Image </a></div><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
		});
	};
});
myApp.directive("addtextdiv", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.counttext++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><textarea rows='4' placeholder='Text' class='form-control'  id=text-input-"+scope.counttext+" ng-model=textfile"+scope.count+" name='text-"+scope.count+"'></textarea><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addlinktext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countlinktext++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><div style='display:flex'>Link<input name='link-"+scope.count+"' type='text'  placeholder='Link' class='form-control link-input'  id=text-input-link-"+scope.countlinktext+" ng-model=linkfile"+scope.countlinktext+"> Link Caption<input name='link_caption-"+scope.count+"' type='text' placeholder='Link Caption' class='form-control link-input'  id=text-input-cap-link-"+scope.countlinktext+" ng-model=capfile"+scope.countlinktext+"></div> <button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addvideolink", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countvideolink++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><div style='display:flex'>Video Link<input name='video-"+scope.count+"' type='text'  placeholder='Video Link' class='form-control'  id=text-input-video-"+scope.countvideolink+" ng-model=videolinkfile"+scope.countvideolink+"></div> <button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});

myApp.directive("addheadinglink", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countheading++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><input name='heading-"+scope.count+"' type='text'  placeholder='Heading' class='form-control'  id=text-input-head-"+scope.countheading+" ng-model=headingfile"+scope.countheading+"><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addweblinktext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countweblink++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><input name='web-"+scope.count+"' type='text'  placeholder='Web Link' class='form-control'  id=text-input-wenlink-"+scope.countweblink+" ng-model=weblink"+scope.countweblink+"><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addrssfeedtext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countrssfeed++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin id='vbrss'><input type='text'  placeholder='Rss Feed' class='form-control'  id=text-input-rssfeed-"+scope.countrssfeed+" ng-model=rssfeed"+scope.countrssfeed+"><div class='desc'> Description tags to read feed</div><div style='display:flex'><input type='text'  placeholder='Parent' class='form-control link-input' name='rss_parent'  id=text-parent-"+scope.countrssfeed+"></div><div style='display:flex'><input type='text' placeholder='Title' class='form-control link-input' name='rss_title' id=text-title-"+scope.countrssfeed+"><input type='text'  placeholder='Link' class='form-control link-input' name='rss_link'  id=text-link-"+scope.countrssfeed+"></div><div style='display:flex'><input type='text' placeholder='Date' class='form-control link-input' name='rss_date' id=text-date-"+scope.countrssfeed+"><input type='text'  placeholder='Description' class='form-control link-input' name='rss_desc'  id=text-desc-"+scope.countrssfeed+"></div><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
        
            
		});
	};
});
          


myApp.directive("removeMe", function($rootScope) {
      return function(scope,element,attrs)
            {
                element.bind("click",function() {
                    var id= attrs['id'];
                   
                   $("."+id).remove();
                });
            }
      
});  
          $(document).ready(function(){
              
          $(':radio').change(function(e) { 
              
            /*  var text=$('#space-for-tool').text();
              if(text){
                  alert('hello');
                  e.preventDefault();
                  return false;
              }*/
              
              var value=$(this).val();
              if(value == "1"){
                $('.linkrss').attr("disabled","disabled");
                $('.linkrss').addClass("not-active");
                $('.linkweb').attr("disabled","disabled");  
               $('.linkweb').addClass("not-active");
                   $('.linkcustom').removeAttr("disabled");  
               $('.linkcustom').removeClass("not-active");
              }
              else if(value == "2"){
                   $('.linkrss').attr("disabled","disabled");
                $('.linkrss').addClass("not-active");
                $('.linkcustom').attr("disabled","disabled");  
               $('.linkcustom').addClass("not-active");
               $('.linkweb').removeAttr("disabled");  
               $('.linkweb').removeClass("not-active");
              }
               else{
                   $('.linkweb').attr("disabled","disabled");
                $('.linkweb').addClass("not-active");
                $('.linkcustom').attr("disabled","disabled");  
               $('.linkcustom').addClass("not-active");
               $('.linkrss').removeAttr("disabled");  
               $('.linkrss').removeClass("not-active");
              }
            });
    });
          
    $(":image").click(function () {
        $(":image").parent().addClass("not-select");
        $(this).parent().addClass("selected");
        $(this).parent().removeClass("not-select");
    });
            function openfileDialog() {
    $("#fileLoader").click();
}
          $(".cancel-dialog").click(function(){ 
           $(":image").parent().removeClass("selected");
               $(".video-select").removeClass("video-selected");
          });
          
             $(".video-select").click(function () {
        $(".video-select").removeClass("video-selected");
        $(this).addClass("video-selected");
        $(this).removeClass("video-not-select");
    });
 $(document).ready(function(){  
  /* $('#page').keydown(function(e) { 
    if (e.which === 32) {
        return false;
    }
});*/
    $('#page').on('blur', function(e){
        $('#page_loader').css('display','block');
        var pagename = $(this).val();
          $.post('/pagenameavailable',{page:pagename}, function(result){
              if(result === '1'){
                  $('#page_loader').css('display','none');
                   $('#page_name_check_msg').css('display','block');
                   $('#page_name_check_msg').html('<i style="color:green">Correct page name.<i>'); 
              }else{
                $('#page_loader').css('display','none');  
                $('#page_name_check_msg').css('display','block');  
                $('#page').css({'border':'1px solid red'});
                $('#page_name_check_msg').html('<i style="color:red">Incorrect page name.Choose another.<i>'); 
                //e.preventDefault();
                return false;
              }
          });
    });
});
       </script>  

<?php $this->end('script')?>