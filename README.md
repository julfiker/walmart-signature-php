# walmart-signature-php
Generating walmart auth signatue.

## Installation
``` sh
composer require julfiker/walmart-signature-php:dev-master
```
Just run composer require fillup/walmart-auth-signature-php:dev-master. This assumes you have composer installed and available in your path as composer.

## How to use
```php
<?php 
require_once __DIR__."/vendor/autoload.php";
use Walmart\Lib\Signature;

$privateKey = "";
$consumerId = "";
$timeStamp =  "";
$keyVersion = "";

$signature = new Signature($consumerId, $timeStamp, $keyVersion, $privateKey);
$result =  $signature->generateSignature();

```
