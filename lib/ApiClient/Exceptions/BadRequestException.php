<?php

namespace Ziftr\ApiClient\Exceptions;

class BadRequestException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $body, $message = "", $code = 400, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

}
