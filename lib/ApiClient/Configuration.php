<?php

namespace GoPayWin\ApiClient;

class Configuration
{
  const SANDBOX_ENDPOINT = 'https://sandbox.fpa.bz';
  const LIVE_ENDPOINT = 'https://api.fpa.bz';

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
