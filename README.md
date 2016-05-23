# GoPayWin API Bindings for PHP

[![@awsforphp on Twitter](http://img.shields.io/badge/twitter-%40gopaywin-blue.svg?style=flat)](https://twitter.com/gopaywin)
[![Latest Development Version](https://img.shields.io/packagist/v/gopaywin/api-client.svg)](https://packagist.org/packages/gopaywin/api-client)

## Installation

The GoPayWin API Client can be installed via [Composer](http://getcomposer.org) by requiring the
`gopaywin/api-client` package in your project's `composer.json`.

```json
{
    "require": {
        "gopaywin/api-client": "0.2.*@dev"
    }
}
```

Then run a composer update
```sh
php composer.phar update
```

## Configuration

```php
$configuration = new \GoPayWin\ApiClient\Configuration();

$configuration->load_from_array(array(
  'endpoint' => \GoPayWin\ApiClient\Configuration::SANDBOX_ENDPOINT,
  'private_key' => '...',
  'publishable_key' => '...'
));
```

You can create custom configuration loaders by extending the `\GoPayWin\ApiClient\Configuration` class.

## Usage


```php
$request = new \GoPayWin\ApiClient\Request('/orders', $configuration);
$response = $request->get();
```

## Links

* [GoPayWin API Client for PHP on Github](http://github.com/gopaywin/api-client-php/)
* [GoPayWin API Client on Packagist](https://packagist.org/packages/gopaywin/api-client/)
* [GoPayWin website](http://www.gopaywin.com/)
