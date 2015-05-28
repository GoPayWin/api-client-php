<?php

namespace Ziftr\ApiClient;

class Request
{

  const API_VERSION = '0.1';
  const CLIENT_VERSION = '0.1.0a';

  private $_path;
  private $_Configuration;
  private $_secure;
  private $_headers;
  private $_body;

  public function __construct($path, $configuration, $secure=true) {
    $this->_path = $path;
    $this->_Configuration = $configuration;
    $this->_secure = $secure;
  }

  protected function _getSignature($privateKey, $publicKey, $qs='') {
    if ( empty($privateKey) ) { return ''; }

    // Calculate text to sign

    $timestamp = dechex(time());

    $text_to_sign  = '';
    //$text_to_sign .= $method;
    $text_to_sign .= $timestamp;
    $text_to_sign .= $publicKey;
    $text_to_sign .= $this->_path;
    $text_to_sign .= $qs;
    $hashKey       = hash('sha256',$privateKey);

    // Sign the text

    return $timestamp . '/' . hash_hmac('sha256', $text_to_sign, $hashKey);
   
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

    curl_setopt($ch, CURLOPT_URL,            $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  $method);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

    // Get the signing key

    $pubkey = $this->_Configuration->read('publishable_key');
    $prvkey = $this->_Configuration->read('private_key');

    // Set the headers

    $signature = $this->_getSignature($prvkey,$pubkey);

    $headers = array(
      'Authorization: Basic '. base64_encode($pubkey.':'.$signature),
      'Accept: application/vnd.ziftr.fpa-' . $acceptVersion . '+json',
      'Content-Type: application/json',
      'User-Agent: Ziftr%20API%20PHP%20Client%20' . self::CLIENT_VERSION
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ( $method == 'POST' || $method == 'PATCH' || $method == 'PUT' ) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      $headers[] = 'Content-Type: application/json';
    }

    // Make the request

    $response       = curl_exec($ch);

    $cerror         = curl_error($ch);

    if ( !empty($cerror) ) {
      throw new \Exception($cerror);
    }

    $header_size    = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $code           = curl_getinfo($ch,CURLINFO_HTTP_CODE);

    $this->_headers = substr($response, 0, $header_size);
    $this->_body    = json_decode(substr($response, $header_size));

    switch ( $code ) {
    case 400: throw new         Exceptions\BadRequestException($this->_Configuration, $this->_body);
    case 401: throw new      Exceptions\AuthorizationException($this->_Configuration, $this->_body);
    case 403: throw new          Exceptions\ForbiddenException($this->_Configuration, $this->_body);
    case 404: throw new           Exceptions\NotFoundException($this->_Configuration, $this->_body);
    case 405: throw new   Exceptions\MethodNotAllowedException($this->_Configuration, $this->_body);
    case 406: throw new      Exceptions\NotAcceptableException($this->_Configuration, $this->_body);
    case 422: throw new         Exceptions\ValidationException($this->_Configuration, $this->_body);
    case 500: throw new     Exceptions\InternalServerException($this->_Configuration, $this->_body);
    case 501: throw new     Exceptions\NotImplimentedException($this->_Configuration, $this->_body);
    case 502: throw new         Exceptions\BadGatewayException($this->_Configuration, $this->_body);
    case 503: throw new Exceptions\ServiceUnavailableException($this->_Configuration, $this->_body);
    case 504: throw new     Exceptions\GatewayTimeoutException($this->_Configuration, $this->_body);
    default:
      if ( $code >= 400 ) {
        throw new Exceptions\Base($this->_Configuration);
      }
    }

    return $this;
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

  public function getResponse() {
    return $this->_body;
  }

  public function getLinks($linkRel, $limit=null) {
    $links = array();

    if ( $this->_body && is_array($this->_body->links) ) {

      foreach ( $this->_body->links as $link ) {
        if ( $link->rel == $linkRel ) {
          $links[] = $link->href;
          if ( $limit && count($links) == $limit ) {
            break;
          }
        }
      }
    }

    return $links;
  }

  public function linkRequest($linkRel) {
    $links = $this->getLinks($linkRel, 1);

    if ( count($links) == 1 ) {
      return new Request($links[0], $this->_Configuration, $this->_secure);

    } else {
      return null;
    }
  }

}
