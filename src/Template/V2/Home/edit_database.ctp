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
    $this->assign('title', 'Edit Database');
    $this->assign('database','1');
    
?>

 <section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>Edit Database</h2>
                    
                    </div>
                    
                    <form name="editDatabase" id="editDatabase" action="" method="post">
            <p>
		<label for="user_login" class="sub-id">Subscription Id<br />
		<input type="text" name="log" id="user_login" class="form-control"  size="100" value="1234" disabled /></label>
	</p>
	<p>
		<label for="user_pass">Host Name<br />
		<input type="text" name="pwd" id="user_pass" class="form-control" size="100"  value="ABC"/></label>
	</p>
    	<p>
		<label for="subscribe_id">Database Name<br />
		<input type="text" name="subscribeid" id="subscribe_id" class="form-control" size="100" value="news" /></label>
	</p>
                        <p>
		<label for="subscribe_id">Port<br />
		<input type="text" name="subscribeid" id="subscribe_id" class="form-control" size="100" value="8080" /></label>
	</p>                        
                        <p>
		<label for="subscribe_id">User Name<br />
		<input type="text" name="subscribeid" id="subscribe_id" class="form-control" size="100" value="ABCDEF" /></label>
	</p>
		
                        <p>
		<label for="subscribe_id">Password<br />
		<input type="text" name="subscribeid" id="subscribe_id" class="form-control" size="100" value="abc" /></label>
	</p>
                          <p>
		<label for="subscribe_id">Owner<br />
		<input type="text" name="subscribeid" id="subscribe_id" class="form-control" size="100" value="123 - abc@abc.com"  disabled/></label>
	</p>
    <div>
            <div class="test-btn">
                <button id="ftc-save" class="btn btn-success test" >Test Connection</button>
            </div>
            <div class="edit-database-btn text-center center-block">
                <button id="ftc-save" class="btn btn-primary db" >Save</button>
                <button id="ftc-cancel" class="btn  db">Cancel</button>
            </div>
    </div>
        </form>
                   
                   
                </div>
               
            
                 
               
                
            
            </div>
           </div>
           
       </section>