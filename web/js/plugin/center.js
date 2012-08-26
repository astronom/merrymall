(function($) {

	$.fn.center = function() {

		var element = this;

		$(element).load(function() {

			changeCss();

			$(window).bind("resize", function() {
				changeCss();
			});

			function changeCss() {

				var objectHeight = $(element).height();
				var objectWidth = $(element).width();
				var windowWidth = $(window).width();
				var windowHeight = $(window).height();

				$(element).css({
					"position" : "absolute",
					"left" : windowWidth / 2 - objectWidth / 2,
					"top" : windowHeight / 2 - objectHeight / 2
				});
			};
		});

	};

})(jQuery);