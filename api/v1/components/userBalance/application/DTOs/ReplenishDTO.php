<?php

namespace app\api\v1\components\userBalance\application\DTOs;

use yii\base\Model;

class ReplenishDTO extends Model
{
    public ?int $userId = null;

    public ?int $amount = null;

    public ?string $currency = null;

    public ?string $description = null;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['userId', 'amount'], 'required'],
            [['userId'], 'integer', 'min' => 0],
            [['amount'], 'integer', 'min' => 1, 'max' => 1000000, 'message' => 'Amount must be between 0 and 1000000'],
            ['currency', 'string', 'min' => 3, 'max' => 3, 'message' => 'Currency code must be 3 characters long'],
            ['description', 'string', 'min' => 1, 'max' => 255, 'message' => 'Description must be between 1 and 255 characters long']
        ];
    }
}