$(function () {
	$('.event-list').slimscroll({
            height: '305px',
            wheelStep: 20
        });
		
    $('.evnt-input').keypress(function (e) {
        var p = e.which;
        var inText = $('.evnt-input').val();
        if (p == 13) {
            if (inText == "") {
                alert('Empty Field');
            } else {
				$.ajax({
					url: 'notes_gest.php?method=addnotes&data='+inText+'&id_imm='+$('#id_imm').val(),
					type: 'GET',
					dataType: 'json',
					success: function(s){
						if(s.status == 'success')
                         $('<li id="'+s.id+'">' + inText + '<a href="#"" class="event-close"> &#10005; </a> </li>').appendTo('.event-list');
					},
					error: function(e)
					{
						console.log('error');
					}
				});
            }
            $(this).val('');
            $('.event-list').scrollTo('100%', '100%', {
                easing: 'swing'
            });
            return false;
            e.epreventDefault();
            e.stopPropagation();
        }
    });
	
	 $(document).on('click', '.event-close', function () {
		var id = $(this).closest("li").attr('id');
				$.ajax({
					url: 'notes_gest.php?method=delnotes&id='+id+'&id_imm='+$('#id_imm').val(),
					type: 'GET',
					dataType: 'json',
					success: function(s){
						if(s.status == 'success')
						 $('#'+id).remove();
					},
					error: function(e)
					{
						console.log('error');
					}
				});
        return false;
    });
    
    
	 $(document).on('click', '.visita-close', function () {
		var id = $(this).closest("li").attr('id');
				$.ajax({
					url: 'immobile_visita_del.php?method=delnotes&id_visita='+id+'&id_imm='+$('#id_imm').val(),
					type: 'GET',
					dataType: 'json',
					success: function(s){
						if(s.status == 'success')
						 $('#'+id).remove();
					},
					error: function(e)
					{
						console.log('error');
					}
				});
        return false;
    });
});
