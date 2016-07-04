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
                           <div class="contact-list-div">
                               <div class="user-list-preview">User1
                                   <input style="display: none" name="client-1" id="client-1" type="text" value="82308b7d-6d9e-4c32-b903-9fa35cfe090f">
                                   <button class="remove">
                                       <span class="fa fa-close">
                                       </span>
                                   </button>
                               </div>        
                               <div class="user-list-preview">User2 
                                   <input style="display: none" name="client-2" id="client-2" type="text" value="af64deb6-99b1-4db4-9c8c-1e198342ab64">
                                   <button class="remove">
                                       <span class="fa fa-close">
                                       </span>
                                   </button>
                               </div>        
                               <div class="user-list-preview">User3 <button class="remove"><span class="fa fa-close"></span></button></div>        
                               <div class="user-list-preview">User4 <button class="remove"><span class="fa fa-close"></span></button></div>        
                            
                               
                            </div>
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

<div id="myModal" class="modal animated zoomin" ng-app="myApp" >
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
                          <tbody>
                            <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          <tr>
                                <td> <input type="checkbox" ng-model="item.Selected" /></td>
                              <td>Sanjoy</td>
                                <td>sanjoy@gmail.com</td>
                              
                            </tr>
                          

                          </tbody>
                        </table>
                                    </ul>

                                </div>               
                      </div>
                 
                    
                    <div class="modal-footer">
                        
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
    
    $('.remove').on('click',function(){
        $(this).parent().remove();
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
                  var json = data;
                  alert(json.sub);
                  alert(json.non_sub);
                    
                },
                failure: function(errMsg) {
                   alert(errMsg);    
                }
        });
         
         
           $(this).val('Find');
           $('#note_loader').css('display','none');
         
     });
     
     
     
     
     
     
 });      
 </script>
<?php $this->end('script');?>