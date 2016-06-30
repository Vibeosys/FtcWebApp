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
    $this->assign('title', 'Email Notification');
    $this->assign('notes','1');
    $this->assign('EN','1');
    
?>

<?php $this->start('css');?>
   <?= $this->Html->css('datatables/jquery.dataTables.min.css') ?>
   <?= $this->Html->css('datatables/buttons.bootstrap.min.css') ?>
   <?= $this->Html->css('datatables/responsive.bootstrap.min.css') ?>


<?php $this->end('css');?>

<section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>Email Templates</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <li><a href="../emailnotification/add"><i class="fa fa-plus-circle"></i> Add New Template</a>
                    </li>
                  </ul>
                    </div>
                 <table id="menu" class="table table-striped table-bordered dt-responsive nowrap email-template" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                            <th>Template Id</th>
                              <th>Template Name</th>
                            <th>Action</th>
                               
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>1234</td>
                              <td><a href="emailnotification/edit">Welcome message for subscribers</a></td>
                             <td>
                                    <a href="emailnotification/edit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size" ></i>
                            </a>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Cancel"><i class="fa fa-close fa-size"></i>
                            </button>
                                </td>
                            
                            </tr>
                               <tr>
                                <td>123</td>
                              <td><a href="emailnotification/edit">Invitation message for new users</a></td>
                             <td>
                                    <a href="emailnotification/edit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size" ></i>
                            </a>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Cancel"><i class="fa fa-close fa-size"></i>
                            </button>
                                </td>
                            
                            </tr>
                               <tr>
                                <td>123456</td>
                              <td><a href="emailnotification/edit">Template 3</a></td>
                             <td>
                                    <a href="emailnotification/edit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size" ></i>
                            </a>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Cancel"><i class="fa fa-close fa-size"></i>
                            </button>
                                </td>
                            
                            </tr>
                          

                          </tbody>
                        </table>
                </div>
               
            
                 
               
                
            
            </div>
           </div>
           
       </section>
<?php $this->start('script');?>
   <?= $this->Html->script('datatables/jquery.dataTables.min.js') ?>
   <?= $this->Html->script('datatables/dataTables.bootstrap.js') ?>
   <?= $this->Html->script('datatables/dataTables.responsive.min.js') ?>
   <?= $this->Html->script('datatables/responsive.bootstrap.min.js') ?>

 <script type="text/javascript">
   $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#menu').DataTable();
            $('#datatable-scroller').DataTable({
              //ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
      
$(document).ready(function(){
    var heading_last=$('table.table-bordered th:last-child').text();
    if(heading_last == 'Action'){
        $('th:last-child').removeClass('sorting');
        $('th:last-child').addClass('action-width');
    }
});
$(document).ready(function(){
    var heading_last=$('table.table-bordered th:first-child').text();
    if(heading_last == 'Template Id'){
        $('th:first-child').addClass('template-width');
    }
});
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
})     
 </script>
<?php $this->end('script');?>