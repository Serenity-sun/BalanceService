<?php

namespace app\api\common\exceptions;

use app\api\common\enums\ErrorCodeEnum;

class MethodTypeNotSpecifiedException extends BaseException
{
    public $statusCode = 400;

    public $message = 'Method type not specified';

    public $code = ErrorCodeEnum::METHOD_TYPE_NOT_SPECIFIED;
}