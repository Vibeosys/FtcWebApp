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
?>
<?php $this->start('css');?>
   <?= $this->Html->css('datatables/jquery.dataTables.min.css') ?>
   <?= $this->Html->css('datatables/buttons.bootstrap.min.css') ?>
   <?= $this->Html->css('datatables/responsive.bootstrap.min.css') ?>


<?php $this->end('css');?>

<section class="page-section">
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>Clients</h2>
                    
                    </div>
                 <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                                <th>Subscription Id</th>
                              <th>User Name</th>
                              <th>Email</th>
                              <th>Phone No</th>
                              <th>License No</th>
                              <th>Expiry Date</th>
                            <th>Owner</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>1234</td>
                              <td>ABC</td>
                              <td>abc@gmail.com</td>
                              <td>1234567890</td>
                              <td> 12345tryfgferw34567</td>
                                <td>9/16/2016</td>
                             <td>ABCD</td>
                             
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
         
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
})     
 </script>
<?php $this->end('script');?>