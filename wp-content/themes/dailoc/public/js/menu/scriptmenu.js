(function($) {
	$.fn.menumaker = function(options) {
		var navigation = $(this), settings = $.extend({
			title: "Danh mục",
			format: "dropdown",
			sticky: false
		}, options);

		return this.each(function() {
			navigation.prepend('<div id="menu-button">' + settings.title + '</div>');
			$(this).find("#menu-button").on('click', function(){
				$(this).toggleClass('menu-opened');
				var mainmenu = $(this).next('ul');
				if (mainmenu.hasClass('open')) {
					mainmenu.hide().removeClass('open');
				}
				else {
					mainmenu.show().addClass('open');
					if (settings.format === "dropdown") {
						mainmenu.find('ul').show();
					}
				}
			});

			navigation.find('li ul').parent().addClass('has-sub');

			multiTg = function() {
				navigation.find(".has-sub").prepend('<span class="submenu-button"></span>');
				navigation.find('.submenu-button').on('click', function() {
					$(this).toggleClass('submenu-opened');
					if ($(this).siblings('ul').hasClass('open')) {
						$(this).siblings('ul').removeClass('open').hide();
					}
					else {
						$(this).siblings('ul').addClass('open').show();
					}
				});
			};

			if (settings.format === 'multitoggle') multiTg();
			else navigation.addClass('dropdown');

			if (settings.sticky === true) navigation.css('position', 'fixed');
		});
	};
})(jQuery);


(function($){
	$(document).ready(function(){
		$(document).ready(function() {
			$("#navigation").menumaker({
				title: "Danh mục",
				format: "multitoggle"
			});
		});
	});
})(jQuery);