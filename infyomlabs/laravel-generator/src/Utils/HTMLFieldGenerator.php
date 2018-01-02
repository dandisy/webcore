<?php

namespace InfyOm\Generator\Utils;

use InfyOm\Generator\Common\GeneratorField;

class HTMLFieldGenerator
{
    public static function generateHTML(GeneratorField $field, $templateType)
    {
        $fieldTemplate = '';

        switch ($field->htmlType) {
            case 'text':
            case 'textarea':

            // added by dandi
            case 'text-editor':

            case 'date':

            // added by dandi
            case 'date-picker':
            case 'time-picker':
            case 'datetime-picker':

            case 'file':

            // added by dandi
            case 'file-manager':
            case 'files-manager':

            case 'email':
            case 'password':
                $fieldTemplate = get_template('scaffold.fields.'.$field->htmlType, $templateType);
                break;
            case 'number':
                $fieldTemplate = get_template('scaffold.fields.'.$field->htmlType, $templateType);
                break;
            case 'select':

            // added by dandi
            case 'select-multiple':
                $fieldTemplate = get_template('scaffold.fields.'.$field->htmlType, $templateType);
                $optionLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $fieldTemplate = str_replace(
                    '$INPUT_ARR$',
                    GeneratorFieldsInputUtil::prepareKeyValueArrayStr($optionLabels),
                    $fieldTemplate
                );
                break;

            case 'enum':
                $fieldTemplate = get_template('scaffold.fields.select', $templateType);
                $radioLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $fieldTemplate = str_replace(
                    '$INPUT_ARR$',
                    GeneratorFieldsInputUtil::prepareKeyValueArrayStr($radioLabels),
                    $fieldTemplate
                );
                break;
            case 'checkbox':
                $fieldTemplate = get_template('scaffold.fields.checkbox', $templateType);
                if (count($field->htmlValues) > 0) {
                    $checkboxValue = $field->htmlValues[0];
                } else {
                    $checkboxValue = 1;
                }
                $fieldTemplate = str_replace('$CHECKBOX_VALUE$', $checkboxValue, $fieldTemplate);
                break;
            case 'radio':
                $fieldTemplate = get_template('scaffold.fields.radio_group', $templateType);
                $radioTemplate = get_template('scaffold.fields.radio', $templateType);

                $radioLabels = GeneratorFieldsInputUtil::prepareKeyValueArrFromLabelValueStr($field->htmlValues);

                $radioButtons = [];
                foreach ($radioLabels as $label => $value) {
                    $radioButtonTemplate = str_replace('$LABEL$', $label, $radioTemplate);
                    $radioButtonTemplate = str_replace('$VALUE$', $value, $radioButtonTemplate);
                    $radioButtons[] = $radioButtonTemplate;
                }
                $fieldTemplate = str_replace('$RADIO_BUTTONS$', implode("\n", $radioButtons), $fieldTemplate);
                break;
        }

        return $fieldTemplate;
    }
}
