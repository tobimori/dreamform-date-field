<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App;
use Kirby\Data\Json;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;
use Kirby\Toolkit\A;
use tobimori\DreamForm\DreamForm;
use tobimori\DreamFormDateField\DateField;

if (!class_exists('tobimori\DreamForm\DreamForm')) {
	throw new Exception('[DreamForm Date Field] This plugin requires the DreamForm plugin (https://plugins.getkirby.com/tobimori/dreamform) to be installed.');
}

DreamForm::register(DateField::class);

App::plugin(
	name: 'tobimori/dreamform-date-field',
	extends: [
		'options' => [
			'script' => true, // disable loading and initialization of the script
			'config' => [] // custom config injected to the script
		],
		'snippets' => [
			'dreamform/fields/date' => __DIR__ . '/snippets/fields/date.php',
			'dreamform/fields/date/script' => __DIR__ . '/snippets/script.php'
		],
		// get all files from /translations and register them as language files
		'translations' => A::keyBy(
			A::map(
				Dir::read(__DIR__ . '/translations'),
				function ($file) {
					$translations = [];
					foreach (Json::read(__DIR__ . '/translations/' . $file) as $key => $value) {
						$translations["dreamform.dateField.{$key}"] = $value;
					}

					return A::merge(
						['lang' => F::name($file)],
						$translations
					);
				}
			),
			'lang'
		)
	]
);
