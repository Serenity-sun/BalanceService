<?php

namespace app\api\v1\components\userBalance\domain\repositories\search;

interface TransactionSearchRepositoryInterface
{
    public function getTransactions(
        int $userId,
        int $page = 1,
        string $sort = 'asc',
        string $dateFrom = null,
        string $dateTo = null,
        int $fromAmount = null,
        int $toAmount = null,
        string $transactionType = null
    ): array;
}