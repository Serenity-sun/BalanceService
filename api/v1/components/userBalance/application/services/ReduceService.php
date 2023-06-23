<?php

namespace app\api\v1\components\userBalance\application\services;

use app\api\v1\components\userBalance\application\caches\TransactionCacheInterface;
use app\api\v1\components\userBalance\application\DTOs\ReduceDTO;
use app\api\v1\components\userBalance\application\repositories\CurrencyRepository;
use app\api\v1\components\userBalance\domain\models\BalanceModel;
use app\api\v1\components\userBalance\domain\repositories\TransactionRepositoryInterface;
use app\api\v1\components\userBalance\domain\services\ReduceServiceInterface;
use app\api\v1\components\userBalance\enums\TransactionTypeEnum;
use app\api\v1\components\userBalance\exceptions\NotEnoughBalanceException;
use app\api\v1\components\userBalance\exceptions\ReduceBalanceException;
use app\api\v1\components\userBalance\exceptions\UserBalanceNotFoundException;

readonly class ReduceService implements ReduceServiceInterface
{
    public function __construct(
        private BalanceModel $model,
        private TransactionRepositoryInterface $transactionRepository,
        private TransactionCacheInterface $transactionCache
    )
    {}

    /**
     * @param ReduceDTO $reduceDTO
     * @return void
     * @throws NotEnoughBalanceException
     * @throws UserBalanceNotFoundException
     * @throws ReduceBalanceException
     */
    public function reduce(ReduceDTO $reduceDTO): void
    {
        $this->model->reduce(
            $reduceDTO->userId,
            $reduceDTO->amount
        );

        $this->transactionRepository->addTransaction(
            $reduceDTO->userId,
            $reduceDTO->amount,
            CurrencyRepository::DEFAULT_CURRENCY_CODE,
            date('Y-m-d H:i:s'),
            TransactionTypeEnum::REDUCE,
            $reduceDTO->description,
        );

        $this->transactionCache->reset($reduceDTO->userId);
    }
}