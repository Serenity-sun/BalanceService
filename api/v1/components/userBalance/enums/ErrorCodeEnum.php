<?php

namespace app\api\v1\components\userBalance\enums;

class ErrorCodeEnum
{
    const REPLENISH_BALANCE_ERROR = 1000;
    const REDUCE_BALANCE_ERROR = 1001;

    const TRANSFER_BALANCE_ERROR = 1002;
    const NOT_ENOUGH_BALANCE = 1003;

    const USER_BALANCE_NOT_FOUND = 1004;
}
