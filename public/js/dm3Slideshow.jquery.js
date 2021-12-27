/*
 * Slideshow jQuery plugin for the front page of "Different" template
 * author: dm3studio
 * version: 1.0
 */
(function($) {	
	// Slider class
	function dmSlider(container, options) {
		// Define default options
		this.options = $.extend({
			speed: 400,
			autoScrollInterval: 4000,
			autoScroll: false
		}, options);
		
		delete options;
		
		// Define common variables
		this.current = 0;
		this.prev = 0; 
		this.container = $(container);
		this.wait = false;
		this.autoScrollInterval = null;
		this.items = this.container.children('ul:first').children();
		this.itemsNum = this.items.length;
		this.stop = false;
		
		// Set defaults to all slides
		for (var i = 0; i < this.itemsNum; ++i) {
			var slide = this.items.eq(i);
			var img = slide.find('img:first');
			
			// Hide all slides except the first slide
			if (i > 0)
				slide.css({'z-index': '0', display: 'none'});
			
			slide.css({
				'background-image': 'url(' + img.attr('src') + ')',
				'background-size': $(window).width() < 1200 || $(window).width() > 1920 ? '100%' : 'auto',
				'height': img.css('height')
			});
			
			img.remove();
		}
		
		var that = this;
		
		var controlsContainer = this.container.find('.slideshow-controls:first');
		var controls = controlsContainer.children('a');
		
		controls.eq(0).bind('click', function(event) {
			event.preventDefault();
			that.changeImage('prev');
		});
		
		controls.eq(1).bind('click', function(event) {
			event.preventDefault();
			var a = $(this);
			if (a.hasClass("start")) {
				that.startAutoScroll();
				a.removeClass("start").addClass("pause");
			} else {
				that.stopAutoScroll();
				a.removeClass("pause").addClass("start");
			}
		});
			 
		controls.eq(2).bind('click', function(event) {
			event.preventDefault();
			that.changeImage('next');
		});
		
		controlsContainer.css('opacity', 0);
		
		this.container.hover(function() {
			that.stop = true;
			controlsContainer.stop().animate({opacity: 1}, 'fast');
		}, function() {
			that.stop = false;
			controlsContainer.stop().animate({opacity: 0}, 'fast');
		});
		
		// Initialize auto scrolling
		if (this.options.autoScroll == true && this.items.length > 1) {
			this.startAutoScroll();
			controls.eq(1).removeClass("start").addClass("pause");
		}
	};
	
	dmSlider.prototype.changeImage = function(dir) {
		if (this.wait == true)
			return;

		this.wait = true;
		this.prev = this.current;
		
		// Find the next and prev image
		if (dir == 'next') {
			this.current += 1;
			this.current = (this.current >= this.itemsNum) ? 0 : this.current;
		} else {
			this.current -= 1;
			this.current = (this.current < 0) ? this.itemsNum - 1 : this.current;
		}
		
		this.go();
	};
	
	dmSlider.prototype.go = function() {
		// Hide previous item
		this.items.eq(this.prev).css({'z-index': 0, display: 'block'});
		// Show new item
		var that = this;
		this.items.eq(this.current).css({'z-index': 2, 'opacity': 0, display: 'block'}).animate({opacity: 1}, this.options.speed, function() {
			that.items.eq(that.prev).css({display: 'none'});
			that.wait = false;
		});
	};
	
	dmSlider.prototype.startAutoScroll = function() {
		var that = this;
		this.autoScrollInterval = setInterval(
			function() {
				if (that.stop == false)
					that.changeImage(that.options.animation, 'next');
			},
			this.options.autoScrollInterval
		);
	};
	
	dmSlider.prototype.stopAutoScroll = function() {
		clearInterval(this.autoScrollInterval);
	};
	
	$.fn.dm3Slideshow = function(options) {
		this.each(function() {
			var DmSlider = new dmSlider(this, options);
		});
	};
})(jQuery);