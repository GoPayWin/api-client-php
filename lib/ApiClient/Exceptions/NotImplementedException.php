<?php

namespace Ziftr\ApiClient\Exceptions;

class NotImplementedException extends Base
{

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 501, \Exception $previous = NULL) {
    parent::__construct($Configuration, $message,$code,$previous);
  }

}
