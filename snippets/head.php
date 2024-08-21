<?php

use Kirby\Cms\App;

$plugin = App::plugin('tobimori/dreamform-date-field'); ?>

<?= js($plugin->asset('air-datepicker.js')) ?>
<?= css($plugin->asset('air-datepicker.css')) ?>

<script>
	document.querySelectorAll("[data-airdatepicker-init]").map((el) => new AirDatepicker(el, JSON.parse(el.getAttribute('data-airdatepicker-init'))))
</script>
