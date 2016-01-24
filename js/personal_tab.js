$(function(){

	$('.bundle').each(function () {
		var id_bundle = this.id.substr(4);
		$('#bundle_'+id_bundle).html($('#tmp_'+id_bundle).html());
    	$('#tmp_'+id_bundle).html('');
	});



});
