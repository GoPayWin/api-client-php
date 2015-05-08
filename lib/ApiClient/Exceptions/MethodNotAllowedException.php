<?php

namespace Ziftr\ApiClient\Exceptions;

class MethodNotAllowedException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 500, \Exception $previous = NULL) {
    parent::__construct($Configuration, $message,$code,$previous);
  }

}
