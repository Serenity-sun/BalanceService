<?php

namespace app\api\common\controllers;

use app\api\common\behaviours\ValidationBehaviour;
use yii\filters\VerbFilter;
use yii\rest\Controller;

abstract class BaseController extends Controller
{
    public function behaviors(): array
    {
        return [
            'validation' => [
                'class' => ValidationBehaviour::class,
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => $this->getVerbs(),
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        return $this->getActions();
    }

    /**
     * @return array
     */
    abstract public function getVerbs(): array;

    /**
     * @return array
     */
    abstract public function getActions(): array;
}