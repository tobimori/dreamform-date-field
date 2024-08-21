<?php

/**
 * @var \tobimori\DreamForm\Models\Submission|null $submission
 *
 * @var \Kirby\Cms\Block $block
 * @var \tobimori\DreamFormDateField\DateField $field
 * @var \tobimori\DreamForm\Models\FormPage $form
 * @var array $attr
 *
 * @var string|null $type
 */

use Kirby\Cms\App;
use Kirby\Data\Json;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

$attr = A::merge($attr, $attr['date'] ?? []);
snippet('dreamform/fields/partials/wrapper', $arguments = compact('block', 'field', 'form', 'attr'), slots: true);
snippet('dreamform/fields/partials/label', $arguments); ?>

<input <?= attr(A::merge($attr['input'], [
					'type' => 'text',
					'id' => $form->elementId($block->id()),
					'name' => $block->key(),
					'placeholder' => $block->placeholder()->or(" "),
					'required' => $block->required()->toBool() ?? null,
					'value' => $form->valueFor($block->key()),
					'readonly',
					'data-airdatepicker-init' => Json::encode(A::merge([
						'timepicker' => $block->timepicker()->toBool(),
						'locale' => [
							'days' => [
								t('dreamform.dateField.days.sunday'),
								t('dreamform.dateField.days.monday'),
								t('dreamform.dateField.days.tuesday'),
								t('dreamform.dateField.days.wednesday'),
								t('dreamform.dateField.days.thursday'),
								t('dreamform.dateField.days.friday'),
								t('dreamform.dateField.days.saturday'),
							],
							'daysShort' => [
								t('dreamform.dateField.daysShort.sunday'),
								t('dreamform.dateField.daysShort.monday'),
								t('dreamform.dateField.daysShort.tuesday'),
								t('dreamform.dateField.daysShort.wednesday'),
								t('dreamform.dateField.daysShort.thursday'),
								t('dreamform.dateField.daysShort.friday'),
								t('dreamform.dateField.daysShort.saturday'),
							],
							'daysMin' => [
								t('dreamform.dateField.daysMin.sunday'),
								t('dreamform.dateField.daysMin.monday'),
								t('dreamform.dateField.daysMin.tuesday'),
								t('dreamform.dateField.daysMin.wednesday'),
								t('dreamform.dateField.daysMin.thursday'),
								t('dreamform.dateField.daysMin.friday'),
								t('dreamform.dateField.daysMin.saturday'),
							],
							'months' => [
								t('dreamform.dateField.months.january'),
								t('dreamform.dateField.months.february'),
								t('dreamform.dateField.months.march'),
								t('dreamform.dateField.months.april'),
								t('dreamform.dateField.months.may'),
								t('dreamform.dateField.months.june'),
								t('dreamform.dateField.months.july'),
								t('dreamform.dateField.months.august'),
								t('dreamform.dateField.months.september'),
								t('dreamform.dateField.months.october'),
								t('dreamform.dateField.months.november'),
								t('dreamform.dateField.months.december'),
							],
							'monthsShort' => [
								t('dreamform.dateField.monthsShort.january'),
								t('dreamform.dateField.monthsShort.february'),
								t('dreamform.dateField.monthsShort.march'),
								t('dreamform.dateField.monthsShort.april'),
								t('dreamform.dateField.monthsShort.may'),
								t('dreamform.dateField.monthsShort.june'),
								t('dreamform.dateField.monthsShort.july'),
								t('dreamform.dateField.monthsShort.august'),
								t('dreamform.dateField.monthsShort.september'),
								t('dreamform.dateField.monthsShort.october'),
								t('dreamform.dateField.monthsShort.november'),
								t('dreamform.dateField.monthsShort.december'),
							],
							'dateFormat' => t('dreamform.dateField.dateFormat'),
							'timeFormat' => t('dreamform.dateField.timeFormat'),
							'firstDay' => intval(t('dreamform.dateField.firstDay') ?? "0"),
						],
						App::instance()->option('tobimori.dreamform-date-field.config', [])
					]))
				])) ?>>

<?php snippet('dreamform/fields/partials/error', $arguments);
endsnippet() ?>
