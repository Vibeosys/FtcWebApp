<?php
use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>FTC Solutions</title>
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('menu.css') ?>
        <?= $this->Html->css('responsive.css') ?>
        <?= $this->Html->css('icons.css') ?>
        <?= $this->Html->css('animate.min.css') ?>
        <?= $this->Html->css('font-awesome.css') ?>
        
        
    </head>
   <body>
     <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <a href="" class="logo">
                        <?= $this->Html->image("logo.png",['style' => "width:97px; margin-top: -20px;margin-bottom: 17px;", 'class' => "logo-img"]) ?> </a>
                    </div>
                    <div class="heading-top">Admin Panel</div>
                    <!-- End Logo container-->
                    
                    <div class="menu-extras">
                        
                         <ul class="nav navbar-nav navbar-right pull-right">
                            
                          

                            <li class="dropdown">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true">
                                    <?= $this->Html->image("user.jpg",['alt' => "user-img", 'class' => "img-circle"]) ?><span >Admin </span></a>
                                <ul class="dropdown-menu animated fadeInDown pull-right">
                                    <li><a href=""><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>
            <!-- End topbar -->


            <!-- Navbar Start -->
            <div class="navbar-custom">
                <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
					 <li class="has-submenu ">
                            <a href="" ><i class="fa fa-home icon-text-dash"></i>Home</a>
                        </li>
                        <li class="has-submenu active">
                            <a href="page.html" class="active-menu" ><i class="fa fa-newspaper-o icon-text-dash"></i>Custom Pages</a>
                        </li>
                        <li class="has-submenu">
                            <a href="user.html" ><i class="fa fa-server icon-text"></i>User Management</a>
                        </li>
                         <li class="has-submenu">
                            <a href="#" ><i class="fa fa-picture-o icon-text"></i>Gallery</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fa fa-bell-o icon-text"></i>Notification</a>
                            <ul class="submenu">
                                <li><a href="email-notify.html">Email Notification</a></li>
                                <li><a href="components-widgets.html">APP Notification</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#" class="active-menu"><i class="fa fa-database icon-text"></i>Database</a>
                        </li>
                    </ul>
                    <!-- End navigation menu -->
                </div>
            </div>
            </div>
        </header>
        <!-- End Navigation Bar-->
        <?php 
        if($this->fetch('content')){
            echo $this->fetch('content');
        }
        ?>
        <!-- jQuery  -->
        <?= $this->Html->script('jquery.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>
        <?= $this->Html->script('http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js') ?>
       
       
      <script type='text/javascript'>

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
   <?php if($this->fetch('script')){ echo $this->fetch('script');}?>

    </body>
</html>