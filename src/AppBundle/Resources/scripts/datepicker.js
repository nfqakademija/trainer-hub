
$(document).ready(function() {
	    jQuery('input.js-datepicker').each(function() {
		    jQuery(this).wrapAll("<div class='input-group date datetimepicker1'></div>");
		    jQuery(this).after('<span class="input-group-addon js-datepicker"><span class="glyphicon glyphicon-calendar"></span></span>');
		    $('.datetimepicker1').datetimepicker({
		    		format: 'YYYY-MM-DD HH:mm',
		    		minDate: moment(),
		    		locale: 'lt'
		    	});
		});
	    jQuery('a.add_date_link').on('click', function() {
	        jQuery(this).closest('p').prev('li').find('.js-datepicker').after('<span class="input-group-addon js-datepicker"><span class="glyphicon glyphicon-calendar"></span></span>');
	    	jQuery(this).closest('p').prev('li').find('.js-datepicker').wrapAll("<div class='input-group date datetimepicker1'></div>");
	    	$('.datetimepicker1').datetimepicker({
	    		format: 'YYYY-MM-DD HH:mm',
	    		minDate: moment(),
	    		locale: 'lt'
	    	});
	    });    
 });
 
