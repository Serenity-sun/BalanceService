<?php

use app\api\v1\components\userBalance\application\caches\TransactionCacheInterface;
use app\api\v1\components\userBalance\application\caches\TransactionRedis;
use app\api\v1\components\userBalance\application\repositories\BalanceRepository;
use app\api\v1\components\userBalance\application\repositories\CurrencyRepository;
use app\api\v1\components\userBalance\application\repositories\search\BalanceSearchRepository;
use app\api\v1\components\userBalance\application\repositories\search\TransactionSearchRepository;
use app\api\v1\components\userBalance\application\repositories\TransactionRepository;
use app\api\v1\components\userBalance\application\services\CheckService;
use app\api\v1\components\userBalance\application\services\HistoryService;
use app\api\v1\components\userBalance\application\services\ReduceService;
use app\api\v1\components\userBalance\application\services\ReplenishService;
use app\api\v1\components\userBalance\application\services\TransferService;
use app\api\v1\components\userBalance\domain\models\BalanceModel;
use app\api\v1\components\userBalance\domain\repositories\BalanceRepositoryInterface;
use app\api\v1\components\userBalance\domain\repositories\CurrencyRepositoryInterface;
use app\api\v1\components\userBalance\domain\repositories\search\BalanceSearchRepositoryInterface;
use app\api\v1\components\userBalance\domain\repositories\search\TransactionSearchRepositoryInterface;
use app\api\v1\components\userBalance\domain\repositories\TransactionRepositoryInterface;
use app\api\v1\components\userBalance\domain\services\CheckServiceInterface;
use app\api\v1\components\userBalance\domain\services\HistoryServiceInterface;
use app\api\v1\components\userBalance\domain\services\ReduceServiceInterface;
use app\api\v1\components\userBalance\domain\services\ReplenishServiceInterface;
use app\api\v1\components\userBalance\domain\services\TransferServiceInterface;
use app\client\exchangeAPI\ExchangeRequestAdapter;
use app\client\exchangeAPI\ExchangeRequestPort;

$services = [
    ReplenishServiceInterface::class => ReplenishService::class,
    ReduceServiceInterface::class => ReduceService::class,
    TransferServiceInterface::class => TransferService::class,
    CheckServiceInterface::class => CheckService::class,
    HistoryServiceInterface::class => HistoryService::class
];

$repositories = [
    BalanceRepositoryInterface::class => BalanceRepository::class,
    BalanceSearchRepositoryInterface::class => BalanceSearchRepository::class,
    CurrencyRepositoryInterface::class => CurrencyRepository::class,
    TransactionRepositoryInterface::class => TransactionRepository::class,
    TransactionSearchRepositoryInterface::class => TransactionSearchRepository::class
];

$model = [
    BalanceModel::class => BalanceModel::class
];

$client = [
    ExchangeRequestPort::class => ExchangeRequestAdapter::class
];

$cache = [
    TransactionCacheInterface::class => TransactionRedis::class
];

return array_merge($services, $repositories, $client, $cache);