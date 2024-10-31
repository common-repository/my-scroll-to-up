jQuery(document).ready(function($){

(function($){$.fn.backToTop=function(options){var $this=$(this);$this.hide().click(function(){$("body, html").animate({scrollTop:"0px"});});var $window=$(window);$window.scroll(function(){if($window.scrollTop()>0){$this.fadeIn();}else{$this.fadeOut();}});return this;};})(jQuery);jQuery('body').append('<a class="back-to-top"><i class="fa fa-angle-up"></i></a>');jQuery('.back-to-top').backToTop();

jQuery('.accordion-item').each(function(){if(jQuery(this).find('.accordion-title a').hasClass('collapsed')){jQuery(this).removeClass('active');}else{jQuery(this).addClass('active');}
jQuery(this).find('.accordion-title a').click(function(){if(jQuery(this).hasClass('collapsed')){jQuery(this).parents('.accordion-item').addClass('active');}else{jQuery(this).parents('.accordion-item').removeClass('active');}});});




});