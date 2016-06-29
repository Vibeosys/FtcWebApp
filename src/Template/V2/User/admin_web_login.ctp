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
        
       
    </head>
   <body class="login-page">
       <section class="login">
        <div  class="company-logo"></div>  
        <form name="loginform" id="loginform" action="/" method="post">
            <p>
		<label for="user_login">Username<br />
		<input type="text" name="username" id="user_login" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
    	<p>
		<label for="subscribe_id">Subscription Id<br />
		<input type="text" name="subscribeid" id="subscribe_id" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
		
	<p class="submit">
            <input type="submit" id="ftc-submit" class="btn btn-primary btn-large" value="Login" name="login-btn" >
            <a href="#" style="float: right" class="text-right"> forgot password?</a>
	</p>
            
        </form>
       
       </section>
        <!-- jQuery  -->
         <?= $this->Html->script('jquery.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>
       
       
    </body>
</html>

