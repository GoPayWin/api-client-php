<?php

namespace Ziftr\ApiClient\Exceptions;

class ForbiddenException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 403, \Exception $previous = NULL) {
    parent::__construct($Configuration, $message,$code,$previous);
  }

}
