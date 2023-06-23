<?php

namespace app\api\v1\components\userBalance\application\repositories;

use app\api\v1\components\userBalance\domain\repositories\TransactionRepositoryInterface;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property string $currency
 * @property string $date
 * @property string $description
 * @property string $type
 */
class TransactionRepository extends ActiveRecord implements TransactionRepositoryInterface
{
    public static function tableName(): string
    {
        return 'transactions';
    }

    /**
     * @param int $userId
     * @param int $amount
     * @param string $currency
     * @param string $date
     * @param string $transactionType
     * @param string|null $description
     * @return void
     */
    public function addTransaction(
        int $userId,
        int $amount,
        string $currency,
        string $date,
        string $transactionType,
        string $description = null
    ): void
    {
        $transaction = new self();
        $transaction->user_id = $userId;
        $transaction->balance = $amount;
        $transaction->currency = $currency;
        $transaction->date = $date;
        $transaction->type = $transactionType;
        $transaction->description = $description;
        $transaction->save();
    }
}