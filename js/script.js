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



$(function() {
    $('table').on('click','tr button',function(e){
        e.preventDefault();
       $(this).parents('tr').remove();
    });
}); */

$(function(){
    $("#header").load("header.php");
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

$(function () {
	$('[name=content_category]').change(function() {
			var val = $(this).val();
			if(val === 'news') {
				$('#news').show();
				$('#hal').hide();
				$('#aeon').hide();
			}
			else if(val === 'hal') {
				$('#news').hide();
				$('#hal').show();
				$('#aeon').hide();
			}
			else {
				$('#news').hide();
				$('#hal').hide();
				$('#aeon').show();
			}
	});
});