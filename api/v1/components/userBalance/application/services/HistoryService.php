<?php

namespace app\api\v1\components\userBalance\application\services;

use app\api\v1\components\userBalance\application\DTOs\HistoryDTO;
use app\api\v1\components\userBalance\domain\repositories\search\TransactionSearchRepositoryInterface;
use app\api\v1\components\userBalance\domain\services\HistoryServiceInterface;

readonly class HistoryService implements HistoryServiceInterface
{
    public function __construct(
        private TransactionSearchRepositoryInterface $transactionRepository
    )
    {}

    /**
     * @param HistoryDTO $historyDTO
     * @return array
     */
    public function getHistory(HistoryDTO $historyDTO): array
    {
        $transactions = $this->transactionRepository->getTransactions(
            $historyDTO->userId,
            $historyDTO->page,
            $historyDTO->sort,
            $historyDTO->dateFrom,
            $historyDTO->dateTo,
            $historyDTO->fromAmount,
            $historyDTO->toAmount,
            $historyDTO->transactionType
        );

        return [
            'code' => 0,
            'history' => $transactions,
        ];
    }
}