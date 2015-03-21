<?php

namespace Ziftr\ApiClient\Exceptions;

class Base extends \Exception
{

  protected $_Configuration;

  public function __construct(\Ziftr\ApiClient\Configuration $Configuration, $message = "", $code = 0, \Exception $previous = NULL) {
    $this->_Configuration = $Configuration;
    parent::__construct($message,$code,$previous);
  }

}
