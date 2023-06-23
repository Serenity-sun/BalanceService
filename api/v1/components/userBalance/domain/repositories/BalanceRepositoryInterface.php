<?php

namespace app\api\v1\components\userBalance\domain\repositories;

interface BalanceRepositoryInterface
{
    public function reduce(int $userId, int $balance): bool;

    public function replenish(int $userId, int $balance): bool;

    public function userExists(int $userId): bool;
}