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
    $this->assign('title', 'Page Under Construction');
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>FTC Solutions | Page Under Construction</title>

  <!-- Bootstrap core CSS -->

  
 <?= $this->Html->css('custom.css')?> 


  

</head>


<body class="nav-md coming-soon-bg">

  <div class="container container-page body">


    <div class="main_container">
   
        <div class="right_col" role="main">
 <section class="coming-soon">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <h1>This Page is Under</h1>
                    <h3>Construction</h3>
					  <div style="width: 100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <h4>Please check back soon</h4>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <img src="../img/under-contruction.png" class="img-responsive">
                </div>
              
            </div>
        </div>
    </section>
        </div>
    </div>
    </div>
<?= $this->Html->script('jquery.min.js') ?>   
<?= $this->Html->script('bootstrap.min.js') ?>   
<?= $this->Html->script('custom.js') ?>   
</body>

</html>
