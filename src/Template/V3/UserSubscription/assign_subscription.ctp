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
    $this->assign('title', 'User Management');
    $this->assign('user_management','1');
    $this->assign('AS','1');
?>

<section class="page-section assignsubscription" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>Assign Subscription to Clients</h2>
                      <div class="assign-btn">
                    <input type="button" class="btn btn-warning" value="Assign">
                        <input type="button" class="btn" value="Cancel">
               </div>
                    </div>
                      <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                            <th class="th-width">Select</th>
                              <th>Client Name</th>
                                <th>Client Email Id</th>
                              
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
                </div>
            </div>
           </div>
       </section>