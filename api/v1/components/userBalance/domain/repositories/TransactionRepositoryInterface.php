<?php

namespace app\api\v1\components\userBalance\domain\repositories;

interface TransactionRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $amount
     * @param string $currency
     * @param string $date
     * @param string $transactionType
     * @param string|null $description
     * @return void
     */
    public function addTransaction(
        int $userId,
        int $amount,
        string $currency,
        string $date,
        string $transactionType,
        string $description = null
    ): void;
}