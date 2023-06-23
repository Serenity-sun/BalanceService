<?php

namespace app\api\v1\components\userBalance\application\DTOs;

use app\api\v1\components\userBalance\enums\TransactionTypeEnum;
use yii\base\Model;

class HistoryDTO extends Model
{
    public ?int $page = null;

    public ?int $userId = null;

    public ?string $dateFrom = null;
    public ?string $dateTo = null;

    public ?int $fromAmount = null;
    public ?int $toAmount = null;


    public ?string $sort = null;

    public ?string $transactionType = null;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['userId'], 'required'],
            [['page'], 'integer', 'min' => 1],
            ['page', 'default', 'value' => 1],
            [['dateFrom', 'dateTo'], 'date', 'format' => 'php:Y-m-d'],
            [['fromAmount', 'toAmount'], 'integer'],
            [['sort'], 'in', 'range' => ['asc', 'desc']],
            [['sort'], 'default', 'value' => 'asc'],
            [['transactionType'], 'in', 'range' => TransactionTypeEnum::getValues()],
        ];
    }
}