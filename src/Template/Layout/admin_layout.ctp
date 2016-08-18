<?php
use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $this->fetch('title')?> | FTC Solutions </title>
        
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('menu.css') ?>
        <?= $this->Html->css('responsive.css') ?>
        <?= $this->Html->css('icons.css') ?>
        <?= $this->Html->css('animate.min.css') ?>
        <?= $this->Html->css('font-awesome.css') ?>
          <?= $this->Html->css('dropdown-style.css') ?>
        <?php if($this->fetch('css')){
           echo $this->fetch('css');   
        }?>
   <?= $this->Html->script('OneSignalSDK.js') ?>     
   <script>
      var OneSignal = OneSignal || [];
    OneSignal.push(["init", {
      appId: "d7d678e9-7cd4-4e9d-b823-3f172572ef74",
      autoRegister: true, /* Set to true to automatically prompt visitors */
      subdomainName: 'ftctradenow',   
       notifyButton: {
        enable: true, /* Required to use the notify button */
        size: 'medium', /* One of 'small', 'medium', or 'large' */
        theme: 'inverse', /* One of 'default' (red-white) or 'inverse" (white-red) */
        position: 'bottom-left', /* Either 'bottom-left' or 'bottom-right' */
        offset: {
            bottom: '10px',
            left: '10px', /* Only applied if bottom-left */
            right: '0px' /* Only applied if bottom-right */
        },
        prenotify: true, /* Show an icon with 1 unread message for first-time site visitors */
        showCredit: false, /* Hide the OneSignal logo */
        text: {
            'tip.state.unsubscribed': 'Subscribe to notifications',
            'tip.state.subscribed': "You're subscribed to notifications",
            'tip.state.blocked': "You've blocked notifications",
            'message.prenotify': 'Click to subscribe to notifications',
            'message.action.subscribed': "Thanks for subscribing!",
            'message.action.resubscribed': "You're subscribed to notifications",
            'message.action.unsubscribed': "You won't receive notifications again",
            'dialog.main.title': 'Manage Site Notifications',
            'dialog.main.button.subscribe': 'SUBSCRIBE',
            'dialog.main.button.unsubscribe': 'UNSUBSCRIBE',
            'dialog.blocked.title': 'Unblock Notifications',
            'dialog.blocked.message': "Follow these instructions to allow notifications:"
        }
    }
    }]);   
    </script>
    </head>
   <body>
     <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <a href="" class="logo"><img src="../img/logo.png" class="logo-img"> </a>
                        <div class="heading-top">Mobile APP Admin Panel</div>
                       
                   
                      
                    <!-- End Logo container-->
                    <div class="menu-toggle">
                    <div class="menu-extras">
                         
                         <ul class="nav navbar-nav navbar-right pull-right">
                            
                          

                            <li class="dropdown">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="../img/user.jpg" alt="user-img" class="img-circle">
                                    <span id="cur_name" ></span></a>
                                <span id="cur_email" class="email"></span>
                                <ul class="dropdown-menu animated fadeInDown pull-right">
                                    <li><a href="../logout"><i class="fa fa-sign-out fa-logout"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                       
                    </div>
                         <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End topbar -->


            <!-- Navbar Start -->
            <div class="navbar-custom">
                <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
					 <li class="has-submenu <?php if($this->fetch('home')){ echo 'active'; }?>">
                            <a href="/" <?php if($this->fetch('home')){ echo 'class="active-menu"'; }?>><img src="../img/menu-icon/Home-25.png">Home</a>
                        </li>
                        <li class="has-submenu  <?php if($this->fetch('page_list')){ echo 'active'; }?>">
                            <a href="../pages" <?php if($this->fetch('page_list')){ echo 'class="active-menu"'; }?>><img src="../img/menu-icon/Versions-25.png">Custom Pages</a>
                        </li>
                     <!--   <li class="has-submenu <?php if($this->fetch('user_management')){ echo 'active'; }?>">
                            <a href="../user/management" <?php if($this->fetch('user_management')){ echo 'class="active-menu"'; }?> ><img src="../img/menu-icon/UserGroups-25.png">User Management</a>
                            <ul class="submenu">
                                 <li><a href="../user/management" <?php if($this->fetch('VC')){ echo 'class="active"'; }?>>View Clients</a></li>
                                 <li><a href="../user/createsubscription" <?php if($this->fetch('CS')){ echo 'class="active"'; }?> >Create Subscription</a></li>
                                  <li><a href="../user/assignsubscription" <?php if($this->fetch('AS')){ echo 'class="active"'; }?>>Assign Subscription</a></li>
                            </ul>
                        </li> -->
                         <li class="has-submenu <?php if($this->fetch('gallery')){ echo 'active'; }?>">
                            <a href="../gallery" <?php if($this->fetch('gallery')){ echo 'class="active-menu"'; }?> >
                                <img src="../img/menu-icon/Gallery-25.png">Gallery
                            </a>
                        </li>
                        <li class="has-submenu <?php if($this->fetch('notes')){ echo 'active'; }?>">
                            <a href="#" <?php if($this->fetch('notes')){ echo 'class="active-menu"'; }?>>
                                <img src="../img/menu-icon/Notification-25.png">Notifications</a>
                            <ul class="submenu">
                                <li><a href="../emailnotification" <?php if($this->fetch('EN')){ echo 'class="active"'; }?>>Email Notifications</a></li>
                                <li><a href="../appnotification" <?php if($this->fetch('AN')){ echo 'class="active"'; }?>>APP Notifications</a></li>
                            </ul>
                        </li>
                   
                    </ul>
                    <!-- End navigation menu -->
                </div>
            </div>
            </div>
            
        </header>
        <!-- End Navigation Bar-->
        <?php 
        if($this->fetch('content')){
            echo $this->fetch('content');
        }
        ?>
        <!-- jQuery  -->
        <?= $this->Html->script('jquery.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
       
        <?= $this->Html->script('classie.js') ?>
        <?= $this->Html->script('custom-file-input.js') ?>
       <script type="text/javascript">
            jQuery(document).ready(function(){
                 jQuery.post('/getcookie',{name:'cur_name'}, function(value){
                     if(value == 0){
                         window.location.replace('../../admin/login');
                     }
                     var uname = value.split(" ",1); 
                     jQuery('#cur_name').html(uname +'...<i class=" fa fa-angle-down"></i>');
                 });
                 jQuery.post('/getcookie',{name:'cur_email'}, function(val){
                     jQuery('#cur_email').text(val);
                     if(val == 0){
                         window.location.replace('../../admin/login');
                     }
                 });
                  jQuery.post('/getcookie',{name:'isAdmin'}, function(val){
                     if(val == 0){
                         jQuery('.hide_it').hide();
                     }
                 });
            });
        
        </script>      
		
     <?php if($this->fetch('script')){
       echo $this->fetch('script');
       
   }?>

    </body>
</html> 