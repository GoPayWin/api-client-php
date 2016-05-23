<?php

namespace GoPayWin\ApiClient\Exceptions;

class ForbiddenException extends Base
{

  public function __construct(\GoPayWin\ApiClient\Configuration $Configuration, $body, $message = "", $code = 403, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

}
