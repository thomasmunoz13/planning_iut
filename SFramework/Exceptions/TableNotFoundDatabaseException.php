<?php
/**
 * Created by PhpStorm.
 * User: thomasmunoz
 * Date: 27/12/14
 * Time: 23:19
 */

namespace SFramework\Exceptions;

use Exception;

class TableNotFoundDatabaseException extends SException
{
    public function __construct($table, $code = 0, Exception $previous = null)
    {
        $message = 'The table ' . $table . ' was not found !';

        parent::__construct($message, $code, $previous);
    }
}