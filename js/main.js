
;(function($) {

	window.main = {
		init: function(){

			$('a[href^=#].scroll-to-btn').click(function(){
				var target = $($(this).attr('href'));
				var offsetTop = (target.length != 0) ? target.offset().top : 0;
				//$('body, html').animate({scrollTop: offsetTop}, 500, 'easeInOutQuad');
				return false;
			});

			$('.mobilenav').on('click', function() {
				console.log('click');
				var navigation = $('#header .main-navigation');
				if(navigation.is(':visible')){
					navigation.slideUp();
				} else {
					navigation.slideDown();
				}
			});

			$('.selectbox.petrol').append('<span data-icon="1" class="icon"></span>');
			$('.selectbox.gear').append('<span data-icon="2" class="icon"></span>');
			// $('.gform_footer').prepend('<a class="submit_button">Submit</a>');	
			// $('.submit_button').on('click', function(event) {
			// 	event.preventDefault();
			// 	$('.gform_button').click();
			// });

			$("select").selecter();
		},


		loaded: function(){
			// $('.row .container').eqHeights();
			this.setBoxSizing();
		},

		setBoxSizing: function(){
			if( $('html').hasClass('no-boxsizing') ){
		        $('.span:visible').each(function(){
		        	console.log($(this).attr('class'));
		        	var span = $(this);
		            var fullW = span.outerWidth(),
		                actualW = span.width(),
		                wDiff = fullW - actualW,
		                newW = actualW - wDiff;
		 			
		            span.css('width',newW);
		        });
		    }
		},		

		
		resize: function(){
		}
	}

	$(function(){
		main.init();
	});

	$(window).load(function(){
		main.loaded();
	});

})(jQuery);
