   var globle = 0;
    var n_msg = 'Please remove existing widget,to add this widget.';
    var n_bg = 'red';
    var n_type = 'warning';   

 function create_note(msg,bgcolor,type){
        $('#notify').css('display','block');
     var new_note = '<li><div id="new_note_'+globle+'" class="alert ui-pnotify-container" style="margin-left: 20px;background-color:'+ bgcolor +';min-height: 16px; overflow: hidden;width: 290px;float: right;">'+
                        '<div class="ui-pnotify-closer" style="display:none;cursor: pointer;">'+
                        '<span class="glyphicon glyphicon-remove" title="Close"></span></div>'+
                        '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-'+ type +'-sign"></span></div>'+
                        '<div style="padding-top:10px" class="ui-pnotify-text notef_text">'+ msg +'</div>'+
                        '<div style="margin-top: 5px; clear: both; text-align: right; display: none;"></div></div></li>';
                 $('#notify ul').prepend(new_note);
          $('#new_note_'+globle).fadeOut(5000);
           globle++;
    }