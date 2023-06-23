<?php

namespace app\api\v1\components\userBalance\application\services;

use app\api\v1\components\userBalance\application\caches\TransactionCacheInterface;
use app\api\v1\components\userBalance\application\DTOs\TransferDTO;
use app\api\v1\components\userBalance\domain\models\BalanceModel;
use app\api\v1\components\userBalance\domain\services\TransferServiceInterface;
use app\api\v1\components\userBalance\exceptions\NotEnoughBalanceException;
use Throwable;

readonly class TransferService implements TransferServiceInterface
{

    public function __construct(
        private BalanceModel $model,
        private TransactionCacheInterface $transactionCache
    )
    {}

    /**
     * @param TransferDTO $transferDTO
     * @return void
     * @throws NotEnoughBalanceException
     * @throws Throwable
     */
    public function transfer(TransferDTO $transferDTO): void
    {
        $this->model->transfer(
            $transferDTO->fromUserId,
            $transferDTO->toUserId,
            $transferDTO->amount
        );

        $this->transactionCache->reset($transferDTO->fromUserId);
        $this->transactionCache->reset($transferDTO->toUserId);
    }
}