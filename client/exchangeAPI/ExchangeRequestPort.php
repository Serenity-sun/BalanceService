<?php

namespace app\client\exchangeAPI;

interface ExchangeRequestPort
{
    public function getExchangeRate(string $fromCurrency, string $toCurrency): int;
}