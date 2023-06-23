<?php

namespace app\api\common\exceptions;

use app\api\common\enums\ErrorCodeEnum;

class ModelValidationFailedException extends BaseException
{
	public $statusCode = 400;

    public $message = 'Model validation failed';

    public $code = ErrorCodeEnum::VALIDATION_FAILED;

    public function __construct(array $data = [])
    {
        $this->message .= ': ' . json_encode($data);

        parent::__construct(
            message: $this->message,
        );
    }
}
