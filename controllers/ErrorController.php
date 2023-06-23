<?php

namespace app\controllers;

use Yii;
use yii\base\Controller;
use yii\web\NotFoundHttpException;

class ErrorController extends Controller
{

    /**
     * @return string
     */
    public function actionError(): string
    {
        $exception = Yii::$app->errorHandler->exception;
        $response = Yii::$app->response;

        if ($exception instanceof NotFoundHttpException) {
            $response->setStatusCode(404);
        }

        $data = [
            'exception' => get_class($exception),
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
        ];

        return json_encode($data, JSON_PRETTY_PRINT);
    }
}