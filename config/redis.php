<?php

use yii\redis\Connection;

return [
    'class' => Connection::class,
    'hostname' => 'redis_balance',
    'port' => '6379',
];
