<?php

namespace app\api\common\exceptions;

use app\api\common\enums\ErrorCodeEnum;

class MethodHasMultipleTypeException extends BaseException
{
    public $statusCode = 405;

    public $message = 'Method has multiple type';

    public $code = ErrorCodeEnum::METHOD_HAS_MULTIPLE_TYPE;
}
