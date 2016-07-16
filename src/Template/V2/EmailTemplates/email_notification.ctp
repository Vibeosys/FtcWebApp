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
                        <li class="tabs-1"><i class="fc_icons fa fa-envelope "></i> <span class="tabs-text">Add New</span></li>
                     <?php if(isset($temps)) {$i = 2; foreach ($temps as $temp)  {?>
                        <li id="<?= $temp->templateId ?>"  class="tabs-<?= $i ?>"><i class="fc_icons fa fa-envelope"></i> <span class="tabs-text"><?= $temp->name ?></span></li>
                     <?php $i++; }} ?>
                    </ul>
                    <div class="resp-tabs-container hor_1 ">
                        <div class="fc-tab-1">
                            <h2 class="title_contanier">New Template
                             <?php if(isset($message)){ ?>

                                <span class="fadeOut" style="font-size: 14px;border: 2px solid <?= $color ?>;padding: 10px;margin-left: 7%;color:<?= $color ?>"><?= $message ?> 
                                </span>
                                <!-- <a   style="border: 1px solid;padding: 10px;margin-left: 7%;text-decoration: none;" href="../database"> Back to List</a> -->
                    <?php } ?></h2>
                            <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Add"><i class="fa fa-plus"></i></a>
                            <form action="emailnotification" method="post">
                                <div class="email-inner">
                                    <lable>Template Name
                                        <input name="name" type="text" class="form-control template-name" placeholder="Template Title">
                                    </lable>
                                </div>
                                <div class="email-outer">
                                    <div class="email-inner">
                                        <div class="template-view" style="display: none">
                                            <lable>Template   
                                                <div id="temp_show_new" class="template-code template"> 
                                                    <h2>Hello,</h2>
                                                    <p>hi how r u?</p>
                                                </div>
                                            </lable>
                                        </div>
                                        <lable>Template  
                                            <div>
                                                <textarea name="template" id='edit_new'>
                                                </textarea>
                                            </div>
                                        </lable>
                                        <!--  <lable class="push-top">Recipients
                                              <div class="margin10">
                                                  <div class="contact-list-div">
                                                      <div class="user-list-preview">User1 <button><span class="fa fa-close"></span></button></div>        
                                                      <div class="user-list-preview">User2 <button><span class="fa fa-close"></span></button></div>        
                                                      <div class="user-list-preview">User3 <button><span class="fa fa-close"></span></button></div>        
                                                      <div class="user-list-preview">User4 <button><span class="fa fa-close"></span></button></div>        
                                                  </div>
                                                  <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                              </div>
                                          </lable>  -->
                                    </div>
                                </div>
                                <div class="btn-email-send">
                                    <input id="save" type="submit" value="Save" class="btn btn-info">
                                    <input type="button" value="Cancel" class="btn cancel">
                                </div>
                            </form>
                        </div>
                        <?php if(isset($temps)) {$i = 2; foreach ($temps as $temp)  {?> 
                        <div class="fc-tab-2">
                            <h2 class="title_contanier"><?= $temp->name ?></h2>
                            <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                            <form >   
                                <div class="email-inner" style="display: none" id="name_text_<?= $temp->templateId ?>">
                                    <lable>Template Name
                                        <input type="text" id="name_<?= $temp->templateId ?>" class="form-control template-name" value="<?= $temp->name ?>">
                                    </lable>
                                </div>
                                <div class="email-outer">
                                    <div class="email-inner">
                                        <div class="template-view" id="temp_show_<?= $temp->templateId ?>">
                                            <lable>Template   
                                                <div  class="template-code template"> 
                                             <?= $temp->body ?>
                                                </div>
                                            </lable>
                                        </div>
                                        <lable style="display: none" id='editor_<?= $temp->templateId ?>' >Template  
                                            <div >
                                                <textarea name="template" id='edit_<?= $temp->templateId ?>'>
                                             <?= $temp->body ?>
                                                </textarea>
                                            </div>
                                        </lable>
                                        <lable class="push-top">Recipients
                                            <div class="margin10">
                                                <div class="contact-list-div">
                                                    <div class="user-list-preview">User1 <button class="user_btn_<?= $temp->templateId ?>" disabled><span class="fa fa-close"></span></button></div>        
                                                    <div class="user-list-preview">User2 <button class="user_btn_<?= $temp->templateId ?>" disabled><span class="fa fa-close"></span></button></div>        
                                                    <div class="user-list-preview">User3 <button class="user_btn_<?= $temp->templateId ?>" disabled><span class="fa fa-close"></span></button></div>        
                                                    <div class="user-list-preview">User4 <button class="user_btn_<?= $temp->templateId ?>" disabled><span class="fa fa-close"></span></button></div>        
                                                </div>
                                                <a id="add_<?= $temp->templateId ?>" style="display:none" class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                                            </div>
                                        </lable>
                                    </div>
                                </div>
                                <div id="button_<?= $temp->templateId ?>" style="display:none" class="btn-email-send">
                                    <input type="button" value="Send" class="btn btn-info">
                                    <input type="button" value="Cancel" class="btn cancel">
                                </div>
                        </div>
                       <?php $i++; }} ?>      
                    </div>
                </div>
                <!-- End .HorizontalTab -->
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="pre_act" value="">

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
    function diable_prev(id) {
              
        jQuery('.edit-template').children().addClass('fa-pencil');
        jQuery('.edit-template').children().removeClass('fa-save');
        jQuery('.save-template').addClass('edit-template');
        jQuery('.save-template').removeClass('edit-template');
        //to hide
        jQuery('#temp_show_' + id).css('display', 'block');
        // to show
        jQuery('#name_text_' + id).css('display', 'none');
        jQuery('#editor_' + id).css('display', 'none');
        jQuery('#button_' + id).css('display', 'none');
        jQuery('#add_' + id).css('display', 'none');
        jQuery('.user_btn_' + id).attr('disabled','disabled');
        jQuery('#pre_act').val('');
    }

    jQuery(function () {
        jQuery('#edit_new').froalaEditor({toolbarInline: false})
     <?php if(isset($temps)) {$i = 2; foreach ($temps as $temp)  {?>
        jQuery('#edit_<?= $temp->templateId ?>').froalaEditor({toolbarInline: false})
      <?php $i++; }} ?>

    });

    jQuery(document).ready(function () {    

        jQuery('.edit-template').on('click', function (e) {
            var check =  jQuery('#pre_act').val();
            if(check > 0){
               diable_prev(check);
               e.preventDefault();
               return false;
           }  
            var id = jQuery('.resp-tab-active').attr('id');
            jQuery('#pre_act').val(id);
            
            //alert('temp_test_'+id);
            jQuery(this).children().removeClass('fa-pencil');
            jQuery(this).children().addClass('fa-save');
           // jQuery(this).addClass('save-template');
            //jQuery(this).removeClass('edit-template');
            //to hide
            jQuery('#temp_show_' + id).css('display', 'none');
            // to show
            jQuery('#name_text_' + id).css('display', 'block');
            jQuery('#editor_' + id).css('display', 'block');
            jQuery('#button_' + id).css('display', 'block');
            jQuery('#add_' + id).css('display', 'inline-block');
            jQuery('.user_btn_' + id).removeAttr('disabled');
        });
        
        jQuery('.VerticalTab ul li').on('click',function(e){
            var pre_id = jQuery('#pre_act').val();
            if(pre_id > 0){
            diable_prev(pre_id);
        }
        });

        jQuery('.fadeOut').fadeOut(10000);
    });



</script>
<?php $this->end('script');?>