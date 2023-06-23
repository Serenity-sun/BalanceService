<?php

namespace app\api\v1\components\userBalance\domain\repositories\search;

interface BalanceSearchRepositoryInterface
{
    public function getBalance(int $userId): int;
    public function getData(int $userId): array;
}