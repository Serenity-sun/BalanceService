<?php

namespace app\api\v1\components\userBalance\actions;

use app\api\common\actions\ModelAction;
use app\api\v1\components\userBalance\domain\services\CheckServiceInterface;
use yii\base\Model;
use app\api\v1\components\userBalance\application\DTOs\CheckDTO;

class CheckAction extends ModelAction
{
    public function __construct(
        $id,
        $controller,
        private readonly CheckServiceInterface $checkService,
        $config = [])
    {
        parent::__construct($id, $controller, $config);
    }

    public function run(): array
    {
        /** @var CheckDTO $checkDTO */
        $checkDTO = $this->model;
        $balance = $this->checkService->check($checkDTO);

        return [
            'code' => 0,
            'balance' => $balance,
        ];
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new CheckDTO();
    }
}