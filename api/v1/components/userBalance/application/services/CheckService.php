<?php

namespace app\api\v1\components\userBalance\application\services;

use app\api\v1\components\userBalance\application\DTOs\CheckDTO;
use app\api\v1\components\userBalance\domain\repositories\CurrencyRepositoryInterface;
use app\api\v1\components\userBalance\domain\repositories\search\BalanceSearchRepositoryInterface;
use app\api\v1\components\userBalance\domain\services\CheckServiceInterface;

readonly class CheckService implements CheckServiceInterface
{

    public function __construct(
        private BalanceSearchRepositoryInterface $balanceSearchRepository,
        private CurrencyRepositoryInterface $currencyRepository
    )
    {}

    /**
     * @param CheckDTO $checkDTO
     * @return int
     */
    public function check(CheckDTO $checkDTO): int
    {
        $balanceData = $this->balanceSearchRepository->getData($checkDTO->userId);

        return $this->currencyRepository->exchange(
            $balanceData['currency'],
            $checkDTO->currency,
            $balanceData['balance']
        );
    }
}