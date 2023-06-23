<?php

namespace app\api\v1\components\userBalance\application\services;

use app\api\v1\components\userBalance\application\caches\TransactionCacheInterface;
use app\api\v1\components\userBalance\application\DTOs\ReplenishDTO;
use app\api\v1\components\userBalance\application\repositories\CurrencyRepository;
use app\api\v1\components\userBalance\domain\models\BalanceModel;
use app\api\v1\components\userBalance\domain\repositories\TransactionRepositoryInterface;
use app\api\v1\components\userBalance\domain\services\ReplenishServiceInterface;
use app\api\v1\components\userBalance\enums\TransactionTypeEnum;
use Throwable;

readonly class ReplenishService implements ReplenishServiceInterface
{
    public function __construct(
        private BalanceModel $model,
        private TransactionRepositoryInterface $transactionRepository,
        private TransactionCacheInterface $transactionCache
    )
    {}

    /**
     * @param ReplenishDTO $replenishDTO
     * @return void
     * @throws Throwable
     */
    public function replenish(ReplenishDTO $replenishDTO): void
    {
        $this->model->replenish(
            $replenishDTO->userId,
            $replenishDTO->amount
        );

        $this->transactionRepository->addTransaction(
            $replenishDTO->userId,
            $replenishDTO->amount,
            CurrencyRepository::DEFAULT_CURRENCY_CODE,
            date('Y-m-d H:i:s'),
            TransactionTypeEnum::REPLENISH,
            $replenishDTO->description,
        );

        $this->transactionCache->reset($replenishDTO->userId);
    }
}