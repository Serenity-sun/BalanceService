<?php

namespace app\api\v1\components\userBalance\actions;

use app\api\common\actions\ModelAction;
use app\api\v1\components\userBalance\domain\services\HistoryServiceInterface;
use yii\base\Model;
use app\api\v1\components\userBalance\application\DTOs\HistoryDTO;

class HistoryAction extends ModelAction
{
    public function __construct(
        $id,
        $controller,
        readonly private HistoryServiceInterface $historyService,
        $config = []
    )
    {
        parent::__construct($id, $controller, $config);
    }

    public function run(): array
    {
        /** @var HistoryDTO $historyDTO */
        $historyDTO = $this->model;
        $history = $this->historyService->getHistory($historyDTO);

        return [
            'code' => 0,
            'history' => $history,
        ];
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new HistoryDTO();
    }
}