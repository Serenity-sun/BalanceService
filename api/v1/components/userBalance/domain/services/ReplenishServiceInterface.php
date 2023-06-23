<?php

namespace app\api\v1\components\userBalance\domain\services;

use app\api\v1\components\userBalance\application\DTOs\ReplenishDTO;

interface ReplenishServiceInterface
{
    public function replenish(ReplenishDTO $replenishDTO): void;
}