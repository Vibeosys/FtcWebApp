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
    $this->assign('title', 'Page Customization');
    $this->assign('page_list','1');
?>
<section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
    <div class="container">
        <div class="row">
            <form action="../pages/edit" method="post" enctype="multipart/form-data">  
                <div class="col-lg-12 main-page-publish">

                    <h2>Customisation : <?= $page->pageTitle ?></h2>
                        <?php if(isset($message)){ ?>
                    <span style="text-align:center;background-color:white;color: <?= $color ?>;padding:10px"><strong><?= $message ?>.</strong></span>
                        <?php } ?>
                    <div class="publish-btn">
                        <input type="submit" name="publish" value="Publish" class="btn btn-info btn-large">
                        <input type="button" value="Cancel" class="btn cancel btn-large cancel_page">
                    </div>
                </div>
                <div class="col-lg-12 mobile-show">
                    <div class="heading">
                        <h2>Toolbox</h2>

                    </div>

                     <div class="type-radio">
                         <ul class="check-ul">
                          <li>
                            <input type="radio" id="custom" name="type" checked value="1">
                            <label for="custom">Custom</label>

                            <div class="check"></div>
                          </li>

                          <li>
                            <input type="radio" id="web" name="type" value="2">
                            <label for="web">Web View</label>

                            <div class="check"><div class="inside"></div></div>
                          </li>

                          <li>
                            <input type="radio" id="rss" name="type" value="3">
                            <label for="rss">RSS Feed</label>

                            <div class="check"><div class="inside"></div></div>
                          </li>
                        </ul>
                      
                    </div>
                    <ul class="tool-list-mobile">
                        <li><addimage></addimage></li>
                        <li><addlink></addlink></li>
                        <li><addvideo></addvideo></li>
                        <li><addyoutubevideo></addyoutubevideo></li>
                        <li><addtext></addtext></li>
                        <li><addheading></addheading></li>
                        <li><addweblink></addweblink></li>
                        <li><addrssfeed></addrssfeed></li>
                    </ul>

                </div>
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 main-page">
    
                        <div class="publish-btn">
                            <a  href="#preview_div" class="btn btn-preview btn-large">Preview</a>
                            <input type="submit" name="save" value="Save as Draft" class="btn btn-info btn-large">
                            <input type="button" value="Cancel" class="btn cancel btn-large cancel_page">
                        </div>
                         <span class="input input--hoshi input-32 push-51">
                    <input class="input__field input__field--hoshi title-input" type="text" id="page" name="page" placeholder="" value="<?= $page->pageTitle ?>" required/>
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi"> App Page Title</span>
                    </label>
                </span> 
                        <input type="hidden" name="pageId" value="<?= $page->pageId ?>">
                        <input type="hidden" name="pageType" value="<?= $page->pageType ?>">
                        <input type="hidden" name="status" value="<?= $page->status ?>">
                        <input type="hidden" name="active" value="<?= $page->active ?>">
                        <input type="hidden" name="author" value="<?= $page->author ?>">
                        <input type="hidden" name="for" value="<?= $page->pageFor ?>">
                        <img id="page_loader" style="width: 38px;margin: 2px 0px;display: none" src="../img/log_loader.gif" alt="Please Wait">
                        <p id="page_name_check_msg" style="margin: 0 0 -8px;display: none"><p>
                       </p>
                    <div ><span class="app-text">App Content</span></div>
                    <div class="page-item" >
                        <div class="canvas center-block"><span class="canvas-text center-block">Canvas</span></div>
                        <?php $type =0; if(isset($page)) {
                           if($page->pageType == 1)
                               $type = 'custom';
                           else if($page->pageType == 2)
                               $type = 'web';
                           else if($page->pageType == 3)
                               $type = 'rss';
                        }?>
                        <div type="<?= $type?>" class="inner-page" id="space-for-tool">
                    <?php if(isset($widgets)) { $i = 1; 
                      foreach ($widgets as $widget){ $data = json_decode($widget->data);
                      if($widget->widgetTitle == 'Image'){    
                    ?>
                            <div class="remove-<?= $i ?> push-margin ng-scope" type="vbcustom">
                                <div style="display:flex">
                                    <input name="image-<?= $i ?>" type="text" value="<?= $data->url ?>" class="form-control" id="file-img-<?= $i ?>">
                                    <a onclick="relect_for_me('file-img-<?= $i ?>');" name="image-select" class="img-btn" data-toggle="modal" data-target="#myModal"> Select Image </a>
                                </div>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>
                      <?php }else if($widget->widgetTitle == 'Link'){?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <div style="display:flex">Link
                                    <input name="link-<?= $i ?>" value="<?= $data->link ?>" type="text" placeholder="Link" class="form-control link-input ng-pristine ng-valid"> Link Caption
                                    <input name="link_caption-<?= $i ?>" value="<?= $data->caption ?>" type="text" placeholder="Link Caption" class="form-control link-input ng-pristine ng-valid">
                                </div>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>

                      <?php }else if($widget->widgetTitle == 'Video'){ ?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <div style="display:flex">Video Link
                                    <input name="video-<?= $i ?>" type="text" value="<?= $data->url ?>" placeholder="Video Link" class="form-control ng-pristine ng-valid">
                                </div>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>
                            
                             <?php }else if($widget->widgetTitle == 'YouTube'){ ?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <div style="display:flex">Video Link
                                    <input name="youtube-<?= $i ?>" type="text" value="<?= $data->link ?>" placeholder="Youtube Video Link" class="form-control ng-pristine ng-valid">
                                </div>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>
                            
                      <?php }else if($widget->widgetTitle == 'Text'){?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <textarea rows="4" placeholder="Text"  class="form-control ng-pristine ng-valid" name="text-<?= $i ?>"><?= $data->text ?></textarea>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>          

                      <?php }else if($widget->widgetTitle == 'Heading'){?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <input name="heading-<?= $i ?>" value="<?= $data->head ?>" type="text" placeholder="Heading" class="form-control ng-pristine ng-valid">
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>

                      <?php }else if($widget->widgetTitle == 'WebView'){   ?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <input name="web-<?= $i ?>" value="<?= $data->view ?>" type="text" placeholder="Web Link" class="form-control ng-pristine ng-valid">
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>

                      <?php }else if($widget->widgetTitle == 'Rss'){ ?>
                            <div class="remove-<?= $i ?> push-margin id= ng-scope" vbrss="">
                                <input name="rss-<?= $i ?>" value="<?= $data->feed ?>" type="text" placeholder="Rss Feed" class="form-control ng-pristine ng-valid" id="text-input-rssfeed-1" ng-model="rssfeed1">
                                <div class="desc"> Description tags to read feed</div>
                                <div style="display:flex">
                                    <input name="parent-<?= $i ?>" value="<?= $data->feedParent ?>" type="text" placeholder="Parent" class="form-control link-input" id="text-parent-1">
                                </div>
                                <div style="display:flex">
                                    <input name="title-<?= $i ?>" value="<?= $data->feedTitle ?>" type="text" placeholder="Title" class="form-control link-input" id="text-title-1">
                                    <input name="rss_link-<?= $i ?>" value="<?= $data->feedLink ?>" type="text" placeholder="Link" class="form-control link-input" id="text-link-1">
                                </div>
                                <div style="display:flex">
                                    <input name="date-<?= $i ?>" value="<?= $data->feedDate ?>" type="text" placeholder="Date" class="form-control link-input" id="text-date-1">
                                    <input name="description-<?= $i ?>" value="<?= $data->feedDescription ?>" type="text" placeholder="Description" class="form-control link-input" id="text-desc-1">
                                </div>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>
                    <?php }}} ?>

                        </div>
                    </div>
                </div>
            </form>

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
                <div class="main-page main-page-hide">
                    <div class="heading">
                        <h2>Toolbox</h2>
                    </div>
                     <div class="type-radio">
                        <ul class="check-ul">
                          <li>
                            <input type="radio" id="custom" name="type" checked value="1">
                            <label for="custom">Custom</label>

                            <div class="check"></div>
                          </li>

                          <li>
                            <input type="radio" id="web" name="type" value="2">
                            <label for="web">Web View</label>

                            <div class="check"><div class="inside"></div></div>
                          </li>

                          <li>
                            <input type="radio" id="rss" name="type" value="3">
                            <label for="rss">RSS Feed</label>

                            <div class="check"><div class="inside"></div></div>
                          </li>
                        </ul>
                         <!--
                        <span><input type="radio" name="type" class="type" id="custom" checked value="1"> Custom </span>
                        <span><input type="radio" name="type" class="type" id="web" value="2"> Web View</span>
                        <span><input type="radio" name="type" class="type" id="rss" value="3"> RSS</span></div>-->
                    <div class="tool-list">
                        <ul>
                            <li><addimage></addimage></li>
                            <li><addlink></addlink></li>
                            <li><addvideo></addvideo></li>
                            <li><addyoutubevideo></addyoutubevideo></li>
                            <li><addtext></addtext></li>
                            <li><addheading></addheading></li>
                            <li><addweblink></addweblink></li>
                            <li><addrssfeed></addrssfeed></li>
                        </ul>
                    </div>
                </div>
                </div>
                <div id="preview_div" class="main-page mobile-size">
                    <div class="heading">
                        <h2>Mobile Preview</h2>
                        <a href="#preview_div"> <span class="fa fa-refresh refresh-link"></span></a>
                    </div>

                    <div class="page-item" id="privew-for-tool">
                     <?php if(isset($widgets)) { $i = 1;
                      foreach ($widgets as $widget){ $data = json_decode($widget->data);
                      if($widget->widgetTitle == 'Image'){    
                    ?>
                           <div class="image-preview push-space">
                               <img src="<?= $data->url ?>" class="img-responsive" width="200" height="200">
                           </div>
                      <?php }else if($widget->widgetTitle == 'Link'){?>
                           <div class="link-preview push-space">
                               <a target="_blank" href="<?= $data->link ?>"><?= $data->caption ?></a>
                            </div>

                      <?php }else if($widget->widgetTitle == 'Video'){ ?>
                            <div class="remove-<?= $i ?> push-margin ng-scope">
                                <div style="display:flex">Video Link
                                    <input name="video-<?= $i ?>" type="text" value="<?= $data->url ?>" placeholder="Video Link" class="form-control ng-pristine ng-valid">
                                </div>
                                <button name="remove" class="btn-remove" id="remove-<?= $i++ ?>" remove-me="">Remove</button>
                                <div class="hr-line">
                                    <hr>
                                </div>
                            </div>
                            
                        <?php }else if($widget->widgetTitle == 'YouTube'){ $video = explode('?v=', $data->link); ?>
                            <div class="video-preview push-space">
                                <iframe width="300" height="200" src="https://www.youtube.com/embed/<?= $video[1] ?>"></iframe>
                            </div>
                      <?php }else if($widget->widgetTitle == 'Text'){?>
                         <div class="text-preview push-space">
                            <P><?= $data->text ?></P>
                        </div>
                      <?php }else if($widget->widgetTitle == 'Heading'){?>
                         <div class="heading-preview push-space">
                            <h2><?= $data->head ?></h2>
                        </div>

                      <?php }else if($widget->widgetTitle == 'WebView'){   ?>
                            <div class="webview-preview push-space">
                                <h3><a style="word-wrap: break-word" target="_blank" href="<?= $data->view ?>"><?= $data->view ?></a></h3>
                            </div>

                      <?php }else if($widget->widgetTitle == 'Rss'){ ?>
                        <div class="rssfeed-preview push-space">
                            <p><span>Rss Feed</span>: <?= $data->feed ?></p>
                            <p><span>Rss Parent</span>: <?= $data->feedParent ?></p>
                            <p><span>Rss Title</span>: <?= $data->feedTitle ?></p>
                            <p><span>Rss Link</span>: <?= $data->feedLink ?></p>
                            <p><span>Rss Date</span>: <?= $data->feedDate ?></p>
                            <p><span>Rss Description</span>: <?= $data->feedDescription ?></p>
                        </div>
                    <?php }}} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog img-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-dialog" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Media</h4>

            </div>
            <div class="modal-body">
                <div id="tab-menu" class="container-fluid">	
                    <ul  class="nav nav-pills">
                        <li class="active">
                            <a  href="#image" data-toggle="tab">Images</a>
                        </li>
                        <li><a href="#video" data-toggle="tab">Videos</a>
                        </li>
                    </ul>
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="image">
                            <div class="container-fluid">
                                <div class="row row-wrap" id="img_list">

                                    

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="video">
                           <div class="container-fluid">
                                <div class="row row-wrap">

                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="video.mp4" type="video/mp4">
                                                <source src="video.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-xs-12 thumb">
                                        <a class="thumbnail-video" href="#">

                                            <video class="video" controls>
                                                <source src="../img/mov_bbb.mp4" type="video/mp4">
                                                <source src="mov_bbb.ogg" type="video/ogg">
                                                Your browser does not support HTML5 video.
                                            </video>
                                            <!--
                                                  <iframe class="video"  src="https://www.youtube.com/embed/fgExvIUYg5w">
                                                 
                                                 </iframe>-->
                                            <div class="video-select"><i class="fa fa-check select-icon"></i></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-wrap">
                        <input type="button" id="select_item_btn" class="btn btn-info btn-large" data-dismiss="modal" aria-hidden="true" name="submit" value="Set Media">
                        <input type="button" class="btn btn-large cancel cancel-dialog" data-dismiss="modal" aria-hidden="true" name="cancel" value="Cancel">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $this->start('script')?>
<?= $this->Html->script('angular.js') ?>
<script type='text/javascript'>
     var allowed = 1;
     var pre_page_name = '<?= $page->pageTitle ?>';

    function checkME(e, self) {
        var selected_type = $(self).attr('vbtype');
        var sft_type = $('#space-for-tool').attr('type');
        if (sft_type == '0') {
            $('#space-for-tool').attr('type', selected_type);
        } else if (sft_type != selected_type || sft_type === 'web' || sft_type === 'rss') {
            allowed = 0;
        } else {
            allowed = 1;
        }

    }
    function relect_for_me(id){
        $('#'+id).addClass('requested_me');
          $(":image").parent().removeClass("selected");
        $(".video-select").removeClass("video-selected");
    }

    var myApp = angular.module('myApp', []);

    function MainCtrl($scope) {
        $scope.count = <?php if(isset($scopeCount)) echo $scopeCount; else echo '0'; ?>;
        $scope.countfile = 0;
        $scope.counttext = 0;
        $scope.countlinktext = 0;
        $scope.countvideolink = 0;
         $scope.countyoutube = 0;
        $scope.countheading = 0;
        $scope.countwebllink = 0;
        $scope.countrssfeed = 0;
    }

//Directive that returns an element which adds buttons on click which show an alert on click
   myApp.directive("addimage", function () {
        return {
            restrict: "E",
            template: "<button vbtype='custom' onclick='checkME(event,this);' style='cursor:pointer' addbuttons  class='btn-type linkcustom'><span class='fa fa-picture-o' ></span>Add Images <span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
    myApp.directive("addtext", function () {
        return {
            restrict: "E",
            template: "<button vbtype='custom' onclick='checkME(event,this);' style='cursor:pointer' addtextdiv  class='btn-type linkcustom'><span class='fa fa-align-left'></span>Add Text<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
    myApp.directive("addlink", function () {
        return {
            restrict: "E",
            template: "<button vbtype='custom' onclick='checkME(event,this);' style='cursor:pointer' addlinktext  class='btn-type linkcustom'><span class='fa fa-link'></span>Add Link<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
     myApp.directive("addvideo", function () {
        return {
            restrict: "E",
            template: "<button vbtype='custom' onclick='checkME(event,this);' style='cursor:pointer' addvideolink  class='btn-type linkcustom'><span class='fa fa-video-camera'></span>Add Video<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
       myApp.directive("addyoutubevideo", function () {
        return {
            restrict: "E",
            template: "<button vbtype='custom' onclick='checkME(event,this);' style='cursor:pointer' addyoutubevideolink  class='btn-type linkcustom'><span class='fa fa-youtube'></span>Add Youtube<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
    myApp.directive("addheading", function () {
        return {
            restrict: "E",
            template: "<button vbtype='custom' onclick='checkME(event,this);' style='cursor:pointer' addheadinglink  class='btn-type linkcustom'><span class='fa fa-header'></span>Add Heading<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
    myApp.directive("addweblink", function () {
        return {
            restrict: "E",
            template: "<button vbtype='web' onclick='checkME(event,this);' style='cursor:pointer' addweblinktext  class='btn-type not-active linkweb' disabled='disabled'><span class='fa fa-wpforms'></span>Add Web View<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });
    myApp.directive("addrssfeed", function () {
        return {
            restrict: "E",
            template: "<button vbtype='rss' onclick='checkME(event,this);' style='cursor:pointer'  addrssfeedtext  class='btn-type not-active linkrss' disabled='disabled'><span class='fa fa-rss'></span>Add RSS Feed<span class='fa fa-plus plus-icon' ></span></button>"
        }
    });

//Directive for adding buttons on click that show an alert on click
    myApp.directive("addbuttons", function ($compile) {
        return function (scope, element, attrs) {

            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countfile++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin' type='vbcustom'><div style='display:flex'><input name='image-" + scope.count + "' type='text' class='form-control' file id='file-input-" + scope.countfile + "'><a onclick = 'relect_for_me(\"file-input-" + scope.countfile + "\");' name='image-select' class='img-btn' data-toggle='modal' data-target='#myModal'> Select Image </a></div><button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));
            });
        };
    });

    myApp.directive("addtextdiv", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.counttext++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin'><textarea rows='4' placeholder='Text' class='form-control'  id=text-input-" + scope.counttext + " ng-model=textfile" + scope.count + " name='text-" + scope.count + "'></textarea><button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));

            });
        };
    });

    myApp.directive("addlinktext", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countlinktext++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin'><div style='display:flex'>Link<input name='link-" + scope.count + "' type='text'  placeholder='Link' class='form-control link-input'  id=text-input-link-" + scope.countlinktext + " ng-model=linkfile" + scope.countlinktext + "> Link Caption<input name='link_caption-" + scope.count + "' type='text' placeholder='Link Caption' class='form-control link-input'  id=text-input-cap-link-" + scope.countlinktext + " ng-model=capfile" + scope.countlinktext + "></div> <button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));

            });
        };
    });
     myApp.directive("addvideolink", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countvideolink++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin'><div style='display:flex'><input name='video-" + scope.count + "' type='text' class='form-control' file id='text-input-video" + scope.countvideolink + "'><a onclick = 'relect_for_me(\"file-input-" + scope.countvideolink + "\");' name='video-select' class='img-btn' data-toggle='modal' data-target='#myModal'> Select Video </a></div><button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));

            });
        };
    });
  myApp.directive("addyoutubevideolink", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countyoutube++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin'><div style='display:flex'>Video Link<input name='youtube-" + scope.countyoutube + "' type='text'  placeholder='Youtube Video Link' class='form-control'  id=text-input-youtube-video-" + scope.countyoutube + "></div> <button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));

            });
        };
    });

    myApp.directive("addheadinglink", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countheading++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin'><input name='heading-" + scope.count + "' type='text'  placeholder='Heading' class='form-control'  id=text-input-head-" + scope.countheading + " ng-model=headingfile" + scope.countheading + "><button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));

            });
        };
    });


    myApp.directive("addweblinktext", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countweblink++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin'><input name='web-" + scope.count + "' type='text'  placeholder='Web Link' class='form-control'  id=text-input-wenlink-" + scope.countweblink + " ng-model=weblink" + scope.countweblink + "><button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));

            });
        };
    });

    myApp.directive("addrssfeedtext", function ($compile) {
        return function (scope, element, attrs) {
            element.bind("click", function () {
                if (allowed === 0) {
                    alert('Please remove existing widget,to add this widget.');
                    return;
                }
                scope.count++;
                scope.countrssfeed++;
                angular.element(document.getElementById('space-for-tool')).append($compile("<div class='remove-" + scope.count + " push-margin id='vbrss'><input name='rss-"+ scope.count +"' type='text'  placeholder='Rss Feed' class='form-control'  id=text-input-rssfeed-" + scope.countrssfeed + " ng-model=rssfeed" + scope.countrssfeed + "><div class='desc'> Description tags to read feed</div><div style='display:flex'><input name='parent-"+scope.count+"' type='text'  placeholder='Parent' class='form-control link-input' id=text-parent-" + scope.countrssfeed + "></div><div style='display:flex'><input name='title-"+scope.count+"' type='text' placeholder='Title' class='form-control link-input' id=text-title-" + scope.countrssfeed + "><input name='rss_link-"+scope.count+"' type='text'  placeholder='Link' class='form-control link-input' id=text-link-" + scope.countrssfeed + "></div><div style='display:flex'><input name='date-"+scope.count+"' type='text' placeholder='Date' class='form-control link-input'  id=text-date-" + scope.countrssfeed + "><input name='description-"+scope.count+"' type='text'  placeholder='Description' class='form-control link-input' id=text-desc-" + scope.countrssfeed + "></div><button name='remove' class='btn-remove' id=remove-" + scope.count + " remove-me>Remove</button><div class='hr-line'><hr></div></div>")(scope));


            });
        };
    });



    myApp.directive("removeMe", function ($rootScope) {
        return function (scope, element, attrs)
        {
            element.bind("click", function () {

                var id = attrs['id'];

                $("." + id).remove();
                var len = $('#space-for-tool').children().length;
                if (  len === 0 ) {
                    allowed = 1;
                    $('#space-for-tool').attr('type', '0');
                }
            });
        }

    });

    $(document).ready(function () {
       var url = '/getgalleryitems';
        $.ajax({
            type: "post",
            url: url,
            data: null,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (!data) {
                    alert('Access Denied.');
                    return false;
                }
                if (data === 1) {
                    $('#item_list').html('<h3>Please add gallery items.</h3>');
                }

                var html = '';
                $.each(data, function (key, json) {
                    if (json.itemType === 1) {
                        html += '<div class="col-lg-2 col-md-3 col-xs-6 thumb">' +
                                '<a class="thumbnail" value="<?= 'http://'.$_SERVER['SERVER_NAME'] ?>/' + json.itemUrl + '">' +
                                '<input type="image" class="img-responsive img" src="../' + json.itemUrl + '" alt=""></a></div>';
                    } else {
                        // html +=   '<div class="col-lg-2 col-md-3 col-xs-12 thumb">'+

                        //     '<video class="video" controls>'+
                        //          '<source src="../'+ json.itemUrl+'" type="video/mp4">'+
                        //'<source src="http://localhost/upload/video.ogg" type="video/ogg">'+
                        //           'Your browser does not support HTML5 video.'+
                        //             '</video></div>';    

                    }
                });
                $('#img_list').html(html);
                reload_now();
            },
            failure: function (errMsg) {
                alert(errMsg);
            }
        });
        
        $('#select_item_btn').on('click',function(){
            var src = $('.selected').attr('value');
            $('.requested_me').val(src);
            var id = $('.requested_me').attr('id');
            $('#'+id).removeClass('requested_me');
            
        });

        $(':radio').change(function (e) {

            var value = $(this).val();
            if (value == "1") {
                $('.linkrss').attr("disabled", "disabled");
                $('.linkrss').addClass("not-active");
                $('.linkweb').attr("disabled", "disabled");
                $('.linkweb').addClass("not-active");
                $('.linkcustom').removeAttr("disabled");
                $('.linkcustom').removeClass("not-active");
            }
            else if (value == "2") {
                $('.linkrss').attr("disabled", "disabled");
                $('.linkrss').addClass("not-active");
                $('.linkcustom').attr("disabled", "disabled");
                $('.linkcustom').addClass("not-active");
                $('.linkweb').removeAttr("disabled");
                $('.linkweb').removeClass("not-active");
            }
            else {
                $('.linkweb').attr("disabled", "disabled");
                $('.linkweb').addClass("not-active");
                $('.linkcustom').attr("disabled", "disabled");
                $('.linkcustom').addClass("not-active");
                $('.linkrss').removeAttr("disabled");
                $('.linkrss').removeClass("not-active");
            }
        });
    });


    function openfileDialog() {
        $("#fileLoader").click();
    }
 function reload_now(){   
    $(":image").click(function () {
        $(":image").parent().addClass("not-select");
        $(this).parent().addClass("selected");
        $(this).parent().removeClass("not-select");
    });
    $(".cancel-dialog").click(function () {
        $(":image").parent().removeClass("selected");
        $(".video-select").removeClass("video-selected");
    });

    $(".video-select").click(function () {
        $(".video-select").removeClass("video-selected");
        $(this).addClass("video-selected");
        $(this).removeClass("video-not-select");
    });
    }
    $(document).ready(function () {
        /* $('#page').keydown(function(e) { 
         if (e.which === 32) {
         return false;
         }
         });*/
        $('#page').on('blur', function (e) {
            $('#page_loader').css('display', 'block');
            var pagename = $(this).val();
            if(pagename === pre_page_name){
                 $('#page_loader').css('display', 'none');
                e.preventDefault();
                return false;
            }
            $.post('/pagenameavailable', {page: pagename}, function (result) {
                if (result === '1') {
                    $('#page_loader').css('display', 'none');
                    $('#page_name_check_msg').css('display', 'block');
                    $('#page_name_check_msg').html('<i style="color:green">Correct page name.<i>');
                } else {
                    $('#page_loader').css('display', 'none');
                    $('#page_name_check_msg').css('display', 'block');
                    $('#page').css({'border': '1px solid red'});
                    $('#page_name_check_msg').html('<i style="color:red">Incorrect page name.Choose another.<i>');
                    //e.preventDefault();
                    return false;
                }
            });
        });
        
        $('.cancel_page').on('click', function(){
            document.location.replace('/pages');
        });
    });
</script>  

<?php $this->end('script')?>