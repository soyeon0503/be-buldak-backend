<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    protected $message = '유저를 찾을 수 없습니다.';
    protected $code = 404;
}
