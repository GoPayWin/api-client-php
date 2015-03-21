<?php

namespace Ziftr\FPA;

class Configuration
{
  private $_settings = array();

  public function load_from_array( $new_settings ) {
    $this->_settings = array_merge( $this->_settings, $new_settings );
  }

  public function read($name) {
    return $this->_settings[$name];
  }

  public function write($name, $value) {
    $this->_settings[$name] = $value;
  }
}
