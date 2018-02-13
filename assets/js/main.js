(function($) {

	skel.breakpoints({
		xlarge: '(max-width: 1680px)',
		large: '(max-width: 1140px)',
		medium: '(max-width: 980px)',
		small: '(max-width: 736px)',
		xsmall: '(max-width: 480px)',
		xxsmall: '(max-width: 320px)'
	});

	$(function() {

		var	$window = $(window),
			$body = $('body');
			$header = $('#header');
			$nav = $('#nav');
			$navbar = $('#navbar');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 250);
			});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Scrolly.
			$('.scrolly').scrolly({
				speed: 1000,
				offset: -10,
				offsetY: -1
			});

		// Dropdowns.
			$('#nav > ul').dropotron({
				mode: 'fade',
				offsetX: -10,
				noOpenerFade: true,
				expandMode: (skel.vars.touch ? 'click' : 'hover')
			});


		// Off-Canvas Navigation.

			// Navigation Button.
				$(
					'<div id="navButton">' +
						'<a href="#navPanel" class="toggle"></a>' +
					'</div>'
				)
					.appendTo($body);

			// Navigation Panel.
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').navList() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body)
					.panel({
						delay: 500,
						hideOnClick: true,
						hideOnSwipe: true,
						resetScroll: true,
						resetForms: true,
						side: 'left',
						target: $body,
						visibleClass: 'navPanel-visible'
					});

			// Fix: Remove navPanel transitions on WP<10 (poor/buggy performance).
				if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
					$('#navButton, #navPanel, #page-wrapper')
						.css('transition', 'none');

		// Header.
		// If the nav is using "alt" styling and #header is present, use scrollwatch
		// to revert it back to normal styling once the user scrolls past the header.
			if ($nav.hasClass('alt')
			&&	$header.length > 0) {

				$window.on('load', function() {

					$header.scrollwatch({
						delay:		0,
						range:		1,
						anchor:		'top',
						on:			function() { $navbar.removeClass('bar'); $nav.addClass('alt'); },
						off:		function() { $navbar.addClass('bar'); $nav.removeClass('alt'); }
					});

				});

			}

		// Dynamically resize iframe.
			function resizeIframe(iframeID) {       
				var iframe = window.parent.document.getElementById(iframeID);
				var container = document.getElementById('pics');
				iframe.style.height = container.offsetHeight + 'px';            
			}

			$window.on('load', function() {
				resizeIframe('playlist');
			});
			var width = $(window).width();
			$(window).resize(function() {
				if($(this).width() != width){
					resizeIframe('playlist');
					width = $(this).width();
				}
			});

		// Scrolly nav.
			var $nav_a = $('#nav a');
			$nav_a
				.scrolly()
				.on('click', function(e) {

					var t = $(this),
						href = t.attr('href');

					if (href[0] != '#')
						return;

					e.preventDefault();

					// Clear active and lock scrollzer until scrolling has stopped
						$nav_a
							.removeClass('active')
							.addClass('scrollzer-locked');

					// Set link to active
						t.addClass('active');

				});

			// Initialize scrollzer.
				var ids = [];

				$nav_a.each(function() {

					var href = $(this).attr('href');

					if (href[0] != '#')
						return;

					ids.push(href.substring(1));

				});

				$.scrollzer(ids, { pad: 200, lastHack: true });


	});

})(jQuery);
