<?php

namespace app\api\v1\components\userBalance\domain\services;

use app\api\v1\components\userBalance\application\DTOs\HistoryDTO;

interface HistoryServiceInterface
{
    public function getHistory(HistoryDTO $historyDTO): array;
}