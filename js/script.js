$(document).ready(function () {
	
	$('#cari').hide();

	
	$('#keyword').on('keyup', function() {

		$('.loader').show();
		//jquery	
		// $('#container').load('ajax/kamar11.php?keyword=' + $('#keyword').val());


		//jquery menggunakan $.get
		$.get('ajax/kamar11.php?keyword=' + $('#keyword').val(), function(data) {
		$('#container').html(data);
		$('.loader').hide();
	});
	});


});