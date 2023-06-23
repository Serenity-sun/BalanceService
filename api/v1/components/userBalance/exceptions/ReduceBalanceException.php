<?php

namespace app\api\v1\components\userBalance\exceptions;

use app\api\common\exceptions\BaseException;
use app\api\v1\components\userBalance\enums\ErrorCodeEnum;

class ReduceBalanceException extends BaseException
{
    protected $message = 'Reduce balance error';

    protected $code = ErrorCodeEnum::REDUCE_BALANCE_ERROR;

    public $statusCode = 500;
}