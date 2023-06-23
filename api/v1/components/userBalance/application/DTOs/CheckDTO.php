<?php

namespace app\api\v1\components\userBalance\application\DTOs;

use yii\base\Model;

class CheckDTO extends Model
{
    public ?int $userId = null;

    public ?string $currency = null;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['userId'], 'required'],
            [['userId'], 'integer', 'min' => 0],
            ['currency', 'string', 'min' => 3, 'max' => 3, 'message' => 'Currency code must be 3 characters long'],
        ];
    }
}