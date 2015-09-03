<?php

namespace Ziftr\ApiClient\Exceptions;

class Base extends \Exception
{

  protected $_Configuration;

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $body, $message = "", $code = 0, \Exception $previous = NULL) {
    $this->_Configuration = $Configuration;
    $this->_body          = $body;

    parent::__construct($message, $code, $previous);
  }

  public function getResponseBody() {
    return $this->_body;
  }

}
