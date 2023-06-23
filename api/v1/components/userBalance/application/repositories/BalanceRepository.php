<?php

namespace app\api\v1\components\userBalance\application\repositories;

use app\api\v1\components\userBalance\domain\repositories\BalanceRepositoryInterface;
use Throwable;
use yii\db\ActiveRecord;
use yii\db\Transaction;

/**
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property string currency
 */
class BalanceRepository extends ActiveRecord implements BalanceRepositoryInterface
{

    public static function tableName(): string
    {
        return 'balances';
    }

    /**
     * Можно обьединить в один метод, но для гибкости оставил два
     *
     * @param int $userId
     * @param int $balance
     * @return bool
     * @throws Throwable
     */
    public function reduce(int $userId, int $balance): bool
    {
        $transaction = self::getDb()->beginTransaction(Transaction::SERIALIZABLE);

        try {
            $balanceEntity = self::findOne(['user_id' => $userId]);

            if ($balanceEntity === null) {
                $balanceEntity = new self();
                $balanceEntity->user_id = $userId;
                $balanceEntity->currency = CurrencyRepository::DEFAULT_CURRENCY_CODE;
            }

            $balanceEntity->balance -= $balance;
            $result = $balanceEntity->save();

            if ($result) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
            return $result;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @param int $userId
     * @param int $balance
     * @return bool
     * @throws Throwable
     */
    public function replenish(int $userId, int $balance): bool
    {
        $transaction = self::getDb()->beginTransaction(Transaction::SERIALIZABLE);

        try {
            $balanceEntity = self::findOne(['user_id' => $userId]);

            if ($balanceEntity === null) {
                $balanceEntity = new self();
                $balanceEntity->user_id = $userId;
                $balanceEntity->currency = CurrencyRepository::DEFAULT_CURRENCY_CODE;
            }

            $balanceEntity->balance += $balance;
            $result = $balanceEntity->save();

            if ($result) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
            return $result;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function userExists(int $userId): bool
    {
        return self::find()->where(['user_id' => $userId])->exists();
    }
}