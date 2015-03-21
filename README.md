# Ziftr API Bindings for PHP

This branch is under active development and should not be considered stable for use in production systems. For more information please visit: [www.ziftrpay.com](http://www.ziftrpay.com/)

[![@awsforphp on Twitter](http://img.shields.io/badge/twitter-%40ziftrapi-blue.svg?style=flat)](https://twitter.com/ziftrapi)
[![Latest Development Version](https://img.shields.io/packagist/v/ziftr/api-client.svg)](https://packagist.org/packages/ziftr/api-client)

## Installation

The Ziftr API Client can be installed via [Composer](http://getcomposer.org) by requiring the
`ziftr/api-client` package in your project's `composer.json`.

```json
{
    "require": {
        "ziftr/api-client": "0.1.*@dev"
    }
}
```

Then run a composer update
```sh
php composer.phar update
```

## Configuration

```php
$configuration = new \Ziftr\ApiClient\Configuration();

$configuration->load_from_array(array(
  'host' => 'sandbox.fpa.bz',
  'port' => 443,
  'private_key' => '...',
  'publishable_key' => '...'
));
```

You can create custom configuration loaders by extending the `\Ziftr\ApiClient\Configuration` class.

## Usage


```php
$request = new \Ziftr\ApiClient\Request('/orders', $configuration);
$response = $request->get();
```

## Links

* [Ziftr API Client for PHP on Github](http://github.com/ziftr/ziftr-api-client-php/)
* [Ziftr API Client on Packagist](https://packagist.org/packages/ziftr/api-client/)
* [Ziftr website](http://www.ziftr.com/)
* [ZiftrPAY website](http://www.ziftrpay.com/)
