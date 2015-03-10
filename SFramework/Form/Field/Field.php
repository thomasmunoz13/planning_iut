<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 13/01/15
 * Time: 15:39
 */

namespace SFramework\Form\Field;

use SFramework\Exceptions\AttributeNotExistsException;

abstract class Field
{
    private $name;
    private $attributes = [];
    private $content;

    function __construct($name, $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->addAttribute('name', $this->name);
    }

    public function addAttribute($name, $value)
    {
        $name = strtolower($name);
        $value = htmlentities($value);
        $this->attributes[$name] = $value;
    }

    public function getAttributesHTML()
    {
        $html = '';
        foreach ($this->getAttributes() as $key => $value) {
            $html .= ' ' . $key . '="' . addslashes($value) . '"';
        }

        return $html;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($att)
    {
        if (!isset($this->attributes[$att])) {
            throw new AttributeNotExistsException($att);
        }
        return $this->attributes[$att];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public abstract function getHTML();

}