<?php

namespace app\api\v1\components\userBalance\enums;

class TransactionTypeEnum
{
    const REPLENISH = 'replenish';
    const REDUCE = 'reduce';


    public static function getValues(): array
    {
        return [
            self::REPLENISH,
            self::REDUCE,
        ];
    }
}
