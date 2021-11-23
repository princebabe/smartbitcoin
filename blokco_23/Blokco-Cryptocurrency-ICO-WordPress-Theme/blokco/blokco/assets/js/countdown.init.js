jQuery(function($){
	"use strict";
	
	$('.imi-countdown-timer').each(function(){
		var expiryDate = $(this).data('date');
		var countdown_id = $(this).attr('id');
		$('#'+countdown_id).countdown(expiryDate).on('update.countdown', function(event) {
	  $(this).html(event.strftime(''+ '<div class="imi-timer-col"><span>%D</span> <strong>'+initval.day+'</strong></div>' + '<div class="imi-timer-col"><span>%H</span> <strong>'+initval.hr+'</strong></div>' + '<div class="imi-timer-col"><span>%M</span> <strong>'+initval.min+'</strong></div>' + '<div class="imi-timer-col"><span>%S</span> <strong>'+initval.sec+'</strong></div>'));
		});
	});
	
});