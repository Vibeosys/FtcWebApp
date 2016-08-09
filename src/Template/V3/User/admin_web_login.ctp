<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    use Cake\View\ViewBuilder;
    use Cake\View\Helper\UrlHelper;
    use Cake\Routing\Router;
  
    $this->layout = FALSE;
   // $this->assign('title', 'Admin Login');
?>

<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>FTC Solutions | Admin Login</title>
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('menu.css') ?>
        <?= $this->Html->css('responsive.css') ?>
        <?= $this->Html->css('icons.css') ?>
        <?= $this->Html->css('animate.min.css') ?>
        <?= $this->Html->css('font-awesome.css') ?>
        <?= $this->Html->css('jquery-ui.css') ?>
        
       
    </head>
   <body class="login-page">
       
     <section class="login">
        <div class="logo-header"><div  class="company-logo"></div>  </div>
        <form name="loginform" id="loginform"  method="post">
            <p>
		<label for="user_login">User Name<br />
                    <input type="text" name="username" id="user_login" onfocus ="removeb('user_login')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" onfocus="removeb('user_pass')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
    	<p>
		<label for="subscribe_id">Subscription Id<br />
		<input type="text" name="subscribeid" id="subscribe_id" onfocus="removeb('subscribe_id')" aria-describedby="login_error" class="input" value="" size="20" ></label>
	</p>
		
	<div class="submit">
          <div class="check-style">
	<input  type="checkbox" value="None" id="check_box" name="check" class="terms-check" />
	<label for="check_box"></label>
        </div>   
        <span class="terms-cond">
            <span class="terms-content">I agree to the <a href="" data-toggle="modal" data-target="#myModal" >Terms of use.</a></span>
        </span>
            
        <span class="btn-login">
            <input type="button" id="ftc-submit" class="btn btn-primary btn-large" value="Login" name="login-btn">
         </span>
           <!-- <span id="error_check" class="error-check">Please read terms & conditions.</span>    -->
	</div>
        <span style="display: none" id="check_er" class="error-check">Please agree with terms and conditions before login.</span>    
        <img id="log_loader" style="width: 27px;margin: 0px 114px;display: none;position:relative;top:20px;" src="../img/log_loader.gif" alt="Please Wait" />
        <p class="text-center" id="log_msg" style=" display: none;color: red;font-size: 15px"></p>  
        
       
        </form>
       
       </section>
       
       <div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Terms and Conditions</h4>

            </div>
            <div class="modal-body">
               
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                     <p> <strong>What is Lorem Ipsum?</strong><br>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p>
<p>
<strong>Why do we use it?</strong><br>
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
    </p>
                    </div>
                <div class="modal-footer">

                    </div>
            </div>
        </div>
    </div>
</div>
        <!-- jQuery  -->
         <?= $this->Html->script('jquery.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>
        <?= $this->Html->script('jquery-ui.js') ?>
        <script type="text/javascript">
          function removeb(id){
            $('#' + id).css('border','1px solid #ddd');  
          }
          $(document).ready(function(e){
              $('#ftc-submit').on('click',function(){
                  
                  var uname = $('#user_login').val();
                  var pass = $('#user_pass').val();
                  var sId = $('#subscribe_id').val();
                  var url = '/v3/userSubLogin';
                  var request = '{"username":"' +uname +'","pwd":"' +pass+ '","subscriberId":"' +sId+ '", "weblogin":1}';
                   if(!uname && !pass && !sId){
                      $('#user_login').css('border','1px solid red'); 
                       $('#user_pass').css('border','1px solid red');
                       $('#subscribe_id').css('border','1px solid red');
                       e.preventDefault();
                  }else if(!uname && !pass){
                       $('#user_login').css('border','1px solid red'); 
                       $('#user_pass').css('border','1px solid red');
                       e.preventDefault();
                  }else if(!pass && !sId){
                        $('#user_pass').css('border','1px solid red');
                       $('#subscribe_id').css('border','1px solid red');
                       e.preventDefault();
                  }else if(!uname && !sId){
                       $('#user_login').css('border','1px solid red'); 
                       $('#subscribe_id').css('border','1px solid red');
                       e.preventDefault(); 
                  }else if(!uname){
                       $('#user_login').css('border','1px solid red');
                     $('#user_login').effect( "shake" );
                     e.preventDefault();
                     
                  }else if(!pass){
                     $('#user_pass').css('border','1px solid red');
                     $('#user_pass').effect( "shake" );
                     e.preventDefault(); 
                  }else if(!sId){
                   $('#subscribe_id').css('border','1px solid red');
                     $('#subscribe_id').effect( "shake" );
                     e.preventDefault();
                  }else if(!$('#check_box').is(':checked')){
                    $('#check_er').css('display', 'block'); 
                    e.preventDefault();
                  }
                  $(this).val('Wait');
                  $('#log_loader').css('display','block');
                 // var req = request.toString();
                   $.ajax({
                        type: "POST",
                        url: url,
                        data: '{"user":"{}","data" :'+ JSON.stringify(request)+'}',
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function(data){
                            $('#ftc-submit').val('Login');
                            $.each(data, function(key ,value){
                               var obj = $.parseJSON(value);
                                    if(obj.errorCode > 0){
                                        
                                        $('#log_loader').css('display','none');
                                        $('#log_msg').css('display','block');
                                        $('#log_msg').text(obj.message);
                                    }else{
                                        $.when(
                                        $.post('/setcookie',{name:'uname',value:uname}),
                                        $.post('/setcookie',{name:'sub_id',value:sId})
                                        ).then(function(){ 
                                             window.location.replace('/');
                                        });
                                    }
                            });
                           },
                        failure: function(errMsg) {
                            $('#log_mesg').text('Incorrect username or password');
                            $('#ftc-submit').val('Login');
                            alert(errMsg);
                        }
                  });
              });
          });
        
        </script>    
       
    </body>
</html>

