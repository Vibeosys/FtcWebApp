
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

 <section class="page-section" >
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                    <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control template-name" value="Template">
                            </lable>
                        </div>
                   </div>
                   
                   <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template   
                            <textarea rows='15'  class='form-control margin10 template'  id="html-template" ></textarea>
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