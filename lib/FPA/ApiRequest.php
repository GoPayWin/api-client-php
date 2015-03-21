<?php

namespace Ziftr\FPA;

class ApiRequest
{

  const API_VERSION = '0.1';
  const CLIENT_VERSION = '0.1.0a';

  private $_path;
  private $_Configuration;
  private $_secure;

  public function __construct($path, $configuration, $secure=true) {
    $this->_path = $path;
    $this->_Configuration = $configuration;
    $this->_secure = $secure;
  }

  public function get_signature() {
   
  }

  private function _request( $method, $data=null ) {
    static $acceptVersion = false;

    if ( !$acceptVersion ) {
       $acceptVersion = str_replace('.','-',self::API_VERSION);
    }

    $ch = curl_init();

    // Setup the initial request

    $port = $this->_Configuration->read('port');
    $host = $this->_Configuration->read('host') . ':' . $port;

    $protocol = $this->_secure ? 'https' : 'http';

    $url = $protocol . '://' . $host . $this->_path;

    curl_setopt($ch, CURLOPT_URL,            $protocol . '://' . $host . $this->_path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  $method);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Get the signing key

    $pkey = $this->_Configuration->read('publishable_key');
    $skey = $this->_Configuration->read('private_key');

    // Get timestamp

    $timestamp = dechex(time());

    // Get query string

    $qs = '';

    // Calculate text to sign

    $text_to_sign  = '';
    //$text_to_sign .= $method;
    $text_to_sign .= $timestamp;
    $text_to_sign .= $pkey;
    $text_to_sign .= $this->_path;
    $text_to_sign .= $qs;

    $hashKey = hash('sha256',$skey);

    // Sign the text

    $signature = $timestamp . '/' . hash_hmac('sha256', $text_to_sign, $hashKey);

    // Set the headers

    $headers = array(
      'Authorization: Basic '. base64_encode($pkey.':'.$signature),
      'Accept: application/vnd.ziftr.fpa-' . $acceptVersion . '+json',
      'User-Agent: Ziftr%20API%20PHP%20Client%20' . self::CLIENT_VERSION
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Make the request


    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $code        = curl_getinfo($ch,CURLINFO_HTTP_CODE);

    $header = substr($response, 0, $header_size);
    $body   = json_decode(substr($response, $header_size));

    return $body;
  }

  public function post( $data ) {
    return $this->_request('POST',$data);
  }

  public function put( $data ) {
    return $this->_request('PUT',$data);
  }

  public function patch( $data ) {
    return $this->_request('PATCH',$data);
  }

  public function get() {
    return $this->_request('GET');
  }

  public function del() {
    return $this->_request('DELETE');
  }

}
