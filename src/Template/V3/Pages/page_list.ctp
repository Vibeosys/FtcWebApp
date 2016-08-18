<?php
use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    use Cake\View\ViewBuilder;
    use Cake\View\Helper\UrlHelper;
  
    $this->layout = $layout;
    $this->assign('title', 'Custom Pages');
     $this->assign('page_list','1');
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
                        <h2>Draft Pages</h2>
                     <ul class="nav navbar-right panel_toolbox">
                    <li><a href="/pages/page"><i class="fa fa-plus-circle"></i> Add New Page</a>
                    </li>
                  </ul>
                    </div>
                   <?php if(isset($pages)){ $i = 1; ?>
                 <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Draft No</th>
                              <th>Title</th>
                              <th>Last Updated</th>
                              <th>Page Type</th>
                            <th>Status</th>
                            <?php if(isset($role) and $role){ ?>
                            <th>Page For</th>
                            <?php } ?>
                            <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php  foreach ($pages as $page){ ?>   
                          
                              <tr>
                            <form action="../pages/edit" method="post">      
                                  <td><?= $i++ ?><input type="hidden" value="<?= $page->pageId ?>" name="pageId" ></td>
                              <td><?= $page->pageTitle ?></td>
                              <td><?= $page->updatedDate ?><input type="hidden" value="<?= $page->status ?>" name="pageStatus" ></td>
                              <td><?php $key = $page->pageType; echo $type->$key; ?><input type="hidden" value="<?= $page->pageType ?>" name="pageStatus" ></td>
                              <?php if($page->status) {?>
                              <td>Published</td>
                              <?php }else {?>
                              <td>UnPublished</td>
                              <?php } ?>
                              <?php if(isset($role) and $role and $page->pageFor){ ?>
                                <th>Subscriber Only</th>
                                <?php }else if(isset($role) and $role){ ?>
                                  <th>For All</th>
                                <?php }?>
                              <td>
                                  <button type="submit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" name="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                              </button>
                              </td>
                               </form>
                            </tr>
                           <?php  } ?>   
                          </tbody>
                        </table>
                   <?php  } ?>   
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
})     
 </script>
<?php $this->end('script');?>