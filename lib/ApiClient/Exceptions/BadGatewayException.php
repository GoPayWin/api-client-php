<?php

namespace GoPayWin\ApiClient\Exceptions;

class BadGatewayException extends Base
{

  public function __construct(\GoPayWin\ApiClient\Configuration $Configuration, $body, $message = "", $code = 502, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

}
