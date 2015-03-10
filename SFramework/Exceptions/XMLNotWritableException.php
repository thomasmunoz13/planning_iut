<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 30/12/14
 * Time: 00:37
 */

namespace SFramework\Exceptions;

use Exception;

class XMLNotWritableException extends SException
{
    public function __construct($input, $code = 0, Exception $previous = null)
    {
        $message = 'The array provided for the XML tag is ';
        $message .= (count($input) < 1) ? 'too short' : 'too big. ';
        $message .= 'Size expected : 2.';

        parent::__construct($message, $code, $previous);
    }
}