<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    use Cake\View\ViewBuilder;
    use Cake\View\Helper\UrlHelper;
  
    $this->layout = FALSE;
?>

<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>FTC Solutions</title>
         <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('menu.css') ?>
        <?= $this->Html->css('responsive.css') ?>
        <?= $this->Html->css('icons.css') ?>
        <?= $this->Html->css('animate.min.css') ?>
        <?= $this->Html->css('font-awesome.css') ?>
       
    </head>
   <body class="login-page">
       <section class="login">
        <div  class="company-logo"></div> 
        <?php if(isset($userId)){
        if(!$userId) {?>
        <h2 class="text-center">
            <?= $errorMessage ?>
        </h2>
        <a href="<?= $this->Url->webroot('/') ?>">Home</a>
        <?php }else  {?>
        <form name="loginform" id="loginform" action="" method="post">
            <h3 class="text-center" style="margin: 0px 0px 10px 0px">Change Password</h3>
            <input type="text" value="<?= $userId ?>" name="userId" style="display: none">
          <?php if(isset($isShowSub)) {?>
            <p>
		<label for="user_login">Subscriber Id<br />
		<input type="text" name="subscriberId" id="user_login" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
          <?php } ?>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
    	<p>
		<label for="subscribe_id">Confirm Password<br />
		<input type="password" name="c_pwd" id="subscribe_id" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
		
	<p class="submit">
            <input type="submit" id="ftc-submit" class="btn btn-primary btn-large center-block" name="login" value="Change Password">
	</p>
            
        </form>
        <?php }} ?>
       </section>
       <?php if(isset($sucMsg)) { ?>
       <div class="text-center" style="padding: 20px 10px">
           <p id="change_password_msg" style="color:<?= $color ?>"><?= $sucMsg?></p>
       </div>
       <?php } ?>
       
        <?= $this->Html->script('jquery.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>
       <script type="text/javascript">
       $(document).ready(function(){    
       $(':submit').on('click',function(event){
           if($('user_pass').val() == $('subscribe_id').val()){
               
           }else{
              event.preventDefault(); 
           }
       });    
       });
       </script>
       
    </body>
</html>