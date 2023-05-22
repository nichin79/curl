<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Nichin79\Curl\Curl;

$payload = [
  'method' => 'GET',
  'url' => 'https://reqbin.com/echo'
];

$curlResponse = Curl::exec($payload);
echo json_encode($curlResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);