<?php
/**
 * Created by PhpStorm.
 * User: loick
 * Date: 08/12/14
 * Time: 11:24
 */

namespace SFramework\mvc;

use SFramework\Helpers\Authentication;
use SFramework\Helpers\BaseViewContextProvider;
use SFramework\Helpers\ViewHelpers;
use Twig_Extension_Debug;

class View extends \Twig_Environment
{
    private $helpers;

    public function __construct(\Twig_LoaderInterface $loader = null, $options = [])
    {
        if (DEBUG)
            $options = array_merge($options, ['debug' => true]);

        parent::__construct($loader, $options);
        $this->addExtension(new Twig_Extension_Debug());

        $this->helpers = new ViewHelpers();
    }

    public function loadTemplate($name, $index = null)
    {
        $name = $name . '.twig';
        return parent::loadTemplate($name, $index);
    }

    public function render($name, array $context = [])
    {
        $context = array_merge(BaseViewContextProvider::provide(), $context);
        $context = array_merge(['helpers' => $this->helpers], $context);
        $context = Authentication::getInstance()->addToContext($context);

        echo parent::render($name, $context);
    }

    public function redirect($to)
    {
        header('Location: ' . $to);
    }
}