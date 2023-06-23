<?php

namespace app\api\v1\components\userBalance\exceptions;

use app\api\common\exceptions\BaseException;
use app\api\v1\components\userBalance\enums\ErrorCodeEnum;

class TransferBalanceException extends BaseException
{
    protected $message = 'Transfer balance error';

    protected $code = ErrorCodeEnum::TRANSFER_BALANCE_ERROR;

    public $statusCode = 500;
}