<?php

namespace app\api\v1\components\userBalance\application\caches;

use Yii;
use yii\redis\Connection;

class TransactionRedis implements TransactionCacheInterface
{

    public function reset(int $userId): void
    {
        $cacheKeyPattern = "transactions_{$userId}_*";

        /** @var Connection $cache */
        $cache = Yii::$app->redis;

        $keys = $cache->keys($cacheKeyPattern);

        if (!empty($keys)) {
            foreach ($keys as $key) {
                $cache->del($key);
            }
        }
    }
}