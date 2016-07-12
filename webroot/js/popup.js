 $(function(){

if(is_admin){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
}


$('.close-btn').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
$('#page_viewer').val($(this).val());
return false;
});


$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});