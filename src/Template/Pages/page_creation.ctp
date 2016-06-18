<?php
use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    if(isset($permission)){
    if($permission)    
    $this->layout = 'super_admin_layout';
    else
    $this->layout = 'admin_layout';    
    }
    
?>

 <section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="publish-btn">
                <input type="button" value="Publish" class="btn btn-success">
                    <input type="button" value="Cancel" class="btn btn-danger">
                    </div>
                    <div class='hr-line-top'><hr></div>
                </div>
               <div class="col-lg-12 mobile-show">
                     <div class="heading">
                        <h2>Toolbox</h2>
                    
                    </div>
                
                
                    <ul class="tool-list-mobile">
                            <li><addimage></addimage></li>
                            <li><addlink></addlink></li>
                            <li><addvideo></addvideo></li>
                            <li><addtext></addtext></li>
                            <li><addheading></addheading></li>
                            <li><a style="cursor:pointer" ><span class='fa fa-video-camera'></span>Add Web View<span class='fa fa-plus plus-icon' ></span></a></li>
                    </ul>
                   
                </div>
               <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 main-page">
                    
                <div class="heading">
                        <h2>Page Creation</h2>
                    
                    </div>
                
                <div class="page-item" id="space-for-tool">
                
                    
                </div>
                <div class="button-list">
                    <input type="button" value="Save as Draft" class="btn btn-info">
                </div>
                <!--   <div class="">
                   <textarea rows="4" placeholder="Text" class="form-control" ></textarea>
                   </div>-->
           </div>
            
                 
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 main-page left-pannel">
                    <div class="heading">
                        <h2>Toolbox</h2>
                    </div>
                   <div class="tool-list">
                        <ul><!--
                            <li><a href="" ng-click="AppendFile()"><span class="fa fa-picture-o" ></span>Add Images</a><addimage></addimage></li>
                             <li><a href="" ><span class="fa fa-link"></span>Add Link</a></li>
                             <li><a href=""><span class="fa fa-video-camera"></span>Add Video</a></li>
                             <li><a href="" ng-click="AppendText()"><span class="fa fa-align-left"></span>Add Text</a></li>
                             <li><a href=""><span class="fa fa-list"></span>Add List</a></li>
                            -->
                            <li><addimage></addimage></li>
                             <li><addlink></addlink></li>
                             <li><addvideo></addvideo></li>
                             <li><addtext></addtext></li>
                            <li><addheading></addheading></li>
                             <li><a style="cursor:pointer" ><span class='fa fa-video-camera'></span>Add Web View<span class='fa fa-plus plus-icon' ></span></a></li>
                             <!--<li><a href=""><span class="fa fa-list"></span>Add List</a></li>-->
                       </ul>
                   </div>
                </div>
                
                 <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 main-page mobile-size">
                    
                <div class="heading">
                        <h2>Mobile Preview</h2>
                        <button name="Privew" class="btn-privew btn btn-warning">Preview</button>
                    </div>
                
                <div class="page-item" id="privew-for-tool">
                    
                    <div class="image-preview push-space">
                        <img src="images/download.jpg" class="img-responsive" width="200" height="200">
                    </div>
					<div class="link-preview push-space">
                    <p><strong>Heading Text</strong></p>
                    </div>
                    <div class="text-preview push-space">
                    <P>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here'</P>
                    </div>
                    <div class="link-preview push-space">
                    <a href="pahe.html">Read More</a>
                    </div>
                    <div class="video-preview push-space">
                    <!--<video src="https://www.youtube.com/watch?v=0WyjWF1nZCM" controls>
                                Your browser does not support the <code>video</code> element.
                    </video>-->
                        <iframe width="300" height="200" src="https://www.youtube.com/embed/fgExvIUYg5w"></iframe>
                    </div>
                </div>
                <!--   <div class="">
                   <textarea rows="4" placeholder="Text" class="form-control" ></textarea>
                   </div>-->
           </div>
            
            </div>
           </div>
           
       </section>