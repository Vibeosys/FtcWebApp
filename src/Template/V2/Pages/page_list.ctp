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
    $this->assign('title', 'page_list');
     $this->assign('page_list','1');
?>

<section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>Draft Pages</h2>
                    
                    </div>
                 <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Draft No</th>
                              <th>Custom Page Name</th>
                              <th>Title</th>
                              <th>Last Updated</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td><a href="../pages/page">Page 1</a></td>
                              <td>News/Blog</td>
                              <td>5/17/2016</td>
                                <td>Published</td>
                             <td>
                                    <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                </td>
                             
                            </tr>
                          
<tr>
                              <td>2</td>
                               <td><a href="../pages/page">Page 2</a></td>
                              <td>About Us</td>
                              <td>6/11/2016</td>
                                <td>Published</td>
                             <td>
                                    <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                </td>
                             
                            </tr>
                          
<tr>
                              <td>3</td>
                                <td><a href="../pages/page">Page 3</a></td>
                              <td>How it works?</td>
                              <td>6/17/2016</td>
                                <td>Published</td>
                             <td>
                                    <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                </td>
                             
                            </tr>
                          
<tr>
                              <td>4</td>
                              <td><a href="../pages/page">Page 4</a></td>
                              <td>No Name 01</td>
                              <td>6/17/2016</td>
                                <td>Not Published</td>
                             <td>
                                    <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                </td>
                             
                            </tr>
                          

                          </tbody>
                        </table>
                </div>
               
            
                 
               
                
            
            </div>
           </div>
           
       </section>

<?php $this->start('script')?>
<!-- <script type='text/javascript'>

var myApp = angular.module('myApp', []);

function MainCtrl($scope) {
    $scope.count = 0;
	$scope.countfile = 0;
    $scope.counttext = 0;
    $scope.countlinktext = 0;
    $scope.countvideolink = 0;
    $scope.countheading = 0;
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

//Directive for adding buttons on click that show an alert on click
myApp.directive("addbuttons", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countfile++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class=remove-"+scope.count+"><input type='file' class='form-control' ng-model=myFile"+scope.countfile+" file id=file-input-"+scope.countfile+" accept='image/*'><button name='Privew' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
           
	};
});
myApp.directive("addtextdiv", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.counttext++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class=remove-"+scope.count+"><textarea rows='4' placeholder='Text' class='form-control'  id=text-input-"+scope.counttext+" ng-model=textfile"+scope.count+"></textarea><button name='Privew' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
             
	};
});
myApp.directive("addlinktext", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countlinktext++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class=remove-"+scope.count+"><div style='display:flex'>Link<input type='text'  placeholder='Link' class='form-control link-input'  id=text-input-link-"+scope.countlinktext+" ng-model=linkfile"+scope.countlinktext+"> Link Caption<input type='text' placeholder='Link Caption' class='form-control link-input'  id=text-input-cap-link-"+scope.countlinktext+" ng-model=capfile"+scope.countlinktext+"></div> <button name='Privew' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
        
	};
});
myApp.directive("addvideolink", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countvideolink++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class=remove-"+scope.count+"><div style='display:flex'>Video Link<input type='text'  placeholder='Video Link' class='form-control'  id=text-input-video-"+scope.countvideolink+" ng-model=videolinkfile"+scope.countvideolink+"></div> <button name='remove' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
             var count = $('#itemcount').val();
            
});

myApp.directive("addheadinglink", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
            scope.count++;
			scope.countheading++;
			angular.element(document.getElementById('space-for-tool')).append($compile("<div class=remove-"+scope.count+"><input type='text'  placeholder='Heading' class='form-control'  id=text-input-head-"+scope.countheading+" ng-model=headingfile"+scope.countheading+"><button name='Privew' class='btn-remove' id=remove-"+scope.count+" remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            
		});
            var count = $('#itemcount').val();
            count++;
                $('#itemcount').val(count);
	};
});
//Directive for showing an alert on click
       /*
myApp.directive("file", function($compile){
	return function(scope, element, attrs){
		element.bind("change", function(){
			
            angular.element(document.getElementById('privew-for-tool')).append($compile("<img ng-src="{{image_source}}"><br>")(scope));
		});
	};
});
*/
myApp.directive("removeMe", function($rootScope) {
      return function(scope,element,attrs)
            {
                element.bind("click",function() {
                    var id= attrs['id'];
                   
                   $("."+id).remove();
                   $('#itemcount').val(scope.count);
                });
            }
          
      
});
myApp.directive("additems", function($rootScope) {
      return function(scope,element,attrs)
            { 
                var count = $('#itemcount').val();
                    count++;
                $('#itemcount').val(count);
            }
           
      
});
          
       </script>  


-->

<?php $this->end('script')?>