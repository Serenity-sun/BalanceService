<?php

namespace app\client\exchangeAPI;

use yii\httpclient\Client;

class ExchangeRequestAdapter implements ExchangeRequestPort
{

    public function getExchangeRate(string $fromCurrency, string $toCurrency): int
    {
        //Все услуги exchange API платные. Другие источники тоже или лимит очень маленький.
        //Здесь просто имитирую курс соотношений валюты. Возвращаю 3
        //В реальном проекте здесь будет реализация запроса к API.

//        $client = new Client();
//
//        $response = $client->createRequest()
//            ->setMethod('GET')
//            ->setUrl('https://api.exchangeratesapi.io/v1/latest')
//            ->setData([
//                'token' => 'example token',
//                'base' => $fromCurrency,
//                'symbols' => $toCurrency
//            ])
//            ->send();

        return 3;
    }
}