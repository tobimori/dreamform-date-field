<?php

namespace tobimori\DreamFormDateField;

use DateTime;
use tobimori\DreamForm\Fields\Field;

class DateField extends Field
{
	public const TYPE = 'date';

	public static function blueprint(): array
	{
		return [
			'name' => t('dreamform.dateField.name'),
			'preview' => 'date-field',
			'wysiwyg' => true,
			'icon' => 'calendar',
			'tabs' => [
				'field' => [
					'label' => t('dreamform.field'),
					'fields' => [
						'key' => 'dreamform/fields/key',
						'label' => 'dreamform/fields/label',
						'placeholder' => 'dreamform/fields/placeholder',
						'timepicker' => [
							'label' => t('dreamform.dateField.hasTimePicker'),
							'type' => 'toggle',
							'text' => [
								t('dreamform.dateField.date'),
								t('dreamform.dateField.timeAndDate')
							]
						],
						'defaultToToday' => [
							'label' => t('dreamform.dateField.defaultToToday'),
							'type' => 'toggle',
						]
					]
				],
				'validation' => [
					'label' => t('dreamform.validation'),
					'fields' => [
						'required' => 'dreamform/fields/required',
						'errorMessage' => 'dreamform/fields/error-message',
						'futureOnly' => [
							'label' => t('dreamform.dateField.futureOnly'),
							'type' => 'toggle',
						],
						'minDate' => [
							'label' => t('dreamform.dateField.minDate'),
							'type' => 'date',
						],
						'maxDate' => [
							'label' => t('dreamform.dateField.maxDate'),
							'type' => 'date',
						],
					]
				]
			]
		];
	}

	public function submissionBlueprint(): array|null
	{
		return [
			'label' => $this->block()->label()->value() ?? t('dreamform.fields.date.name'),
			'type' => 'date',
			'time' => $this->block()->timePicker()->toBool()
		];
	}

	/**
	 * Converts an AirDatepicker format string to a PHP date format string.
	 */
	private static function adpToPhpFormat(string $format): string
	{
		return str_replace(
			['yyyy', 'MM', 'dd', 'HH', 'hh', 'mm', 'aa'],
			['Y', 'm', 'd', 'H', 'h', 'i', 'A'],
			$format
		);
	}

	/**
	 * Parses a date string submitted from the frontend using the locale's date format.
	 */
	private function parseSubmittedDate(string $value): ?DateTime
	{
		$format = static::adpToPhpFormat(t('dreamform.dateField.dateFormat'));

		if ($this->block()->timepicker()->toBool()) {
			$format .= ' ' . static::adpToPhpFormat(t('dreamform.dateField.timeFormat'));
		}

		$date = DateTime::createFromFormat($format, $value);
		return $date ?: null;
	}

	public function validate(): true|string
	{
		if (
			$this->block()->required()->toBool()
			&& $this->value()->isEmpty()
		) {
			return $this->errorMessage();
		}

		if ($this->value()->isEmpty()) {
			return true;
		}

		$date = $this->parseSubmittedDate($this->value()->toString());
		if (!$date) {
			return true;
		}

		if ($this->block()->futureOnly()->toBool()) {
			$today = new DateTime('today');
			if ($date < $today) {
				return $this->errorMessage();
			}
		}

		if ($this->block()->minDate()->isNotEmpty()) {
			$minDate = new DateTime($this->block()->minDate()->toString());
			if ($date < $minDate) {
				return $this->errorMessage();
			}
		}

		if ($this->block()->maxDate()->isNotEmpty()) {
			$maxDate = new DateTime($this->block()->maxDate()->toString());
			$maxDate->setTime(23, 59, 59);
			if ($date > $maxDate) {
				return $this->errorMessage();
			}
		}

		return true;
	}

	public static function group(): string
	{
		return 'common';
	}

	public static function type(): string
	{
		return 'date';
	}
}
