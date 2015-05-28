<?php

namespace Ziftr\ApiClient\Exceptions;

class ForbiddenException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $body, $message = "", $code = 403, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

}
