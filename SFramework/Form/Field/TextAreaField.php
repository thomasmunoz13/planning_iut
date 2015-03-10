<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 13/01/15
 * Time: 15:39
 */

namespace SFramework\Form\Field;


class TextAreaField extends Field
{
    public function getHTML()
    {
        return '<textarea' . $this->getAttributesHTML() . '>' . $this->getContent() . '</textarea>';
    }
}