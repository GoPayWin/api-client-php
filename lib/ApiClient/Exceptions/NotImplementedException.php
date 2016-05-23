<?php

namespace GoPayWin\ApiClient\Exceptions;

class NotImplementedException extends Base
{

  public function __construct(\GoPayWin\ApiClient\Configuration $Configuration, $body, $message = "", $code = 501, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

}
