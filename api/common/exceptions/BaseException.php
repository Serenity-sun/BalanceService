<?php

namespace app\api\common\exceptions;

use yii\web\HttpException;

class BaseException extends HttpException
{
    public function __construct($message = null, $previous = null)
    {
        $message = $message ?? $this->message;
        parent::__construct($this->statusCode, $message, $this->code, $previous);
    }
}