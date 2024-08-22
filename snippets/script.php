<?php

use Kirby\Cms\App;
use tobimori\DreamForm\Support\Htmx;

$plugin = App::plugin('tobimori/dreamform-date-field'); ?>

<script>
	(function(d, w) {
		function a(t, o) {
			var e = d.createElement(t);
			for (var k in o) e.setAttribute(k, o[k]);
			return d.head.appendChild(e)
		}

		function l() {
			d.querySelectorAll('[data-adp-init]').forEach(e => {
				try {
					e.adp = new AirDatepicker(e, JSON.parse(e.getAttribute('data-adp-init')))
				} catch (r) {
					console.error(r)
				}
			})
		}

		d.querySelector('[data-adp="css"]') || a('link', {
			'data-adp': 'css',
			rel: 'stylesheet',
			href: '<?= $plugin->asset("air-datepicker.css") ?>'
		});

		d.querySelector('[data-adp="js"]') || a('script', {
			'data-adp': 'js',
			src: '<?= $plugin->asset("air-datepicker.js") ?>'
		}).addEventListener('load', l)

		<?php if (Htmx::isActive()) : ?>
			w.addEventListener('htmx:afterSwap', l)
		<?php endif ?>
	})(document, window);
</script>
