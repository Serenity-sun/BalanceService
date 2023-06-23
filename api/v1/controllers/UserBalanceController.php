<?php

namespace app\api\v1\controllers;

use app\api\v1\components\userBalance\actions\CheckAction;
use app\api\v1\components\userBalance\actions\HistoryAction;
use app\api\v1\components\userBalance\actions\ReduceAction;
use app\api\v1\components\userBalance\actions\ReplenishAction;
use app\api\v1\components\userBalance\actions\TransferAction;
use app\api\common\controllers\BaseController;

class UserBalanceController extends BaseController
{

    public function getVerbs(): array
    {
        return [
            'replenish' => ['POST'],
            'reduce' => ['POST'],
            'transfer' => ['POST'],
            'check' => ['GET'],
            'history' => ['GET'],
        ];
    }

    public function getActions(): array
    {
        return [
            'replenish' => [
                'class' => ReplenishAction::class,
            ],
            'reduce' => [
                'class' => ReduceAction::class,
            ],
            'transfer' => [
                'class' => TransferAction::class,
            ],
            'check' => [
                'class' => CheckAction::class,
            ],
            'history' => [
                'class' => HistoryAction::class,
            ],
        ];
    }
}