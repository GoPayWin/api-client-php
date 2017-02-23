<?php

namespace GoPayWin\ApiClient\Exceptions;

class ValidationException extends Base
{

  public function __construct(\GoPayWin\ApiClient\Configuration $Configuration, $body, $message = "", $code = 422, \Exception $previous = NULL) {
    parent::__construct($Configuration, $body, $message, $code, $previous);
  }

  public function getFields() {
    return isset($this->_body->error->fields) ? $this->_body->error->fields : new StdClass();
  }

  public function getField($field) {
    $fields = $this->getFields();
    return isset($fields->$field) ? $fields->$field : null;
  }

}
