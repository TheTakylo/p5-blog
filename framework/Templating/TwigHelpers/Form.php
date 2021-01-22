<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Framework\Form\AbstractForm;
use Framework\Form\Type\AbstractType;
use Framework\Form\Type\CsrfType;
use Twig\Markup;
use Twig\TwigFunction;

class Form
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('form_start', function (AbstractForm $form) {
            return new Markup(Form::form_start($form), 'UTF-8');
        }));

        $twig->addFunction(new TwigFunction('form_row', function (AbstractForm $form, string $fieldName, $label = null, $defaultValue = '') {
            return new Markup(Form::form_row($form, $fieldName, $label, $defaultValue), 'UTF-8');
        }));

        $twig->addFunction(new TwigFunction('form_errors', function (AbstractForm $form, string $fieldName) {
            return new Markup(Form::form_errors($form, $fieldName), 'UTF-8');
        }));

        $twig->addFunction(new TwigFunction('form_end', function (AbstractForm $form) {
            return new Markup(Form::form_end($form), 'UTF-8');
        }));

        $twig->addFunction(new TwigFunction('csrf_token', function () {
            return new Markup(Form::csrf_token(), 'UTF-8');
        }));
    }

    static function form_start(AbstractForm $form)
    {
        return "<form method='POST'>";
    }

    static function form_row(AbstractForm $form, string $fieldName, $label = null, $defaultValue = '')
    {
        /** @var null|AbstractType $field */
        $field = $form->getFields()[$fieldName];
        if ($field === null) {
            throw new \Exception('Field ' . $fieldName . ' doesn\'t exist');
        }

        $html = "<div class='form-group'>";

        if ($label !== null) {
            $html .= "<label class='form-label' for='{$fieldName}'>{$label}</label>";
        }

        $fieldOptions = $field->getOptions();
        switch ($fieldOptions['html_block']) {
            case 'textarea':
                $html .= "<textarea class='form-control' id=='{$fieldName}' name='{$fieldName}' placeholder='{$label}'>{$field->getValue()}</textarea>";
                break;
            case 'input':
                $html .= "<input type='{$fieldOptions['html_type']}' id='{$fieldName}' class='form-control' value='" . ($field->getValue() ?? $defaultValue) . "' name='{$fieldName}' placeholder='{$label}'/>";
                break;
            default:
        }

        $html .= '</div>';

        return $html;
    }

    static function form_errors(AbstractForm $form, string $fieldName)
    {
        $errors = $form->getErrorsMessages()[$fieldName] ?? null;

        $html = "";

        if (!empty($errors)) {
            $html = "<div class='mt-2 alert alert-danger'><ul class='mb-0'>";
            foreach ($errors as $error) {
                $html .= "<li>{$error}</li>";
            }
            $html .= "</ul></div>";
        }

        return $html;
    }

    static function form_end(AbstractForm $form)
    {
        return "</form>";
    }

    static function csrf_token(): string
    {
        return CsrfType::generate();
    }
}
