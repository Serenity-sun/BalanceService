<?php

namespace app\api\v1\components\userBalance\domain\models;

use app\api\v1\components\userBalance\domain\repositories\BalanceRepositoryInterface;
use app\api\v1\components\userBalance\domain\repositories\search\BalanceSearchRepositoryInterface;
use app\api\v1\components\userBalance\exceptions\NotEnoughBalanceException;
use app\api\v1\components\userBalance\exceptions\ReduceBalanceException;
use app\api\v1\components\userBalance\exceptions\ReplenishBalanceException;
use app\api\v1\components\userBalance\exceptions\UserBalanceNotFoundException;

readonly class BalanceModel
{
    public function __construct(
        private BalanceRepositoryInterface $balanceRepository,
        private BalanceSearchRepositoryInterface $balanceSearchRepository
    )
    {}

    /**
     * @param int $userId
     * @param int $amount
     * @return bool
     * @throws ReplenishBalanceException
     */
    public function replenish(int $userId, int $amount): bool
    {
        $success = $this->balanceRepository->replenish($userId, $amount);

        if (!$success) {
            throw new ReplenishBalanceException();
        }

        return true;
    }

    /**
     * @param int $userId
     * @param int $amount
     * @return bool
     * @throws NotEnoughBalanceException
     * @throws UserBalanceNotFoundException
     * @throws ReduceBalanceException
     */
    public function reduce(int $userId, int $amount): bool
    {
        if (!$this->balanceRepository->userExists($userId)) {
            throw new UserBalanceNotFoundException();
        }
        if ($this->balanceSearchRepository->getBalance($userId) < $amount) {
            throw new NotEnoughBalanceException();
        }

        $success = $this->balanceRepository->reduce($userId, $amount);
        if (!$success) {
            throw new ReduceBalanceException();
        }

        return true;
    }

    /**
     * @param int $fromUserId
     * @param int $toUserId
     * @param int $amount
     * @return void
     * @throws NotEnoughBalanceException
     * @throws UserBalanceNotFoundException
     * @throws ReduceBalanceException
     * @throws ReplenishBalanceException
     */
    public function transfer(int $fromUserId, int $toUserId, int $amount): void
    {
        $this->reduce($fromUserId, $amount);
        $this->replenish($toUserId, $amount);
    }
}