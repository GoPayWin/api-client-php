<?php

/*
 * Include the composer autoload file.
 */

include('../vendor/autoload.php');

/*
 * Load in the configuration information.
 * Make sure to replace the keys with your own.
 */

$configuration = new \Ziftr\ApiClient\Configuration();

$configuration->load_from_array(array(
  'host' => 'sandbox.fpa.bz',
  'port' => 443,
  'secure' => true,
  'private_key' => '...',
  'publishable_key' => '...'
));

/*
 * Create a new order request.
 */

$order = new \Ziftr\ApiClient\Request('/orders/', $configuration);

try {

  /*
   * POST the request with the order data.
   * See the documentation for possible fields.
   */

  $order = $order->post(
    array(
      'order' => array(
        'currency_code' => 'USD',
        'is_shipping_required' => true
      )
    )
  );

  print_r($order->getResponse());


  /*
   * Create a new request object for the items endpoint.
   * This method is preffered to creating a URL directly.
   */

  $itemsReq = $order->linkRequest('items');

  /*
   * Add an order item.
   */

  $itemsReq->post(array(
    'order_item' => array(
      'name' => 'Test Item',
      'price' => 100,
      'quantity' => 1,
      'currency_code' => 'USD'
    )
  ));

  print_r($itemsReq->getResponse());

} catch( Exception $e ) {
}
