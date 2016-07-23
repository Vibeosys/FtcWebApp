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
    $this->assign('title', 'Database');
    $this->assign('database','1');
    
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
                        <h2>Client Databases</h2>
                    <ul class="nav navbar-right panel_toolbox">
                 <?php if($isOwner){ ?>       
                    <li><a href="database/add"><i class="fa fa-plus-circle"></i> Add New Database</a>
                    </li>
                 <?php } ?>         
                  </ul>
                    </div>
                 <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                            <th>Subscription Id</th>
                              <th>Host Name</th>
                                <th>Database</th>
                                 <th>Owner</th>
                            <th>Action</th>
                               
                            </tr>
                          </thead>
                          <tbody>
                          <?php if (isset($dbs)) { ?>    
                          <?php foreach ($dbs as $db){ ?>    
                        
                              <tr>
                                 <form action="../database/edit" method="post"> 
                                <td><?= $db->subscriberId ?><input type="hidden" name="subscriberId" value="<?= $db->subscriberId ?>"></td>
                                <td><?= $db->hostname ?>
                                <input type="hidden" name="hostname" value="<?= $db->hostname ?>"></td>
                              <td><?= $db->dbname ?>
                              <input type="hidden" name="dbname" value="<?= $db->dbname ?>">
                              <input type="hidden" name="port" value="<?= $db->port ?>">
                              <input type="hidden" name="dbuname" value="<?= $db->dbuname ?>">
                              <input type="hidden" name="pwd" value="<?= $db->pwd ?>">
                              </td>
                              <td><?= $db->owner ?>
                                 <input type="hidden" name="owner" value="<?= $db->owner ?>"></td>
                             <td>
                                 <button type="submit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Cancel"><i class="fa fa-close fa-size"></i>
                            </button>
                                </td>
                               </form>  
                            </tr>
                       
                          <?php } } ?>

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
    }
});
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
}) ;    
 </script>
<?php $this->end('script');?>