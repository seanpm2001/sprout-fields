<?php
namespace Craft;

class SproutFields_EmailFieldType extends BaseFieldType
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return Craft::t('Email Address');
	}

	/**
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'customPattern'             => array(AttributeType::String),
			'customPatternErrorMessage' => array(AttributeType::String),
			'uniqueEmail'               => array(AttributeType::Bool, 'default' => false),
		);
	}

	/**
	 * Display our settings
	 *
	 * @return string Returns the template which displays our settings
	 */
	public function getSettingsHtml()
	{
		$settings = $this->getSettings();

		return craft()->templates->render(
			'sproutfields/_fieldtypes/email/settings',
			array(
				'settings' => $settings
			)
		);
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 *
	 * @return string
	 */
	public function getInputHtml($name, $value)
	{
		$inputId          = craft()->templates->formatInputId($name);
		$namespaceInputId = craft()->templates->namespaceInputId($inputId);

		return craft()->templates->render(
			'sproutfields/_fieldtypes/email/input',
			array(
				'id'    => $namespaceInputId,
				'name'  => $name,
				'value' => $value
			)
		);
	}

	/**
	 * Validates our fields submitted value beyond the checks
	 * that were assumed based on the content attribute.
	 *
	 * Returns 'true' or any custom validation errors.
	 *
	 * @param array $value
	 *
	 * @return true|string|array
	 */
	public function validate($value)
	{
		return sproutFields()->email->validate($value, $this->element, $this->model);
	}
}