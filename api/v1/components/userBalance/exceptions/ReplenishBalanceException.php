<?php

namespace app\api\v1\components\userBalance\exceptions;

use app\api\common\exceptions\BaseException;
use app\api\v1\components\userBalance\enums\ErrorCodeEnum;

class ReplenishBalanceException extends BaseException
{
    protected $message = 'Replenish balance error';

    protected $code = ErrorCodeEnum::REPLENISH_BALANCE_ERROR;

    public $statusCode = 500;
}