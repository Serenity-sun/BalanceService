<?php

namespace app\api\v1\components\userBalance\domain\services;

use app\api\v1\components\userBalance\application\DTOs\CheckDTO;

interface CheckServiceInterface
{
    /**
     * @param CheckDTO $checkDTO
     * @return int
     */
    public function check(CheckDTO $checkDTO): int;
}