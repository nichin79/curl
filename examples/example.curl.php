<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Nichin79\Curl\Curl;

$data = [
  'url' => 'https://reqbin.com/echo',
  // Method will automatically be set to GET if not specified
  'method' => 'GET',
  'headers' => [],
  'options' => [
    'SSL_VERIFYPEER' => false
  ]
];

$curl = new Curl($data);

// execute the initiated curl and return the response
$curl->exec();

echo "\r\n";
echo "http status code: " . $curl->getHttpCode();