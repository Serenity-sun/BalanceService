<?php

namespace app\api\v1\components\userBalance\application\caches;

interface TransactionCacheInterface
{
    public function reset(int $userId): void;
}