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
        <div  class="company-logo"></div>  
        <form name="loginform" id="loginform"  method="post">
            <p>
		<label for="user_login">Username<br />
                    <input type="text" name="username" id="user_login" onfocus ="removeb('user_login')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" onfocus="removeb('user_pass')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
    	<p>
		<label for="subscribe_id">Subscription Id<br />
		<input type="text" name="subscribeid" id="subscribe_id" onfocus="removeb('subscribe_id')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
		
	<p class="submit">
            <input type="button" id="ftc-submit" class="btn btn-primary btn-large" value="Login" name="login-btn" >
            <a  id="forgot" style="float: right" class="text-right"> forgot password?</a>
	</p>
        <img id="log_loader" style="width: 27px;margin: 0px 114px;display: none" src="../img/log_loader.gif" alt="Please Wait">
        <p class="text-center" id="log_msg" style=" display: none;color: red;font-size: 15px"></p>  
        </form>
       
       </section>
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
                  var url = '/v2/userSubLogin';
                  var request = '{"username":"' +uname +'","pwd":"' +pass+ '","subscriberId":' +sId+ '}';
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

