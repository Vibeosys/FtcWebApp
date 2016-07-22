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
                        <li class="tabs-1"><i class="fc_icons fa fa-plus "></i> <span class="tabs-text">Add New</span></li>
                     <?php if(isset($temps)) {$i = 2; foreach ($temps as $temp)  {?>
                        <li id="<?= $temp->templateId ?>"  class="tabs-<?= $i ?>"><i class="fc_icons fa fa-envelope"></i> <span class="tabs-text"><?= $temp->name ?></span></li>
                     <?php $i++; }} ?>
                    </ul>
                    <div class="resp-tabs-container hor_1 ">
                        <div class="fc-tab-1">
                               <form action="emailnotification" method="post">
                          
                            <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text" id="page" name="page" placeholder="" required/>
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Template Name</span>
                    </label>
                     <?php if(isset($message)){ ?>

                                <span class="fadeOut" style="font-size: 14px;border: 2px solid <?= $color ?>;padding: 0px 26px;position:absolute;top:1px;margin-left: 7%;color:<?= $color ?>"><?= $message ?> 
                                </span>
                                <!-- <a   style="border: 1px solid;padding: 10px;margin-left: 7%;text-decoration: none;" href="../database"> Back to List</a> -->
                    <?php } ?>
                </span> 
                          <!--  <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Add"><i class="fa fa-plus"></i></a>-->
                         
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
                                                 <textarea style="height:250px" id="edtextarea" name="template"></textarea>
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
                                    <input id="save" name="save" type="submit" value="Save" class="btn btn-info">
                                    <input type="button" value="Cancel" class="btn cancel send_cancel">
                                </div>
                            </form>
                        </div>
                        <?php if(isset($temps)) {$i = 2; foreach ($temps as $temp)  {?> 
                      
                        <div class="fc-tab-2">
                         <form action="emailnotification" method="post">  
                             <input type="hidden" name="id" value="<?= $temp->templateId ?>">
                            <h2 id="title_h2_<?= $temp->templateId ?>" class="title_contanier"><?= $temp->name ?></h2>
                            <span style="display:none" id="name_text_<?= $temp->templateId ?>"  class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" value="<?= $temp->name ?>" type="text" id="name_<?= $temp->templateId ?>" name="name" placeholder="" required/>
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1"  for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Template Name</span>
                    </label>
                </span> 
                            <a href="#"  class="edit-template" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i>
                                <span id="op_show_<?= $temp->templateId ?>" class="text-icon">Edit</span></a>
                            
                                <div class="email-outer">
                                    <div class="email-inner">
                                        <div class="template-view" id="temp_show_<?= $temp->templateId ?>">
                                            <lable class="push-top">Template Body
                                                <div  class="template-code template margin10"> 
                                             <?= $temp->body ?>
                                                </div>
                                            </lable>
                                        </div>
                                        <lable class="push-top" style="display: none" id='editor_<?= $temp->templateId ?>' >Template Body 
                                            <div class="margin10" >
                                                <textarea style="height:250px" name="template" id='txtEditor_<?= $temp->templateId ?>'>
                                             <?= $temp->body ?>
                                                </textarea>
                                            </div>
                                        </lable>
                                        <lable id='recip_<?= $temp->templateId ?>' class="push-top">Recipients
                                            <div class="margin10">
                                                <div id="contact_list_<?= $temp->templateId ?>" class="contact-list-div">
                                                 
                                                </div>
                                                
                                            </div>
                                        </lable>
                                    </div>
                                </div>
                                <div id="button_send_<?= $temp->templateId ?>" class="btn-email-send">
                                    <input name="send" type="submit" value="Send" class="btn btn-info">
                                    <input type="button" value="Cancel" class="btn cancel send_cancel">
                                </div>
                            <div style="display:none" id="button_save_<?= $temp->templateId ?>" class="btn-email-send">
                                <input name="edit" type="submit" value="Save" class="btn btn-info">
                                    <input type="button" value="Cancel" class="btn cancel save_cancel">
                                </div>
                             </form>
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
<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Customers</h4>

            </div>
            <div class="scrollbar" id="style-1">
            <div class="modal-body">
               <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                           <div class="user-list">
                                    <ul ng-controller="MainCtrl">
                                        <li class="check-all user-main">
                                            <input type="checkbox" name="all" id="all"/>
                                            All
                                        </li>
                                         <li class="check-all user-main">
                                            <input type="checkbox" name="subscribers" id="sub" />
                                            Subscribers
                                        </li>
                                         <li class="check-all user-main">
                                             <input type="checkbox" name="non_subscribers" id="non_sub" />
                                            Non Subscribers
                                        </li>
                                         <li class="check-all user-main">
                                             <input type="checkbox" name="direct_client" id="indirect" />
                                          Indirect Clients
                                        </li>
                                          <li class="check-all user-main">
                                              <input type="button"  value="Find" id="find" class="btn btn-info"/>
                                              <img id="note_loader" src="../img/log_loader.gif" alt="Please Wait">
                                        </li>
                                        <div><hr></div>
                <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                            <th>Select</th>
                              <th>Name</th>
                                <th>Email Id</th>
                              
                            </tr>
                          </thead>
                          <tbody id="user_list">
                        
                          </tbody>
                        </table>
                                    </ul>

                                </div>               
                      </div>
                 
                    
                    <div class="modal-footer">
                        <input type="text" style="display: none" id="count">
                        <input type="button" data-dismiss="modal" aria-hidden="true" value="OK" class="btn btn-info" id="select">
                    </div>
                </div>
               </div>
            </div>
         </div>
        </div> 
     </div> 

<?php $this->start('script');?>
 <?= $this->Html->script('tab/easyResponsiveTabs.js') ?>
   <?= $this->Html->script('tab/tabs.js') ?>
<?= $this->Html->script('//cdn.tinymce.com/4/tinymce.min.js') ?>
<script type="text/javascript">
    function diable_prev(id) {
              
        jQuery('.edit-template i.fa').addClass('fa-pencil');
        jQuery('.edit-template i.fa').removeClass('fa-close');
        jQuery('.save-template').addClass('edit-template');
        jQuery('.save-template').removeClass('edit-template');
             jQuery('#op_show_' + id).text('Edit');
        //to show
        jQuery('#temp_show_' + id).css('display', 'block');
        jQuery('#title_h2_' + id).css('display', 'block ');
        jQuery('#button_send_' + id).css('display', 'block ');
        jQuery('#recip_' + id).css('display', 'block');
        // to hide
        jQuery('#name_text_' + id).css('display', 'none');
        jQuery('#editor_' + id).css('display', 'none');
        jQuery('#button_save_' + id).css('display', 'none');
        
        //jQuery('.user_btn_' + id).attr('disabled','disabled');
        jQuery('#pre_act').val('');
    }
    function removeme(id, event){
        jQuery(id).parent().remove();
        event.preventDefault();
        return false;
    }
  
jQuery(document).ready(function() {
	tinymce.init({ selector:'#edtextarea' });
      <?php if(isset($temps)) { foreach ($temps as $temp)  { ?>
        tinymce.init({ selector:'#txtEditor_<?= $temp->templateId ?>' });      
      <?php }} ?>    
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
            jQuery('.edit-template i.fa').removeClass('fa-pencil');
            jQuery('.edit-template i.fa').addClass('fa-close');
           // jQuery(this).addClass('save-template');
            //jQuery(this).removeClass('edit-template');
            //to hide
            jQuery('#op_show_' + id).text('Cancel');
            jQuery('#temp_show_' + id).css('display', 'none');
            jQuery('#title_h2_' + id).css('display', 'none');
            jQuery('#button_send_' + id).css('display', 'none');
            jQuery('#recip_' + id).css('display', 'none');
            // to show
            jQuery('#name_text_' + id).css('display', 'block');
            jQuery('#editor_' + id).css('display', 'block');
            jQuery('#button_save_' + id).css('display', 'block');
            //jQuery('#add_' + id).css('display', 'inline-block');
           // jQuery('.user_btn_' + id).removeAttr('disabled');
        });
		
        jQuery('.save_cancel').on('click', function(e){
            var check =  jQuery('#pre_act').val();
            if(check > 0){
               diable_prev(check);
               e.preventDefault();
               return false;
           }  
        });
         jQuery('.send_cancel').on('click', function(e){
            // jQuery('.VerticalTab ul li').removeClass('resp-tab-active');
             //jQuery('.VerticalTab ul li.tabs-1').addClass('resp-tab-active');
             window.location.replace('../../');
               e.preventDefault();
               return false;
        });
        
        jQuery('.VerticalTab ul li').on('click',function(e){
            var pre_id = jQuery('#pre_act').val();
            if(pre_id > 0){
            diable_prev(pre_id);
        }
        });
        
        jQuery('.remove_me').on('click', function(event){
            var a = confirm('Are you sure?');
            if(a){
                jQuery(this).parent().remove();
            }
            event.preventDefault();
            return false;
        });
        // user selection
        
        jQuery('#find').on('click', function(){
            var cur_id = jQuery(this).attr('id');
         jQuery(this).val('Wait');
         jQuery('#note_loader').css('display','inline-block');
         var check_all = jQuery('#all').is(':checked');
         var check_sub = jQuery('#sub').is(':checked');
         var check_non_sub = jQuery('#non_sub').is(':checked');
         var check_indirect = jQuery('#indirect').is(':checked');
         var url = 'getuserlist';
         var param = '{"all":"'+ check_all +'","sub":"'+ check_sub +'","non_sub":"'+ check_non_sub +'","indirect":"'+ check_indirect +'"}';
        jQuery.ajax({
                type: "post",
                url: url,
                data: param,
                contentType: "application/json; charset=utf-8",
                dataType: "json",  
                success: function(data){
                    jQuery('#note_loader').css('display','none');
                    jQuery('#find').val('Find');
                    var i = 0;
                    var html = '';
                 jQuery.each(data, function(key,json){
                      html += '<tr><td>' + 
                                '<input id="select_'+ i +'" type="checkbox"></td>'+
                               
                              '<td id="user_name_'+ i +'" >'+json.fullName +'</td>' +
                                '<td id="user_email_'+ i +'" >'+json.email +'</td></tr>';
                     i = i + 1; 
                    
                  });
                  jQuery('#count').val(i);
                jQuery('#user_list').html(html);
                    
                },
                failure: function(errMsg) {
                   alert(errMsg); 
                   jQuery('#note_loader').css('display','none');
                   jQuery('#find').val('Find');
                }
        });
     });
     
      jQuery('#select').on('click', function(event){
        var count = jQuery('#count').val();
        var user_list = '';
        var i = 0;
        for(i = 0; i < count; i++){
            if(jQuery('#select_'+i).is(':checked')){
            var name = jQuery("#user_name_"+i).text();
            var email =jQuery("#user_email_"+i).text();
          //  var gcm = $("#user_gcm_"+i).val();
            var client = i + 1;
          user_list += '<div class="user-list-preview">'+name +
                        '<input type="hidden" name="email-'+ client +'" value="'+ email +'">'+
                        '<button onclick="removeme(this, event);" class="remove_me" ><span class="fa fa-close"></span></button></div>';
        }}
      
       var cur_id = jQuery('.resp-tab-active').attr('id');
         //alert(cur_id);
        jQuery('#contact_list_'+ cur_id).html(user_list);
        jQuery('#myModel').css('display','none');
     });
     

        jQuery('.fadeOut').fadeOut(10000);
    });
  
</script>
<?php $this->end('script');?>