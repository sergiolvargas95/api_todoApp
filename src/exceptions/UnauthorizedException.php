<?php

namespace Todo\Admin\exceptions;

use Exception;

class UnauthorizedException extends Exception {
    protected $message = "Unauthorized access.";
}
