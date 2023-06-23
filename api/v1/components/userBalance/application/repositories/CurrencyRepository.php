<?php

namespace app\api\v1\components\userBalance\application\repositories;

use app\api\v1\components\userBalance\domain\repositories\CurrencyRepositoryInterface;
use app\client\exchangeAPI\ExchangeRequestAdapter;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public const DEFAULT_CURRENCY_CODE = 'KZT';

    public function __construct(
        private readonly ExchangeRequestAdapter $exchangeAdapter
    )
    {}

    /**
     * @param string $formCurrency
     * @param string $toCurrency
     * @param int $amount
     * @return int
     */
    public function exchange(string $formCurrency, string $toCurrency, int $amount): int
    {
        if ($formCurrency === $toCurrency) {
            return $amount;
        }

        $exchangeRate = $this->exchangeAdapter->getExchangeRate($formCurrency, $toCurrency);

        return (int)($amount * $exchangeRate);
    }
}