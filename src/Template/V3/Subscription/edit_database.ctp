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
    $this->assign('title', 'Edit Database');
    $this->assign('database','1');
    
?>

<section class="page-section" ng-app="myApp" ng-controller="MainCtrl">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 main-page">
                <div class="heading">
                    <h2>Edit Database</h2>
                    <?php if(isset($message)){ ?>
                        
                    <span style="border: 1px solid #d2d0d0;padding: 10px;margin-left: 7%;color:<?= $color ?>"><?= $message ?> 
                       </span>
                    <a   style="border: 1px solid;padding: 10px;margin-left: 7%;text-decoration: none;" href="../database"> Back to List</a>
                    <?php } ?>

                </div>
                <?php if(isset($edit)) {?>
                <form name="editDatabase" id="editDatabase" action="edit" method="post">
                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text"  id="user_login_id" size="100" placeholder="" value="<?= $edit->subscriberId ?>" disabled/>
                             <input name="subscriberId" type="hidden" value="<?= $edit->subscriberId ?>">
                    <label class="input__label input__label--hoshi dis input__label--hoshi-color-2" for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Subscription Id</span>
                    </label>
                </span> 
                    </p>
                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text" name="hostname" id="host" size="100" placeholder="" value="<?= $edit->hostname ?>"/>
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi"> Host Name</span>
                    </label>
                </span> 
                    </p>
                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text" name="dbname" id="db_name" size="100" placeholder="" value="<?= $edit->dbname ?>" />
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi"> Database Name</span>
                    </label>
                </span> 
                    </p>
                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text" name="port" id="port" size="100" placeholder="" value="<?= $edit->port ?>" />
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Port</span>
                    </label>
                </span> 
                    </p>                        
                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text" name="dbuname" id="db_uname" size="100" placeholder="" value="<?= $edit->dbuname ?>"/>
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi"> User Name</span>
                    </label>
                </span> 
                    </p>

                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text"  name="pwd" id="db_pass" size="100" placeholder="" value="<?= $edit->pwd ?>" />
                    <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Password</span>
                    </label>
                </span> 
                    </p>
                    <p>
                        <span class="input input--hoshi input-76">
                    <input class="input__field input__field--hoshi title-input" type="text" name="owner" id="owner_subscribe_id" size="100" placeholder="" value="<?= $edit->owner ?>"  disabled/>
                    <label class="input__label input__label--hoshi dis input__label--hoshi-color-2" for="input-4">
                        <span class="input__label-content input__label-content--hoshi">Owner</span>
                    </label>
                </span> 
                    </p>
                    <div>
                        <div class="test-btn">
                            <a id="test_connect" class="btn btn-success test" >Test Connection</a>
                              <img id="page_loader" style="width: 38px;margin: 0px 13px;padding-top: 5px;display: none" src="../img/log_loader.gif" alt="Please Wait">
                          <p  id="test_msg" style="padding-left: 180px; display: none;color: red;font-size: 15px"></p>  
                          <input type="hidden" id="flag" value="1" >
                        </div>
                        <div class="edit-database-btn text-center center-block">
                            <button type="submit" name="save" id="ftc-save" class="btn btn-primary db" >Save</button>
                            <button id="ftc-cancel" class="btn  db">Cancel</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?= $this->start('script') ?>
<script type="text/javascript">
    $(document).ready(function(){
        
        
      
        $('#test_connect').on('click', function(){

        $('#page_loader').css('dispaly', 'block');
            $('#test_connect').val('Connecting...');
        var url = "/testdb";
        var host = $('#host').val();
        var db_name = $('#db_name').val();
        var port = $('#port').val();
        var db_uname = $('#db_uname').val();
        var db_pass = $('#db_pass').val();
         var request = '{"hostname":"' +host +'","pwd":"' +db_pass+ '","dbuname":"' +db_uname+ '","port":"' +port+ '","dbname":"' +db_name+ '"}';
        $.ajax({
            type: "POST",
            url: url,
            data: '{"user":"{}","data" :' + JSON.stringify(request) + '}',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                var json = $.parseJSON(data);
                if(json.errorCode === 0){
                     $('#test_msg').css('color', 'green');
                     $('#flag').val('1');
                }
                $('#test_connect').val('Test Connection');
                $('#page_loader').css('dispaly', 'none');
                $('#test_msg').css('display', 'block');
                $('#test_msg').text(json.message);
            },
            failure: function (errMsg) {
                $('#log_mesg').text('Incorrect username or password');
                $('#test_connect').val('Test Connection');
                   $('#page_loader').css('dispaly', 'none');
                alert(errMsg);
            }
        });
        });
        
        $('.change').on('blur', function(){
            $('#flag').val('0');
        });
        
     $(':submit').on('click', function(e){
         if($('#flag').val() != 1){
             alert('Please test connection before save.');
             e.preventDefault();
             return false;
         }
     });
		
	   $('#ftc-cancel').on('click', function(e){
       window.location.replace('../../database');
       e.preventDefault();
     });  
    });
    
    
</script>   
     <?= $this->end('script') ?>