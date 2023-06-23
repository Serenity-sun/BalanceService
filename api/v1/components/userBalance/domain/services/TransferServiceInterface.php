<?php

namespace app\api\v1\components\userBalance\domain\services;

use app\api\v1\components\userBalance\application\DTOs\TransferDTO;

interface TransferServiceInterface
{
    public function transfer(TransferDTO $transferDTO): void;
}