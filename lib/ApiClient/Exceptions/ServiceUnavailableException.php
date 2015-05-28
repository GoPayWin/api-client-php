<?php

namespace Ziftr\ApiClient\Exceptions;

class ServiceUnavailableException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $body, $message = "", $code = 503, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

}
