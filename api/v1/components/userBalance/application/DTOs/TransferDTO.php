<?php

namespace app\api\v1\components\userBalance\application\DTOs;

use yii\base\Model;

class TransferDTO extends Model
{
    public ?int $fromUserId = null;

    public ?int $toUserId = null;

    public ?int $amount = null;

    public ?string $currency = null;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['fromUserId', 'toUserId', 'amount'], 'required'],
            [['fromUserId', 'toUserId'], 'integer', 'min' => 0],
            [['amount'], 'integer', 'min' => 1, 'max' => 1000000, 'message' => 'Amount must be between 0 and 1000000'],
            ['currency', 'string', 'min' => 3, 'max' => 3, 'message' => 'Currency code must be 3 characters long'],
        ];
    }
}