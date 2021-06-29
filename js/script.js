/* $(function() {
    $('#confirm_btn').click(function(){
        $('#entry_btn').removeAttr('disabled');
    });
});

$(function() {
    $('#back_btn').click(function(){
        history.back();
    });
});

$(function () {
    $('[name=payment_method]').change(function() {
        var val = $(this).val();
        if(val === 'credit') {
            $('#credit').show();
            $('#convini').hide();
            $('#credit input').prop('required', true);
            $('#convini select').prop('required', false);
        }
        else if(val === 'convini') {
            $('#convini').show();
            $('#credit').hide();
            $('#credit input').prop('required', false);
            $('#convini select').prop('required', true);
        }
        else {
            $('#convini').hide();
            $('#credit').hide();
            $('#credit input').prop('required', false);
            $('#convini select').prop('required', false);
        }
    });
});

$(function() {
    $('table').on('click','tr button',function(e){
        e.preventDefault();
       $(this).parents('tr').remove();
    });
}); */

$(function(){
    $("#header").load("header.html");
    $("#footer").load("footer.html");
});

//formで変更された部分だけsubmitする処理
$(document).ready(function() {
  $('input, select, textarea').on('change', function() {
    $(this).addClass('changed');
  });
  
  $('form').on('submit', function() {
    $('input:not(.changed), select:not(.changed),  textarea:not(.changed)').prop('disabled', true);
  });
});