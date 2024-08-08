<?php

namespace tobimori\DreamFormDateField;

use tobimori\DreamForm\Fields\Field;

class DateField extends Field
{
	public static function blueprint(): array
	{
		return [
			'name' => t('dreamform.fields.date.name'),
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
					]
				],
				'validation' => [
					'label' => t('dreamform.validation'),
					'fields' => [
						'required' => 'dreamform/fields/required',
						'errorMessage' => 'dreamform/fields/error-message',
					]
				]
			]
		];
	}

	public function submissionBlueprint(): array|null
	{
		return [
			'label' => $this->block()->label()->value() ?? t('dreamform.fields.date.name'),
			'type' => 'date'
		];
	}

	public function validate(): true|string
	{
		if (
			$this->block()->required()->toBool()
			&& $this->value()->isEmpty()
		) {
			return $this->errorMessage();
		}

		return true;
	}

	public static function group(): string
	{
		return 'date';
	}

	public static function type(): string
	{
		return 'date';
	}
}
