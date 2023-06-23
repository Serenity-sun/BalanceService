<?php

namespace app\api\v1\components\userBalance\actions;

use app\api\v1\components\userBalance\application\DTOs\ReduceDTO;
use app\api\v1\components\userBalance\domain\services\ReduceServiceInterface;
use app\api\common\actions\ModelAction;
use yii\base\Model;

class ReduceAction extends ModelAction
{
    public function __construct(
        $id,
        $controller,
        readonly private ReduceServiceInterface $reduceService,
        $config = [],
    )
    {
        parent::__construct($id, $controller, $config);
    }

    public function run(): array
    {
        /** @var ReduceDTO $reduceDTO */
        $reduceDTO = $this->model;
        $this->reduceService->reduce($reduceDTO);

        return [
            'message' => 'Balance reduced',
            'code' => 0,
        ];
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new ReduceDTO();
    }
}