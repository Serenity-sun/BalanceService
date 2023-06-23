<?php

namespace app\api\common\behaviours;

use app\api\common\actions\ModelAction;
use app\api\common\controllers\BaseController;
use app\api\common\exceptions\MethodHasMultipleTypeException;
use app\api\common\exceptions\MethodTypeNotSpecifiedException;
use app\api\common\exceptions\ModelValidationFailedException;
use TypeError;
use Yii;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\base\Controller;

class ValidationBehaviour extends Behavior
{

    /**
     * @return string[]
     */
    public function events(): array
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'validate',
        ];
    }

    /**
     * @param ActionEvent $event
     * @return void
     * @throws MethodHasMultipleTypeException
     * @throws MethodTypeNotSpecifiedException
     * @throws ModelValidationFailedException
     */
    public function validate(ActionEvent $event): void
    {
        $action = $event->action;

        if (!$action instanceof ModelAction) {
            return;
        }

        $model = $action->getModel();
        $verbs = $this->getValidVerbs($action);
        $method = strtolower($verbs[$action->id][0]);
        $request = Yii::$app->request->$method();

        try {
            $model->load($request, '');
        } catch (TypeError $exception) {
            //TO DO добавить сообщение об ошибке
            throw new ModelValidationFailedException();
        }

        if (!$model->validate()) {
            throw new ModelValidationFailedException($model->getErrors());
        }

        $action->setModel($model);
    }

    /**
     * @param ModelAction $action
     * @return array|null
     * @throws MethodHasMultipleTypeException
     * @throws MethodTypeNotSpecifiedException
     */
    private function getValidVerbs(ModelAction $action): ?array
    {
        if (!$action->controller instanceof BaseController) {
            return null;
        }
        $verbs = $action->controller->getVerbs();

        if (!isset($verbs[$action->id])) {
            throw new MethodTypeNotSpecifiedException();
        }

        if (count($verbs[$action->id]) > 1) {
            throw new MethodHasMultipleTypeException();
        }

        return $verbs;
    }
}