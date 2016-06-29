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
                <div class="col-lg-12 main-page-publish">
                    
                        <h2>Customisation : Page 1</h2>
                   
                    <div class="publish-btn">
                <input type="button" value="Publish" class="btn btn-success">
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
                    <input type="button" value="Save as Draft" class="btn btn-info">
                    <input type="button" value="Cancel" class="btn cancel-btn">
                    </div>
                    <span class="title-text">
                    App Page Title</span>
                    <input type="text" class="form-control title-input" value="News/blog">
                    
                    </div>
                    <div ><span class="app-text">App Content</span></div>
                <div class="page-item" >
                <div class="inner-page" id="space-for-tool">
                <div class="canvas center-block"><span class="canvas-text center-block">Canvas</span></div>
                    
                    
                </div>
                    
                </div>
             
                <!--   <div class="">
                   <textarea rows="4" placeholder="Text" class="form-control" ></textarea>
                   </div>-->
           </div>
            
                 
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
                   <div class="main-page main-page-hide">
                    <div class="heading">
                        <h2>Toolbox</h2>
                    </div>
                   <div class="tool-list">
                        <ul><!--
                            <li><a href="" ng-click="AppendFile()"><span class="fa fa-picture-o" ></span>Add Images</a><addimage></addimage></li>
                             <li><a href="" ><span class="fa fa-link"></span>Add Link</a></li>
                             <li><a href=""><span class="fa fa-video-camera"></span>Add Video</a></li>
                             <li><a href="" ng-click="AppendText()"><span class="fa fa-align-left"></span>Add Text</a></li>
                             <li><a href=""><span class="fa fa-list"></span>Add List</a></li>
                            -->
                            <li><addimage></addimage></li>
                             <li><addlink></addlink></li>
                             <li><addvideo></addvideo></li>
                             <li><addtext></addtext></li>
                            <li><addheading></addheading></li>
                             <li><addweblink></addweblink></li>
                            <li><addrssfeed></addrssfeed></li>
                             <!--<li><a href=""><span class="fa fa-list"></span>Add List</a></li>-->
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
		template: "<a style='cursor:pointer' addweblinktext><span class='fa fa-wpforms'></span>Add Web View<span class='fa fa-plus plus-icon' ></span></a>"
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
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><input type='file' class='form-control' ng-model=myFile"+scope.countfile+" file id=file-input-"+scope.countfile+" accept='image/*'><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addtextdiv", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.counttext++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><textarea rows='4' placeholder='Text' class='form-control'  id=text-input-"+scope.counttext+" ng-model=textfile"+scope.count+"></textarea><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addlinktext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countlinktext++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><div style='display:flex'>Link<input type='text'  placeholder='Link' class='form-control link-input'  id=text-input-link-"+scope.countlinktext+" ng-model=linkfile"+scope.countlinktext+"> Link Caption<input type='text' placeholder='Link Caption' class='form-control link-input'  id=text-input-cap-link-"+scope.countlinktext+" ng-model=capfile"+scope.countlinktext+"></div> <button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addvideolink", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countvideolink++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><div style='display:flex'>Video Link<input type='text'  placeholder='Video Link' class='form-control'  id=text-input-video-"+scope.countvideolink+" ng-model=videolinkfile"+scope.countvideolink+"></div> <button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});

myApp.directive("addheadinglink", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countheading++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><input type='text'  placeholder='Heading' class='form-control'  id=text-input-head-"+scope.countheading+" ng-model=headingfile"+scope.countheading+"><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addweblinktext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countweblink++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><input type='text'  placeholder='Web Link' class='form-control'  id=text-input-wenlink-"+scope.countweblink+" ng-model=weblink"+scope.countweblink+"><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
	};
});
myApp.directive("addrssfeedtext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countrssfeed++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-"+scope.count+" push-margin'><input type='text'  placeholder='Rss Feed Link' class='form-control'  id=text-input-rssfeed-"+scope.countrssfeed+" ng-model=rssfeed"+scope.countrssfeed+"><button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
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
          
       </script>  

<?php $this->end('script')?>