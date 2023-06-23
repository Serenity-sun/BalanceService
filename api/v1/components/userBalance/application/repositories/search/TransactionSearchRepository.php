<?php

namespace app\api\v1\components\userBalance\application\repositories\search;

use app\api\v1\components\userBalance\domain\repositories\search\TransactionSearchRepositoryInterface;
use Yii;
use yii\caching\DbDependency;
use yii\db\ActiveRecord;
use yii\redis\Connection;

/**
 * @property int $id
 * @property int $user_id
 * @property int $balance
 * @property string $currency
 * @property string $date
 * @property string $description
 * @property string $type
 */
class TransactionSearchRepository extends ActiveRecord implements TransactionSearchRepositoryInterface
{

    public function __construct(
        Connection $redis,
        $config = []
    )
    {
        parent::__construct($config);
    }

    public const LIMIT = 10;

    public static function tableName(): string
    {
        return 'transactions';
    }

    /**
     * @param int $userId
     * @param int $page
     * @param string $sort
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param int|null $fromAmount
     * @param int|null $toAmount
     * @param string|null $transactionType
     * @return array
     */
    public function getTransactions(
        int $userId,
        int $page = 1,
        string $sort = 'asc',
        string $dateFrom = null,
        string $dateTo = null,
        int $fromAmount = null,
        int $toAmount = null,
        string $transactionType = null
    ): array
    {
        $cacheKey = "transactions_{$userId}_{$page}_{$sort}_{$dateFrom}_{$dateTo}_{$fromAmount}_{$toAmount}_{$transactionType}";

        $cachedResult = Yii::$app->redis->get($cacheKey);
        if ($cachedResult) {
            return unserialize($cachedResult);
        }

        $query = self::find()
            ->where(['user_id' => $userId])
            ->offset(($page - 1) * self::LIMIT)
            ->limit(self::LIMIT)
            ->addOrderBy(['balance' => $sort]);

        if ($dateFrom) {
            $query->andWhere(['>=', 'date', $dateFrom]);
        }

        if ($dateTo) {
            $query->andWhere(['<=', 'date', $dateTo]);
        }

        if ($fromAmount) {
            $query->andWhere(['>=', 'balance', $fromAmount]);
        }

        if ($toAmount) {
            $query->andWhere(['<=', 'balance', $toAmount]);
        }

        if ($transactionType) {
            $query->andWhere(['type' => $transactionType]);
        }

        $result = $query->asArray()->all();

        Yii::$app->redis->set(
            $cacheKey,
            serialize($result)
        );
        Yii::$app->redis->expire(
            $cacheKey,
            60 * 5 //5 минут
        );

        return $result;
    }

    public function updateTransactionCache(int $userId)
    {
        // Формируем ключ кеша для транзакций пользователя
        $cacheKeyPattern = "transactions_{$userId}_*";

        // Получаем экземпляр кеш-компонента Redis из контейнера приложения
        $cache = Yii::$app->redisCache;

        // Находим все ключи кеша, соответствующие шаблону
        $keys = $cache->keys($cacheKeyPattern);

        // Удаляем найденные ключи из кеша
        $cache->deleteMultiple($keys);
    }
}