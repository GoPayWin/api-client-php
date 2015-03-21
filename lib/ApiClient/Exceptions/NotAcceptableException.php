<?php

namespace Ziftr\ApiClient\Exceptions;

class NotAcceptableException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 406, \Exception $previous = NULL) {
    parent::__construct($Configuration, $message,$code,$previous);
  }

}
