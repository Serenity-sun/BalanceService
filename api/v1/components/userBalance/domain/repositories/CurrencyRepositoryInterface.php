<?php

namespace app\api\v1\components\userBalance\domain\repositories;

interface CurrencyRepositoryInterface
{
    public function exchange(string $formCurrency, string $toCurrency, int $amount): int;
}