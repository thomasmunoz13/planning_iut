<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 13/01/15
 * Time: 15:39
 */

namespace SFramework\Form\Field;


class InputField extends Field
{
    public function getHTML()
    {
        return '<input' . $this->getAttributesHTML() . ' ' . (!empty($this->getContent()) ? 'value="' . $this->getContent() . '"' : '') . '/>';
    }
}