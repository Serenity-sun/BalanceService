<?php

namespace app\api\v1\components\userBalance\exceptions;

use app\api\common\exceptions\BaseException;
use app\api\v1\components\userBalance\enums\ErrorCodeEnum;

class UserBalanceNotFoundException extends BaseException
{
    protected $message = 'User balance account not found';

    protected $code = ErrorCodeEnum::USER_BALANCE_NOT_FOUND;

    public $statusCode = 404;
}