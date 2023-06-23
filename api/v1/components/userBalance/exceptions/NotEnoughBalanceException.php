<?php

namespace app\api\v1\components\userBalance\exceptions;

use app\api\common\exceptions\BaseException;
use app\api\v1\components\userBalance\enums\ErrorCodeEnum;

class NotEnoughBalanceException extends ReplenishBalanceException
{
    protected $message = 'Not enough balance';

    protected $code = ErrorCodeEnum::NOT_ENOUGH_BALANCE;

    public $statusCode = 403;
}