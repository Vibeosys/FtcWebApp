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
   <?= $this->Html->css('tab/tabs.css') ?>
   <?= $this->Html->css('tab/easy-responsive-tabs.css') ?>
   <?= $this->Html->css('editor.css') ?>

<?php $this->end('css');?>



		<!-- Begin HorizontalTab style 1 -->
		<section class="page-section">

			<div class="container">

				<div class="row">

					<div class="col-md-12 main-content">
						
						<!-- Begin .HorizontalTab -->
						<div class="VerticalTab fc_VerticalTab VerticalTab_1 tabs_ver_1">
						      
							<ul class="resp-tabs-list hor_1">
                                <h2 class="text-center">Templates</h2>
								<li class="tabs-1"><i class="fc_icons fa fa-envelope "></i> <span class="tabs-text">Invitation message for new users</span></li>
								<li class="tabs-2"><i class="fc_icons fa fa-envelope"></i> <span class="tabs-text">Welcome message for subscribers</span></li>
								<li class="tabs-3"><i class="fc_icons fa fa-envelope"></i> <span class="tabs-text">Template 3</span></li>  
								<li class="tabs-4"><i class="fc_icons fa fa-envelope"></i> <span class="tabs-text">Template 4</span></li>
								<li class="tabs-5"><i class="fc_icons fa fa-envelope"></i> <span class="tabs-text">Template 5</span></li>
							</ul>
							
							<div class="resp-tabs-container hor_1 ">
								
								<div class="fc-tab-1">
								
									<h2 class="title_contanier">Invitation message for new users</h2>
                                   
									<a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                                     <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Add"><i class="fa fa-plus"></i></a>
									 <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control template-name" value="Template">
                            </lable>
                        </div>
                                     <div class="email-outer">
                        <div class="email-inner">
                            <div class="template-view">
                            <lable>Template   
                            <div class="template-code template"> 
                                <h2>Hello,</h2>
                                <p>hi how r u?</p>
                            </div>
                            </lable>
                                </div>
                            
                            
                             <lable>Template  
                            <div id="editor">
                              <div id='edit'>
                              </div>
                            </div>
                            </lable>
                    
                            
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                           <div class="contact-list-div">
                                <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                          
                               
                            </div>
                                    <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"><input type="button" value="Cancel" class="btn cancel">
                </div>
								</div>
								
								<div class="fc-tab-2">
								
									<h2 class="title_contanier">Welcome message for subscribers</h2>
									<a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
									 <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control template-name" value="Template">
                            </lable>
                        </div>
                                     <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template   
                            <textarea rows='15'  class='form-control margin10 template'  id="html-template" disabled>
                              
                                
                                
                                </textarea>
                            </lable>
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                           <div class="contact-list-div">
                                <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                          
                               
                            </div>
                                    <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"><input type="button" value="Cancel" class="btn cancel">
                </div>
								</div>
								
								<div class="fc-tab-3">
								
									<h2 class="title_contanier">Template 3</h2>
									<a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
									 <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control template-name" value="Template">
                            </lable>
                        </div>
                                     <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template   
                            <textarea rows='15'  class='form-control margin10 template'  id="html-template" disabled></textarea>
                            </lable>
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                           <div class="contact-list-div">
                                <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                          
                               
                            </div>
                                    <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"><input type="button" value="Cancel" class="btn cancel">
                </div>
								</div>
								
								<div class="fc-tab-4">
								
									<h2 class="title_contanier">Template 4</h2>
									<a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
									 <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control template-name" value="Template">
                            </lable>
                        </div>
                                     <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template   
                            <textarea rows='15'  class='form-control margin10 template'  id="html-template" disabled></textarea>
                            </lable>
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                           <div class="contact-list-div">
                                <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                          
                               
                            </div>
                                    <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"><input type="button" value="Cancel" class="btn cancel">
                </div>
								</div>
								
								
								<div class="fc-tab-5">
								
									
									<h2 class="title_contanier">Template 5</h2>
									<a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
									 <div class="email-inner">
                            <lable>Template Name
                            <input type="text" class="form-control template-name" value="Template">
                            </lable>
                        </div>
                                     <div class="email-outer">
                        <div class="email-inner">
                            <lable>Template   
                            <textarea rows='15'  class='form-control margin10 template'  id="html-template" disabled></textarea>
                            </lable>
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                           <div class="contact-list-div">
                                <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                          
                               
                            </div>
                                    <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                    <input type="button" value="Send" class="btn btn-info"><input type="button" value="Cancel" class="btn cancel">
                </div>
								</div>
								
								
							</div>
						</div>
						<!-- End .HorizontalTab -->
					
					</div>
					
				</div>
				
			</div>

		</section>
		<!-- End HorizontalTab style 1 -->





<?php $this->start('script');?>

                            
 <?= $this->Html->script('tab/easyResponsiveTabs.js') ?>
   <?= $this->Html->script('tab/tabs.js') ?>

   <?= $this->Html->script('editor.js') ?>

   <?= $this->Html->script('editor/align.min.js') ?>
   <?= $this->Html->script('editor/char_counter.min.js') ?>
   <?= $this->Html->script('editor/code_beautifier.min.js') ?>
   <?= $this->Html->script('editor/code_view.min.js') ?>
   <?= $this->Html->script('editor/colors.min.js') ?>
   <?= $this->Html->script('editor/entities.min.js') ?>
   <?= $this->Html->script('editor/font_family.min.js') ?>
   <?= $this->Html->script('editor/font_size.min.js') ?>
   <?= $this->Html->script('editor/line_breaker.min.js') ?>
   <?= $this->Html->script('editor/link.min.js') ?>
   <?= $this->Html->script('editor/lists.min.js') ?>
   <?= $this->Html->script('editor/paragraph_format.min.js') ?>
   <?= $this->Html->script('editor/paragraph_style.min.js') ?>
   <?= $this->Html->script('editor/table.min.js') ?>
   <?= $this->Html->script('editor/url.min.js') ?>


  <script type="text/javascript">
    jQuery(document).ready(function(){
    
        
       jQuery('#edit').froalaEditor({
        iframe: true
      })
    });

    
  </script>
<?php $this->end('script');?>