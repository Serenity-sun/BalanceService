<?php

namespace app\api\v1\components\userBalance\actions;

use app\api\v1\components\userBalance\application\DTOs\TransferDTO;
use app\api\v1\components\userBalance\domain\services\TransferServiceInterface;
use app\api\common\actions\ModelAction;
use yii\base\Model;

class TransferAction extends ModelAction
{

    public function __construct(
        $id,
        $controller,
        readonly private TransferServiceInterface $transferService,
        $config = []
    )
    {
        parent::__construct($id, $controller, $config);
    }

    public function run(): array
    {
        /** @var TransferDTO $transferDTO */
        $transferDTO = $this->model;
        $this->transferService->transfer($transferDTO);

        return [
            'message' => 'Balance transferred',
            'code' => 0,
        ];
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new TransferDTO();
    }
}