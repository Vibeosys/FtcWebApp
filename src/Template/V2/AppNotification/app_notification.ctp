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
    $this->assign('title', 'App Notification');
    $this->assign('notes','1');
    $this->assign('AN','1');
    
?>

<section class="page-section" >
        <div class="container">
            <div class="row">
                
               <div class="col-lg-12 main-page">
                     <div class="heading">
                        <h2>App Notification</h2>
                    <?php if(isset($message)) {?>
                        <span style="margin: 10px 7%;color:<?= $color ?>"><strong><?= $message ?></strong> </span>
                    <?php } ?>
                    </div>
                    
                   <form action="appnotification" method="post"> 
                   <div class="email-outer">
                        <div class="email-inner">
                            <p>
                              <span class="input input--hoshi input-85">
                    <input class="input__field input__field--hoshi title-input" type="text" name="title" id="title" required size="100"  placeholder=""/>
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Title</span>
                    </label>
                                </span> </p>
                            
                            <lable>Message 
                                <textarea rows='15' name="msg"  class='form-control margin10'  id="html-template"></textarea>
                            </lable>
                            
                            <lable class="push-top">Recipients
                                <div class="margin10">
                                    <div class="contact-list-div" id="contact_list"></div>
                            <a class="btn-contact" data-toggle="modal" data-target="#myModal"></a>
                            
                                    </div>
                            </lable>
                        </div>
                   </div>
                   <div class="btn-email-send">
                       <input type="submit" name="send" value="Send" class="btn btn-info"> 
                       <input type="button" value="Cancel" class="btn cancel send_cancel">
                </div>
                   </form>
                </div>
                
                <div class="col-lg-12 main-page">
                 
                <div class="template-history">
                    <div class="heading">
                        <h2>Template History</h2>
                    
                    </div>
                   
                    <table id="history" class="table table-striped table-bordered dt-responsive nowrap history-table" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                            <th>Date sent</th>
                              <th>Notification Title</th>
                                <th>No of recipients</th>
                            </tr>
                          </thead>
                          
                          <tbody>
                              <?php if(isset($notes) and !empty($notes)){  
                            foreach ($notes as $note){              
                                ?>
                            <tr>
                                <td><?= $note->date ?></td>
                              <td><?= $note->noteTitle ?></td>
                                <td><?= $note->recipients ?></td>
                            </tr>
                              <?php } }else{ ?>
                              <tr>
                                  <td style="color:red" colspan="3">Notofication List Empty. Please send notification to your client.</td>
                            </tr>
                              <?php } ?>
                          </tbody>
                        </table>
                   </div>
                </div>
               
            
                 
               
                
            
            </div>
           </div>
           
       </section>

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
                                             <div class="check-style">
                                                <input type="checkbox" value="None"  name="all" id="all" class="terms-check" />
                                                <label for="all"> </label>
                                            </div>
                                           All
                                           
                                        </li>
                                         <li class="check-all user-main">
                                               <div class="check-style">
                                                <input type="checkbox" value="None"  name="subscribers" id="sub" class="terms-check" />
                                                <label for="sub"> </label>
                                            </div>
                                            
                                            Subscribers
                                        </li>
                                         <li class="check-all user-main">
                                               <div class="check-style">
                                                <input type="checkbox" value="None"  name="non_subscribers" id="non_sub" class="terms-check" />
                                                <label for="non_sub"> </label>
                                            </div>
                                            
                                            Non Subscribers
                                        </li>
                                         <li class="check-all user-main">
                                               <div class="check-style">
                                                <input type="checkbox" value="None"  name="direct_client" id="indirect" class="terms-check" />
                                                <label for="indirect"> </label>
                                            </div>
                                             
                                          Indirect Clients
                                        </li>
                                          <li class="check-all user-main">
                                              <input type="button"  value="Find" id="find" class="btn btn-info find-btn"/>
                                              <img id="note_loader" src="../img/log_loader.gif" alt="Please Wait">
                                        </li>
                                        
                
                                    </ul>

                                </div>    
                        <table id="menu" class="table table-striped table-bordered dt-responsive nowrap user-list-table" cellspacing="0" width="100%">
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
<?= $this->Html->script('datatables/responsive.bootstrap.min.js') ?>

 <script type="text/javascript">
    function removeme(id, event){
        $(id).parent().remove();
        event.preventDefault();
        return false;
    }   
     
 $(document).ready(function(){
    
    $(':submit').on('click',function(e){
        var text = $('#contact_list').text();
        if(text.length === 0){
            alert('Please add recipent.');
           e.preventDefault();  
        }
      
    });
     
     $('#find').on('click', function(){
         $(this).val('Wait');
         $('#note_loader').css('display','inline-block');
         var check_all = $('#all').is(':checked');
         var check_sub = $('#sub').is(':checked');
         var check_non_sub = $('#non_sub').is(':checked');
         var check_indirect = $('#indirect').is(':checked');
         var url = 'getuserlist';
         var param = '{"all":"'+ check_all +'","sub":"'+ check_sub +'","non_sub":"'+ check_non_sub +'","indirect":"'+ check_indirect +'"}';
        $.ajax({
                type: "post",
                url: url,
                data: param,
                contentType: "application/json; charset=utf-8",
                dataType: "json",  
                success: function(data){
                    $('#note_loader').css('display','none');
                    $('#find').val('Find');
                    var i = 0;
                    var html = '';
                  $.each(data, function(key,json){
                      html += '<tr><td>' + 
                          
                                  '<div class="check-style"><input type="checkbox" value="None"  name="subscribers" id="select_'+ i +'" class="terms-check" checked/><label for="select_'+ i +'"> </label></div></td>'+
                               // '<input id="select_'+ i +'" type="checkbox"  checked></td>'+
                                '<input type="text" style="display:block" value="'+json.gcmId +'" id="user_gcm_'+i+'">'+
                              '<td gcm ="'+json.gcmId +'" id="user_name_'+ i +'" >'+json.fullName +'</td>' +
                                '<td>'+json.email +'</td></tr>';
                     i = i + 1; 
                  });
                  $('#count').val(i);
                $('#user_list').html(html);
                    
                },
                failure: function(errMsg) {
                   alert(errMsg); 
                   $('#note_loader').css('display','none');
                   $('#find').val('Find');
                }
        });
     });
     
     $('#select').on('click', function(event){
        var count = $('#count').val();
        var user_list = '';
        var i = 0;
        for(i = 0; i < count; i++){
            if(jQuery('#select_'+i).is(':checked')){
            var name = $("#user_name_"+i).text();
            var gcm = $("#user_name_"+i).attr('gcm');
          //  var gcm = $("#user_gcm_"+i).val();
            var client = i + 1;
          user_list += '<div id="close_'+i+'" class="user-list-preview">'+name+
               '<input style="display: none" name="client-'+ client +'" id="client-1" type="text" value="'+ gcm +'">' +
               '<button onclick="removeme(this, event);" class="remove-user"><span class="fa fa-close"></span></button></div>';  
        }}
       
        $('#contact_list').html(user_list);
        $('#myModel').css('display','none');
     });
      $('.send_cancel').on('click', function(e){
            // jQuery('.VerticalTab ul li').removeClass('resp-tab-active');
             //jQuery('.VerticalTab ul li.tabs-1').addClass('resp-tab-active');
             window.location.replace('../../');
               e.preventDefault();
               return false;
        });  
    
     
 });  
 function removeME(self){ 
    $(self).parent().remove();
 }
 
 </script>
<?php $this->end('script');?>