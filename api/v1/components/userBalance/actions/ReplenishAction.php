<?php

namespace app\api\v1\components\userBalance\actions;

use app\api\v1\components\userBalance\application\DTOs\ReplenishDTO;
use app\api\v1\components\userBalance\domain\services\ReplenishServiceInterface;
use app\api\common\actions\ModelAction;
use yii\base\Model;

class ReplenishAction extends ModelAction
{

    public function __construct(
        $id,
        $controller,
        readonly private ReplenishServiceInterface $replenishService,
        $config = [],
    )
    {
        parent::__construct($id, $controller, $config);
    }

    public function run(): array
    {
        /** @var ReplenishDTO $replenishDTO */
        $replenishDTO = $this->model;
        $this->replenishService->replenish($replenishDTO);

        return [
            'message' => 'Balance replenished',
            'code' => 0,
        ];
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new ReplenishDTO();
    }
}