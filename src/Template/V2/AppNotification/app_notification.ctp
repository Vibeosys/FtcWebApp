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
                             <lable>Title
                                 <input type="text" name="title"  class='app_title_width form-control margin10'  id="title" required>
                            </lable>
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
                       <input type="submit" name="send" value="Send" class="btn btn-info"> <input type="button" value="Cancel" class="btn cancel">
                </div>
                   </form>
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
<?= $this->Html->script('datatables/responsive.bootstrap.min.js') ?>

 <script type="text/javascript">
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
                    var i = 0;
                    var html = '';
                  $.each(data, function(key,json){
                      html += '<tr><td>' + 
                                '<input type="checkbox"  checked></td>'+
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
                }
        });
         
         
           $(this).val('Find');
           $('#note_loader').css('display','none');
         
     });
     
     $('#select').on('click', function(event){
        var count = $('#count').val();
        var user_list = '';
        var i = 0;
        for(i = 0; i < count; i++){
            var name = $("#user_name_"+i).text();
            var gcm = $("#user_name_"+i).attr('gcm');
          //  var gcm = $("#user_gcm_"+i).val();
            var client = i + 1;
          user_list += '<div id="close_'+i+'" class="user-list-preview">'+name+
               '<input style="display: none" name="client-'+ client +'" id="client-1" type="text" value="'+ gcm +'">' +
               '<input type="button" class="remove" value="X"></div>';  
        }
       
        $('#contact_list').html(user_list);
        $('#myModel').css('display','none');
     });
     
     
  function remove(id){
  $('#'+id).remove();
 }
     
     
     
 });  
 
 </script>
<?php $this->end('script');?>