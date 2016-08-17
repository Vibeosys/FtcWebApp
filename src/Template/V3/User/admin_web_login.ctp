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
     <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
  <script>
    var OneSignal = OneSignal || [];
    OneSignal.push(["init", {
      appId: "d7d678e9-7cd4-4e9d-b823-3f172572ef74",
      autoRegister: true, /* Set to true to automatically prompt visitors */
      subdomainName: 'ftctradenow',   
      notifyButton: {
          enable: true /* Set to false to hide */
      }
    }]);
  </script>    
       
    </head>
   <body class="login-page">
       
     <section class="login">
        <div class="logo-header"><div  class="company-logo"></div>  </div>
        <form name="loginform" id="loginform"  method="post">
            <p>
		<label for="user_login">User Name<br />
                    <input type="text" name="username" id="user_login" onfocus ="removeb('user_login')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" onfocus="removeb('user_pass')" aria-describedby="login_error" class="input" value="" size="20" /></label>
	</p>
    	<p>
		<label for="subscribe_id">Subscription Id<br />
		<input type="text" name="subscribeid" id="subscribe_id" onfocus="removeb('subscribe_id')" aria-describedby="login_error" class="input" value="" size="20" ></label>
	</p>
		
	<div class="submit">
          <div class="check-style">
	<input  type="checkbox" value="None" id="check_box" name="check" class="terms-check" />
	<label for="check_box"></label>
        </div>   
        <span class="terms-cond">
            <span class="terms-content">I agree to the <a href="" data-toggle="modal" data-target="#myModal" >Terms of use.</a></span>
        </span>
            
        <span class="btn-login">
            <input type="button" id="ftc-submit" class="btn btn-primary btn-large" value="Login" name="login-btn">
         </span>
           <!-- <span id="error_check" class="error-check">Please read terms & conditions.</span>    -->
	</div>
        <span style="display: none" id="check_er" class="error-check">Please agree with terms and conditions before login.</span>    
        <img id="log_loader" style="width: 27px;margin: 0px 114px;display: none;position:relative;top:20px;" src="../img/log_loader.gif" alt="Please Wait" />
        <p class="text-center" id="log_msg" style=" display: none;color: red;font-size: 15px"></p>  
        </form>
       
       </section>
       
       <div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Terms and Conditions</h4>

            </div>
            <div class="modal-body">
               
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <strong class="terms">  Terms</strong> <br>
<p>
    By accessing this Mobile APP “Trade Now” created by FTC Solutions, you are agreeing to be bound by our Terms of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this Mobile APP. The materials, services and software contained in this Mobile APP are protected by applicable copyright, trade mark and service mark law.</p>
<ol>
    <li class="terms">Use License</li>
    <ul class="in_terms">
        <li>Permission is granted to download “Trade Now” for personal and commercial use only. You may use the Mobile APP to assist in your business but you are not able to resell this Mobile APP in the market. This is the grant of a license and not a transfer of title. </li>
        <li>Information and data in the Mobile APP is obtained from sources believed to be reliable, but accuracy is not guaranteed. Neither the information, nor any opinion expressed, constitutes a recommendation to purchase or sell a security, or to provide investment advice.</li>
 <li>The Mobile APP may be non-functioning, malfunctioning or inaccessible for any reason, including, without limitation: (i) hardware issues and failures; (ii) network failures or no internet connectivity; (iii) software failures or programming errors; or (iv) periodic maintenance or repairs which FTC Solutions may undertake.</li>
 <li>Stocks, Forex, Futures and Options Trading has large potential rewards, but also large potential risk. You must be aware of the risks and be willing to accept them in order to invest in the Futures Options and Currency markets. Don’t trade with money you can’t afford to loose. This Mobile APP is neither a solicitation nor an offer to BUY/SELL FX, Futures or Options. No representation is being made that any account will or is likely to achieve profits or loses similar to those discussed on “Trade Now”. THE PAST PERFORMANCE OF ANY TRADING SYSTEM OR METHODOLOGY IS NOT NECESSARILY INDICATIVE OF FUTURE RESULTS.</li>
 <li>Hypothetical or Simulated performance results have certain limitations. Unlike an actual performance record, simulated results do not represent actual trading. Also, since the trades have not been executed, the results may have under-or-over compensated for the impact, if any, of certain markets factors, such as lack of liquidity. Simulated trading programs in general are also subject to the fact that they are designed with the benefit of hindsight. NO REPRESENTATION IS BEING MADE THAT ANY ACCOUNT WILL OR IS LIKELY TO ACHIEVE PROFIT OR LOSSES SIMILAR TO THOSE SHOWN IN THE MOBILE APP.</li>
 <li>Subscribing to “Trade Now” which is a service provided by FTC Solutions constitutes acknowledgement of, acceptance of, and consent to: (i) the terms of these Terms of Use; (ii) the Purchase Policy (iii) the disclaimers of warranties, limitations and indemnification; (iv) acceptance of the terms of the Privacy Policy, thereby creating a privacy agreement; and (v) the indication of your electronic signature, thereby creating a valid and legally enforceable contract.</li>
 <li>When you purchase a full license of our product there is no refund available due to the nature of this product as once you download the software product online you have complete access to our intellectual property including in some cases source codes.</li>
 <li>We provide support for all our products and some of them come with user guides and video tutorials. Although we do provide 24x7 support we are not able to and do not guarantee a response to all queries within 24 hrs. We also provide professional support for non-technical customers at agreed additional cost. We are not responsible to teach all technical aspect of the product. Once a product is installed on your server and is successfully running we take no responsibility if it stops functioning due to issues with your hosting provider or other technical reasons that is deemed beyond our control.</li>
 <li>This license shall automatically terminate if you violate any of these restrictions and may be terminated by FTC Solutions at any time. Upon terminating your viewing of these materials, use of the services or upon the termination of this license, you must destroy any downloaded materials or software in your possession whether in electronic or printed format.</li>
        </ul>
        <li class="terms">Disclaimer</li>
        The materials and services on “Trade Now” are provided “as is”. FTC Solutions makes no warranties, expressed or implied, and hereby disclaim and negate all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, “Trade Now” does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials, services or software advertised in the APP or otherwise relating to such materials, services, software or any sites linked to this site.</p>
<li class="terms">Limitations</li>
In no event shall FTC Solutions or its clients be liable for any direct, indirect, punitive, incidental, special, or consequential damages (including, without limitation, damages for loss of capital or profit) arising out of the use of or inability to use the materials, services or software on “Trade Now”, even if FTC Solutions has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow the exclusion or limitation of incidental or consequential damages, FTC Solutions liability in such jurisdictions shall be limited to the maximum extent permitted by law of your jurisdiction.
<li class="terms">Indemnification</li>
You agree to defend, indemnify, and hold harmless FTC Solutions its owners, clients, and their employees, contractors, officers, agents and directors from all liabilities, claims, and expenses, including attorney’s fees, that arise from your use of this site, any services, software or any information from this site, or any violation of this Agreement.
FTC Solutions reserves the right, at its own expense, to assume the exclusive defence and control of any matter otherwise subject to indemnification by you, in which event you shall cooperate with FTC Solutions in asserting any available defences.
<li class="terms">Revisions and Errata</li>
The materials appearing on “Trade Now” could include technical, typographical, or photographic errors. FTC Solutions does not warrant that any of the materials on the Mobile APP are accurate, complete, or current. The subscribers of “Trade Now” may make changes to some of the materials contained on the APP at any time without notice. FTC Solutions does not, however, make any commitment to update the materials.
<li class="terms">Links</li>
FTC Solutions has not reviewed all of the sites linked to “Trade Now” and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by FTC Solution or its’ subscribers of the site. Use of any such linked web site is at the user’s own discretion and risk.
<li class="terms"> Site Terms of Use Modifications</li>
FTC Solutions may revise these terms of use for its Mobile APP “Trade Now” at any time without notice. By using this Mobile APP you are agreeing to be bound by the then current version of these Terms of Use.
</ol>

                    </div>
                <div class="modal-footer">

                    </div>
            </div>
        </div>
    </div>
</div>
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
                  var url = '/v3/userSubLogin';
                  var request = '{"username":"' +uname +'","pwd":"' +pass+ '","subscriberId":"' +sId+ '", "weblogin":1}';
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
                  }else if(!$('#check_box').is(':checked')){
                    $('#check_er').css('display', 'block'); 
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

