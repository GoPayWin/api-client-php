<?php

namespace Ziftr\ApiClient\Exceptions;

class BadGatewayException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 502, \Exception $previous = NULL) {
    parent::__construct($Configuration, $message,$code,$previous);
  }

}
