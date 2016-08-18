<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    use Cake\View\ViewBuilder;
    use Cake\View\Helper\UrlHelper;
  
    $this->layout = $layout;
    $this->assign('title', 'Home');
    $this->assign('home','1');
?>


       <section class="page-section">
        <div class="container">
            <div class="row">
               

               <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 center-block box-hover">
                    <div class="col-lg-12 main-home-page ">
                        <div class="heading">
                        <h2><img src="img/menu-icon/Dossier-48.png"> Welcome Message</h2>
                    </div>
                   <div class="tool-list-home">
                       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                   </div>
                </div>
                </div>
               
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  center-block box-hover">
                   <div class="col-lg-12 main-home-page ">
                       
                   <div class="tool-list-home center-block">
                       <iframe width="100%" height="250" src="https://www.youtube.com/embed/fgExvIUYg5w"  class="center-block"></iframe>
                   </div>
                </div>
                    <div class="col-lg-12 main-home-page ">
                <div class="tool-list-home">
                    <div class="heading">
                        <h2><img src="img/menu-icon/About-48.png"> Information Guide</h2>
                    </div>
                       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, </p>
                      
                   </div>
                    </div>
                </div>
            </div>
           </div>
           
       </section>

 