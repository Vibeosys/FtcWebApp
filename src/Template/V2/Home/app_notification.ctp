
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
    $this->assign('title', 'App Notification');
    $this->assign('notes','1');
    $this->assign('AN','1');
    
?>

<section class="page-section" >
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>App Notification</h2>
                    
                    </div>
                    
                   
                   <div class="email-outer">
                        <div class="email-inner">
                            <lable>Message 
                            <textarea rows='15'  class='form-control margin10'  id="html-template"></textarea>
                            </lable>
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                           <div class="contact-list-div">
                                <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User5 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User6 <button><span class="fa fa-close"></span></button></div>  
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User5 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User6 <button><span class="fa fa-close"></span></button></div>   
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User5 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User6 <button><span class="fa fa-close"></span></button></div>   
                                <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User5 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User6 <button><span class="fa fa-close"></span></button></div>   
                                <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User5 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User6 <button><span class="fa fa-close"></span></button></div>   
                                <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User5 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User6 <button><span class="fa fa-close"></span></button></div>   
                               
                            </div>
                            <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                            
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"> <input type="button" value="Cancel" class="btn cancel">
                </div>
                </div>
               
            
                 
               
                
            
            </div>
           </div>
           
       </section>

<div id="myModal" class="modal animated zoomin" ng-app="myApp" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Customers</h4>

            </div>
            <div class="scrollbar" id="style-1">
            <div class="modal-body">
               <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                           <div class="user-list">
                                    <ul ng-controller="MainCtrl">
                                        <li class="check-all user-main">
                                            <input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" />
                                            All
                                        </li>
                                         <li class="check-all user-main">
                                            <input type="checkbox" ng-model="selectedSubscribe" ng-click="checkSubscribe()" />
                                            Subscribers
                                        </li>
                                         <li class="check-all user-main">
                                            <input type="checkbox" ng-model="selectedNonSubscribe" ng-click="checkNonSubscribe()" />
                                            Non Subscribers
                                        </li>
                                         <li class="check-all user-main">
                                            <input type="checkbox" ng-model="selecteddirectclient" />
                                           Direct Clients
                                        </li>
                                          <li class="check-all user-main">
                                            <input type="button"  value="Find" class="btn btn-info"/>
                                        </li>
                                        <div><hr></div>
                <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                            <th>Select</th>
                              <th>Name</th>
                                <th>Email Id</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          

                          </tbody>
                        </table>
                                       <!-- <li ng-repeat="item in Items">
                                            <label>
                                                <input type="checkbox" ng-model="item.Selected" />
                                                {{item.Name}}
                                            </label>
                                        </li>
                                        <li ng-repeat="item in Itemssub">
                                            <label>
                                                <input type="checkbox" ng-model="item.Selected" />
                                                {{item.Name}}
                                            </label>
                                        </li>
                                        <li ng-repeat="item in Itemsnonsub">
                                            <label>
                                                <input type="checkbox" ng-model="item.Selected" />
                                                {{item.Name}}
                                            </label>
                                        </li>-->
                                    </ul>

                                </div>               
                      </div>
                 
                    
                    <div class="modal-footer">
                        
                    </div>
                </div>
               </div>
            </div>
         </div>
        </div> 
     </div> 

<?php $this->start('script');?>
<?= $this->Html->script('datatables/responsive.bootstrap.min.js') ?>

 <script type="text/javascript">
       
      
       angular.module("myApp", [])
    .controller("MainCtrl", function checkboxController($scope) {


    
           
    $scope.Itemssub = [{
        Name: "Subscribe 3"
    }, {
        Name: "Subscribe 4"
    } ];
   
    $scope.Itemsnonsub = [{
        Name: "Non Subscribe 5"
    }, {
        Name: "Non Subscribe 6"
    } ];
           
    $scope.checkAll = function () {
        if ($scope.selectedAll) {
            $scope.selectedAll = false;
        } else {
            $scope.selectedAll = true;
        }
        angular.forEach($scope.Itemssub, function (item) {
            item.Selected = $scope.selectedAll;
        });
         angular.forEach($scope.Itemsnonsub, function (item) {
            item.Selected = $scope.selectedAll;
        });
        
    };
   
    $scope.checkSubscribe = function () {
        if ($scope.selectedSubscribe) {
            $scope.selectedSubscribe = false;
        } else {
            $scope.selectedSubscribe = true;
        }
        angular.forEach($scope.Itemssub, function (item) {
            item.Selected = $scope.selectedSubscribe;
        });

    };
         
    $scope.checkNonSubscribe = function () {
        if ($scope.selectedNonSubscribe) {
            $scope.selectedNonSubscribe = false;
        } else {
            $scope.selectedNonSubscribe = true;
        }
        angular.forEach($scope.Itemsnonsub, function (item) {
            item.Selected = $scope.selectedNonSubscribe;
        });

    };

});
       
       </script>
<?php $this->end('script');?>