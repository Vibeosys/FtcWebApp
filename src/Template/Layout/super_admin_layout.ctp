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

        <title>FTC Solutions | <?= $this->fetch('title')?></title>
        
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('menu.css') ?>
        <?= $this->Html->css('responsive.css') ?>
        <?= $this->Html->css('icons.css') ?>
        <?= $this->Html->css('animate.min.css') ?>
        <?= $this->Html->css('font-awesome.css') ?>
        <?php if($this->fetch('css')){
           echo $this->fetch('css');   
        }?>
       
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
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="../img/user.jpg" alt="user-img" class="img-circle"><span >Sanjoy<i class=" fa fa-angle-down"></i></span></a>
                                <span class="email">abcdef@xyz.com</span>
                                <ul class="dropdown-menu animated fadeInDown pull-right">
                                    <li><a href=""><i class="fa fa-sign-out"></i> Logout</a></li>
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
                            <a href="/?code=1" <?php if($this->fetch('home')){ echo 'class="active-menu"'; }?>><img src="../img/menu-icon/Home-25.png">Home</a>
                        </li>
                        <li class="has-submenu  <?php if($this->fetch('page_list')){ echo 'active'; }?>">
                            <a href="../pages" <?php if($this->fetch('page_list')){ echo 'class="active-menu"'; }?>><img src="../img/menu-icon/Versions-25.png">Custom Pages</a>
                        </li>
                        <li class="has-submenu <?php if($this->fetch('user_management')){ echo 'active'; }?>">
                            <a href="../user/management" <?php if($this->fetch('user_management')){ echo 'class="active-menu"'; }?> ><img src="../img/menu-icon/UserGroups-25.png">User Management</a>
                            <ul class="submenu">
                                 <li><a href="../user/management" <?php if($this->fetch('VC')){ echo 'class="active"'; }?>>View Clients</a></li>
                                 <li><a href="../user/createsubscription" <?php if($this->fetch('CS')){ echo 'class="active"'; }?> >Create Subscription</a></li>
                                  <li><a href="../user/assignsubscription" <?php if($this->fetch('AS')){ echo 'class="active"'; }?>>Assign Subscription</a></li>
                            </ul>
                        </li>
                         <li class="has-submenu <?php if($this->fetch('gallary')){ echo 'active'; }?>">
                            <a href="gallery.html" <?php if($this->fetch('gallary')){ echo 'class="active-menu"'; }?> >
                                <img src="../img/menu-icon/Gallery-25.png">Gallery
                            </a>
                        </li>
                        <li class="has-submenu <?php if($this->fetch('notes')){ echo 'active'; }?>">
                            <a href="#" <?php if($this->fetch('notes')){ echo 'class="active-menu"'; }?>>
                                <img src="../img/menu-icon/Notification-25.png">Notifications</a>
                            <ul class="submenu">
                                <li><a href="email-template-list.html" <?php if($this->fetch('EN')){ echo 'class="active"'; }?>>Email Notification</a></li>
                                <li><a href="app-notify.html" <?php if($this->fetch('AN')){ echo 'class="active"'; }?>>APP Notification</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu <?php if($this->fetch('database')){ echo 'active'; }?>">
                            <a href="database.html" <?php if($this->fetch('database')){ echo 'class="active-menu"'; }?>><img src="../img/menu-icon/Database-25.png">Databases</a>
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
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>
        
       
       
     
   <?php if($this->fetch('script')){
       echo $this->fetch('script');
       
   }?>

    </body>
</html>