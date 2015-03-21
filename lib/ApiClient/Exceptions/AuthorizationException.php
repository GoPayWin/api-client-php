<?php

namespace Ziftr\ApiClient\Exceptions;

class AuthorizationException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 401, \Exception $previous = NULL) {
    parent::__construct($Configuration, $message,$code,$previous);
  }

}
