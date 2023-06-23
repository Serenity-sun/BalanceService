<?php

namespace app\api\common\actions;

use yii\base\Action;
use yii\base\Model;

abstract class ModelAction extends Action
{
    protected ?Model $model;

    /**
     * @return Model
     */
    abstract public function getModel(): Model;

    /**
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }
}