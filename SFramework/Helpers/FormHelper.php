<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 28/12/14
 * Time: 20:31
 */

namespace SFramework\Helpers;


use SFramework\Database\DatabaseProvider;
use SFramework\Exceptions\TableNotFoundDatabaseException;
use SFramework\Form\Field\InputField;
use SFramework\Form\Field\TextAreaField;
use SFramework\Form\Form;

class FormHelper
{
    /**
     * generate form for table
     * @param $table string table
     * @param $action string action
     * @param string $method method form (default = POST)
     * @return \SFramework\Form\Form
     * @throws TableNotFoundDatabaseException
     */
    public static function generate($table, $action, $method = 'POST')
    {
        $sql = 'SHOW FIELDS '
            . 'FROM ' . $table;

        $res = DatabaseProvider::connection()->query($sql);

        if (empty($res)) {
            throw new TableNotFoundDatabaseException($table);
        }

        $form = new Form($action, $method);
        $form->setClass('pure-form pure-form-aligned centered');

        foreach ($res as $value) {
            if (self::getType($value['Type']) == 'text') {
                $field = self::getTextArea($value);
            } elseif (self::getType($value['Type']) == 'datetime') {
                $field = self::getInput($value);
                $field->addAttribute('class', 'datepicker');
                $field->addAttribute('placeholder', '01/01/2014');
            } else {
                $field = self::getInput($value);
            }
            $form->addField($field);
        }

        $submit = new InputField('submit');
        $submit->addAttribute('type', 'submit');
        $submit->addAttribute('value', 'Envoyer');
        $submit->addAttribute('class', 'pure-button pure-button-primary');
        $form->addField($submit);

        return $form;
    }

    private static function getType($type)
    {
        $tmp = explode('(', $type);
        if (!empty($tmp)) {
            $type = $tmp[0];
        }
        return $type;
    }

    private static function getTextArea($value)
    {
        $field = new TextAreaField($value['Field']);

        return $field;
    }

    private static function getInput($value)
    {
        $field = new InputField($value['Field']);
        $field->addAttribute('type', self::convertAttributeType($value));

        return $field;
    }

    /**
     * convert type mysql to input type
     * if primary key -> hidden
     * default text
     * @param $att
     * @return string
     */
    private static function convertAttributeType($att)
    {
        if ($att['Key'] == 'PRI') {
            return 'hidden';
        }
        return 'text';
    }
}
