<?php

namespace app\api\v1\components\userBalance\application\repositories\search;

use app\api\v1\components\userBalance\domain\repositories\search\BalanceSearchRepositoryInterface;
use app\api\v1\components\userBalance\exceptions\UserBalanceNotFoundException;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property string currency
 */
class BalanceSearchRepository extends ActiveRecord implements BalanceSearchRepositoryInterface
{
    public static function tableName(): string
    {
        return 'balances';
    }

    /**
     * @throws UserBalanceNotFoundException
     */
    public function getData(int $userId): array
    {
        $balanceEntity = self::findOne(['user_id' => $userId]);

        if (!$balanceEntity) {
            throw new UserBalanceNotFoundException();
        }

        return $balanceEntity->toArray();
    }

    /**
     * @param int $userId
     * @return int
     * @throws UserBalanceNotFoundException
     */
    public function getBalance(int $userId): int
    {
        $balanceEntity = self::findOne(['user_id' => $userId]);

        if (!$balanceEntity) {
            throw new UserBalanceNotFoundException();
        }

        return $balanceEntity->balance;
    }
}