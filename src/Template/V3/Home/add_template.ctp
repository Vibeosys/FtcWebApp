
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
    $this->assign('title', 'Add Template');
    $this->assign('notes','1');
    
?>
<?php $this->start('css');?>
   <?= $this->Html->css('editor.css') ?>
<?php $this->end('css');?>

 <section class="page-section" >
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                    <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control" value="Template">
                            </lable>
                        </div>
                   </div>
                   
                   <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template   
                           <textarea id="txtEditor"></textarea> 
                            </lable>
                            
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"><input type="button" value="Cancel" class="btn cancel">
                </div>
                   
                  
                </div>
            
            </div>
           </div>
           
       </section>

<?php $this->start('script');?>
   <?= $this->Html->script('editor.js') ?>

<script type="text/javascript">
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		</script>
<?php $this->end('script');?>