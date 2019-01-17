<?php
/**
 * Created by PhpStorm.
 * User: afanasievv
 * Date: 03.01.19
 * Time: 21:32
 */

namespace App\Exceptions;


class NotImplementedException extends \BadMethodCallException
{
    public function __construct($method, $code = 0) {
        $message = "Method $method is not implemented";
        logger($message, ['stack' => $this->getTraceAsString()]);
        return parent::__construct($message, $code);
    }
}
