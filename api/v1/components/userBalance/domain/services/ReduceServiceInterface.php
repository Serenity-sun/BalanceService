<?php

namespace app\api\v1\components\userBalance\domain\services;

use app\api\v1\components\userBalance\application\DTOs\ReduceDTO;

interface ReduceServiceInterface
{
    public function reduce(ReduceDTO $reduceDTO): void;
}