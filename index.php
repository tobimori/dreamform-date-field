<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App;
use tobimori\DreamForm\DreamForm;
use tobimori\DreamFormDateField\DateField;
use tobimori\DreamFormDateField\TimeField;

if (!class_exists('tobimori\DreamForm\DreamForm')) {
	throw new Exception('[DreamForm Date Field] This plugin requires the DreamForm plugin (https://plugins.getkirby.com/tobimori/dreamform) to be installed.');
}

DreamForm::register(DateField::class, TimeField::class);

App::plugin(
	name: 'tobimori/dreamform-date-field',
	extends: [
		'options' => [
			'script' => true, // disable loading and initialization of the script
			'config' => [
				// custom config injected to the script
				// the whole object is replaced
				// https://easepick.com/configurator/

				'lang' => 'en-US',
				'format' => 'DD.MM.YYYY',
				'timeFormat'	=> 'HH:mm',
			]
		],
		'snippets' => [
			'dreamform/easepick/custom.css' => __DIR__ . '/snippets/easepick/custom.css.php',
			'dreamform/fields/date' => __DIR__ . '/snippets/fields/date.php',
			'dreamform/fields/time' => __DIR__ . '/snippets/fields/time.php',
		]
	]
);
