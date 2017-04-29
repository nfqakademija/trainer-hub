jQuery(document).ready(function() {
	jQuery('body').on('change', 'select.cities', function() {
        jQuery.post( jQuery('select.cities').data('path'), { city: jQuery(this).val() }, function( data ) {
        	console.log('xx');
		    jQuery('.trainers').html(data);
		}, "json");
	});
});