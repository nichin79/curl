<?php
require_once __DIR__ . '/../vendor/autoload.php';
// use Nichin79\Curl\Curl;
use Nichin79\Curl\BasicCurl;

$data = [
  'url' => 'https://pdi-tugboat.zendesk.com/api/v2/tickets/6199.json',
  // Method will automatically be set to GET if not specified
  'method' => 'GET',
  'headers' => [],
  'options' => [
    'userpwd' => 'nicklas.hintze@theservicecorporation.com/token:qiz8oHvvMKD5Bg0WDTXkbyW3luRafHHOkXJOHaiP'
  ]
];

$curl = new BasicCurl($data);

echo json_encode($curl->getResponse(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
echo "\r\n";
echo "http status code: " . $curl->httpcode();